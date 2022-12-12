<?php
namespace App\Controller;
use App\Service\ServeiDadesEquips;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Equip;
use Doctrine\Persistence\ManagerRegistry;
class EquipsController extends AbstractController
{

    private $dadesEquips;
    private $equips;
    public function __construct(ServeiDadesEquips $dades, $dadesEquips, ManagerRegistry $doctrine)
    {
    $this->equips = $dades->get();
    $this->dadesEquips = $dadesEquips;
    $this->dades = $doctrine->getRepository(Equip::class);
    }

/**
* @Route("/equip/{codi}", name="dades_equip", requirements={"codi"="\d+"})
*/
public function fitxa($codi=1)
{
$resultat = array_filter($this->equips,
function($equip) use ($codi)
{
return $equip["codi"] == $codi;
});
if (count($resultat) > 0)
{
    return $this->render('fitxa_equip.html.twig',
    array('equip' =>
    array_shift($resultat)));
}
else
return $this->render('fitxa_equip.html.twig', array(
    'equip' => NULL));
}

#[Route('/equip/inserir', name:'inserir_equip')]
public function inserir(ManagerRegistry $doctrine)
{
$entityManager = $doctrine->getManager();
$equip = new Equip();
$equip->setNom("Simarrets");
$equip->setCicle("DAW");
$equip->setCurs("22/23");
$equip->setNota(9);
$equip->setImatge("equipPerDefecte.png");
$entityManager->persist($equip);
try
{
    $entityManager->flush();
    return new Response("Equip inserit amb id ". $equip->getId());
} catch (\Exception $e) {
    return new Response("Error inserint objecte");
}
}

/**
* @Route("/equip/{text}", name="buscar_equip")
*/
public function buscar($text)
{
$resultat = array_filter($this->equips,
function($equip) use ($text)
{
return strpos($equip["nom"], $text) !== FALSE;
});
    return $this->render('llista_equips.html.twig',
    array('equips' => $resultat));
}

}
?>