<?php
namespace App\Controller;
use App\Service\ServeiDadesEquips;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class EquipsController extends AbstractController
{

    private $equips;
    public function __construct(ServeiDadesEquips $dades)
    {
    $this->equips = $dades->get();
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