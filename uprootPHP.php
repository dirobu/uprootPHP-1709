<?php
// System Required
	include('uprootPHP/uprootPHP.system.php');

// System Add-ons
	include('uprootPHP/add-ons/ezsqli.php'); // Instantiated

// Custom Includes


// Custom Variables


// Run

	$uprootPHP = new uprootPHP;

	$uprootPHP -> allow('sitemap.xml') -> allow('robots.txt');
	$uprootPHP -> index('pages/index.php') -> error('pages/error.php');
	$uprootPHP -> template('template.html') -> load();






//$allowpage = $uprootPHP -> allow('/sitemap.xml') -> allow('/sitemap.xml');
//$errorpage = $uprootPHP -> error('/page/error.php');
?>
