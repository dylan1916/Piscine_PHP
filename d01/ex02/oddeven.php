#!/usr/bin/php
<?php
while (1)
{
	echo("Entrez un nombre: ");
	$num = trim(fgets(STDIN));
	if (feof(STDIN))
	{
		echo("\n");
		exit ;
	}
	if (is_numeric($num) == TRUE)
	{
		if ($num % 2 == 0)
			echo ("Le chiffre $num est Pair\n");
		else
			echo ("Le chiffre $num est Impair\n");
	}
	else
		echo("'$num' n'est pas un chiffre\n");
}
?>
