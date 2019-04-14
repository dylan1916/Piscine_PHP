#!/usr/bin/php
<?php
function ft_split($string)
{
	$tab = explode(" ", $string); //explode — Coupe une chaîne en segments
	sort($tab);//sort — Trie un tableau
	$resultat = array();//array — Crée un tableau
	foreach($tab as $element)
	{
		if (($element != ""))
			$resultat[] = $element;
	}
	return ($resultat);
}
?>