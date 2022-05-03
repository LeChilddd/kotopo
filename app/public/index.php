<?php

function phrase($tab)
{
    $phrase_complete = "";
    while (count($tab) != 0) {
        $number = array_rand($tab);
        $phrase_complete .= $tab[$number] . " ";

        unset($tab[$number]);
    }
    echo $phrase_complete;
}

phrase(["bonjour", "tristan", "comment", "vas", "tu", 'on', 'peut', 'faire', 'des' ,'phrase', 'à' ,'rallonge']);


$tab_A = array(3, 8, 15, 16);
$tab_B = array();

for ($i = 1; $i <= 20; $i++) {
    if (!in_array($i, $tab_A)) {
        array_push($tab_B, $i);
    }
}

function cube($nombre)
{
    return $nombre ** 3;
}

$tableau_HTML = "<table>";
$tableau_HTML .= "<tr><td>Nombre</td><td>Cube</td></tr>";
foreach ($tab_B as $value) {
    $cube_value = cube($value);
    $tableau_HTML .= "<tr><td>$value</td><td>$cube_value</td></tr>";
}
$tableau_HTML .= "</table>";

echo $tableau_HTML;

