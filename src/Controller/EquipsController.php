<?php
namespace App\Controller;
use App\Entity\Equip;
use App\Service\ServeiDadesEquips;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
public function fitxa(ManagerRegistry $doctrine,$codi=1)
{
$repositori = $doctrine->getRepository(Equip::class);
 $equip = $repositori->find($codi);
/*
$resultat = array_filter($this->equips,
function($equip) use ($codi)
{
return $equip["codi"] == $codi;
});*/
if ($equip!=null)
    
    return $this->render('fitxa_equip.html.twig', array('equip'=>$equip,
    'codi'=>$codi));

    else

    return $this->render('fitxa_equip.html.twig', array(
        'equip' => NULL,'codi'=>NULL));
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
    return $this->render('inserir_equip.html.twig',
    array('equips'=>$equip,'error'=>NULL));
    
} catch (\Exception $e) {
    return $this->render('inserir_equip.html.twig',
    array('equips' => $equip,'error'=>$e->getMessage()));
}
}

#[Route('/equip/inserirmultiple' ,name:'inserir_equips')]
public function inserirmultiple(ManagerRegistry $doctrine)
{
    $entityManager = $doctrine->getManager();
    $equip1 = new equip();
    $equip1->setNom("Equip Roig");
    $equip1->setCicle("DAW");
    $equip1->setCurs("22/23");
    $equip1->setNota(5.25);
    $equip1->setImatge("roig.png");
    $entityManager->persist($equip1);

    $equip2 = new equip();
    $equip2->setNom("Equip Verd");
    $equip2->setCicle("DAM");
    $equip2->setCurs("22/23");
    $equip2->setNota(4.4);
    $equip2->setImatge("verd.png");
    $entityManager->persist($equip2);

    $equip3 = new equip();
    $equip3->setNom("Equip Blau");
    $equip3->setCicle("ASIR");
    $equip3->setCurs("22/23");
    $equip3->setNota(7.8);
    $equip3->setImatge("blau.png");
    $entityManager->persist($equip3);

    $equip4 = new equip();
    $equip4->setNom("Equip Groc");
    $equip4->setCicle("ASIX");
    $equip4->setCurs("22/23");
    $equip4->setNota(3.7);
    $equip4->setImatge("groc.png");
    $entityManager->persist($equip4);

    $equips=array($equip1,$equip2,$equip3,$equip4);
    try{

    $entityManager->flush();

    return $this->render('inserir_equip_multiple.html.twig', array(
        'equips' => $equips, "error"=>null));

    } catch (\Exception $e) {

        $error=$e->getMessage();
        return $this->render('inserir_equip_multiple.html.twig', array(
            'equips' => $equips, "error"=>$error));
            
    }
}

#[Route('/equip/nota/{nota}' ,name:'filtro_nota', requirements: ['codi' => '\d+'])]
    public function filtrar(ManagerRegistry $doctrine,$nota=0)
{

    $repositori = $doctrine->getRepository(Equip::class);
        
    $equips = $repositori->findByNote($nota);
    $equipssort=rsort($equips);

    if ($equips!=null)
    return $this->render('filtrar_notes_equip.html.twig', array('equips'=>$equips));
    else
    return $this->render('filtrar_notes_equip.html.twig', array(
    'equips' => NULL));

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