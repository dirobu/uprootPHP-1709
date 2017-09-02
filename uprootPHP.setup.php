<?php
/*
	RewriteEngine on
	RewriteCond %{REQUEST_URI} !^/index.php$
	RewriteCond %{REQUEST_URI} !\.(gif|jpeg|jpg|png|css|js|wiff|woff2|ttf)$
	RewriteRule ^(.*)$ /index.php?path=$1 [NC,L,QSA]
*/
	$myfile = fopen(".htaccess", "w") or die("Unable to open file!");
	$txt = "RewriteEngine on"."\n";
	$txt.= "RewriteCond %{REQUEST_URI} !^/uprootPHP.php$"."\n";
	$txt.= "RewriteCond %{REQUEST_URI} !\.(gif|jpeg|jpg|png|css|js|wiff|woff2|ttf)$"."\n";
	$txt.= "RewriteRule ^(.*)$ /uprootPHP.php?path=$1 [NC,L,QSA]"."\n";
	fwrite($myfile, $txt);
	fclose($myfile);
	unlink("uprootPHP.setup.php");
	header("location: index.php");
?>
