<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class EquipsController extends AbstractController
{

    private $equips = array(
    
        array("codi" => "1", "nom" => "Equip Roig", "cicle" =>"DAW",
    "curs" =>"22/23", "membres" =>
    array("Elena","Vicent","Joan","Maria")),

    array("codi" => "2", "nom" => "Equip Verd", "cicle" =>"DAM",
    "curs" =>"22/23", "membres" =>
    array("Marcos","Ivan","Alvaro","Miguel")),

    array("codi" => "3", "nom" => "Equip Blau", "cicle" =>"DAW",
    "curs" =>"22/23", "membres" =>
    array("Jordi","Alexandra","Toni","Adrian")),

    array("codi" => "4", "nom" => "Equip Groc", "cicle" =>"DAM",
    "curs" =>"22/23", "membres" =>
    array("David","Marta","Carles","Josep"),
));

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