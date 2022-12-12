<?php

namespace App\Service;
class ServeiDadesEquips 
{

private $equips = array(
    
    array("codi" => "1", "nom" => "Equip Roig", "cicle" =>"DAW",
"curs" =>"22/23", "membres" =>
array("Elena","Sergio","Joan","Maria"),
"imatge"=>"roig.png" ),

array("codi" => "2", "nom" => "Equip Verd", "cicle" =>"DAM",
"curs" =>"22/23", "membres" =>
array("Marcos","Ivan","Alvaro","Miguel"),
"imatge"=>"verd.png"),

array("codi" => "3", "nom" => "Equip Blau", "cicle" =>"DAW",
"curs" =>"22/23", "membres" =>
array("Jordi","Alexandra","Toni","Adrian"),
"imatge"=>"blau.png"),

array("codi" => "4", "nom" => "Equip Groc", "cicle" =>"DAM",
"curs" =>"22/23", "membres" =>
array("David","Marta","Carles","Josep"),
"imatge"=>"groc.png"
));

public function get()
{
return $this->equips;
}

}
?>