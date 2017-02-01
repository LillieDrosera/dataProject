<<<<<<< HEAD
<?php
// load classes and libraries
require_once "libs.php";
<<<<<<< HEAD

//on crée un cookie pour enregistrer les différentes valeurs récupérées deuis de formulaire de l'index
setcookie("sessionFilter[city]", "" , time() + 120, URL_SITE."/include/getResults.php");
setcookie("sessionFilter[est]",  "", time() + 120, URL_SITE."/include/getResults.php");
setcookie("sessionFilter[longitude]",  "", time() + 120, URL_SITE."/include/getResults.php");
setcookie("sessionFilter[latitude]",  "", time() + 120, URL_SITE."/include/getResults.php");

if($_SERVER['REQUEST_METHOD'] == 'GET'){
	if(!empty($_REQUEST['city']))
	{
		//priorité choix de la ville
		$myCity = $_REQUEST['city'];
		// on enregistre la ville choisie
		$_COOKIE['sessionFilter[city']=$myCity ;
	}
	elseif(!empty($_REQUEST['etablissements']))
	{
		$name = "{$_REQUEST['etablissements']}";
		// on enregistre l'id de l'établissement choisi
		$_COOKIE['sessionFilter[est']=$name ;
	}
	else
	{ //si aucune ville ou aucun établissement choisis, on prend la géolocalisation

		$Longitude = $_REQUEST['longitude'];
		$Latitude = $_REQUEST['latitude'];
		// on enregistre les valeurs de longitude et latitude si elles existent

		$_COOKIE['sessionFilter[longitude]']=$Longitude ;
		$_COOKIE['sessionFilter[latitude]']=$Latitude ;
	}
=======


if(!empty($_REQUEST['city']))
{
	//priorité input ville
	$myCity = $_REQUEST['city'];

	// create cookie with data of search by city
	$allRequestCITY = "{$_REQUEST['city']}";
	setcookie("sessionFilterCITY[city]",  $allRequestCITY, time() + 120, URL_SITE."/include/getResults.php");

>>>>>>> origin/master
}

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
<<<<<<< HEAD
	// create cookies for filter by type of handicap and for only city's searching
	if(isset($_COOKIE['sessionFilter'])) // ce cookie est créé à la ligne 15
	{

		$Hauditory = "{$_POST['surdity']}";
		setcookie("sessionFilter[auditoryFilter]", $Hauditory, time() + 120, URL_SITE."/include/getResults.php");

		$Hvisual = "{$_POST['blind']}";
		setcookie("sessionFilter[visualFilter]", $Hvisual, time() + 120, URL_SITE."/include/getResults.php");

		$Hmental = "{$_POST['mental']}";
		setcookie("sessionFilter[mentalFilter]", $Hmental, time() + 120, URL_SITE."/include/getResults.php");

		$Hmobility = "{$_POST['mobility']}";
		setcookie("sessionFilter[mobilityFilter]", $Hmobility, time() + 120, URL_SITE."/include/getResults.php");

	}
	else{
		exit;
	}
=======
	$id = $_REQUEST['etablissements'];

	// create cookie with data of search by establishment
	$allRequestEST = "{$_REQUEST['etablissements']}";
	setcookie("sessionFilterEST[est]",  $allRequestEST, time() + 120, URL_SITE."/include/getResults.php");

}
else
{ //si aucune ville ou aucun établissement choisis
	$Longitude = $_REQUEST['longitude'];
	$Latitude = $_REQUEST['latitude'];
}
>>>>>>> origin/master

}

// DEBUT SCRIPT POUR CREA DE 4 COOKIES DU FILTRE SELON
// LES CHECKBOX DU FORMULAIRE #filterHandicap -> resultats.html
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	// create cookies for filter by type of handicap and for only city's searching
	if(isset($_COOKIE['sessionFilterCITY'])) // ce cookie est créé à la ligne 15
	{

		$Hauditory = "{$_POST['surdity']}";
		setcookie("sessionFilterCITY[auditoryFilter]", $Hauditory, time() + 240, URL_SITE."/include/getResults.php");

		$Hvisual = "{$_POST['blind']}";
		setcookie("sessionFilterCITY[visualFilter]", $Hvisual, time() + 240, URL_SITE."/include/getResults.php");

		$Hmental = "{$_POST['mental']}";
		setcookie("sessionFilterCITY[mentalFilter]", $Hmental, time() + 240, URL_SITE."/include/getResults.php");

		$Hmobility = "{$_POST['mobility']}";
		setcookie("sessionFilterCITY[mobilityFilter]", $Hmobility, time() + 240, URL_SITE."/include/getResults.php");

}
	else{
		exit;
	}

}

// verif infos cookies enregistrés
echo "<pre>";
print_r($_COOKIE['sessionFilterCITY']);
echo "</pre>";

/*
 result view
 */

//register mustache library
require 'libs/Mustache/Autoloader.php';
Mustache_Autoloader::register();

//set the template for Mustache
$template = file_get_contents("template/resultats.html");

//create a new object establishment
<<<<<<< HEAD
	if (isset($_COOKIE['sessionFilter'])) {
		$arrayFilter = $_COOKIE['sessionFilter'];
	}
	else {
		$arrayFilter = [];
	}
=======
$arrayFilter = $_COOKIE['sessionFilterCITY'];
>>>>>>> origin/master

if (!empty($myCity)) { //si on a choisi une ville
	//print_r($arrayFilter);
	$e = new establishment();
<<<<<<< HEAD
	$d["item"] = $e->findByCity($myCity, $arrayFilter);
	$d["LongitudeCarte"] = $e->d[0]['Longitude'];
	$d["LatitudeCarte"] = $e->d[0]['Latitude'];
}

elseif (!empty($name)){
	$e = new establishment($name);
=======
	$d["item"] = $e->findByCity($myCity, $arrayFilter); // Pour ce 2ème argument => il faut modifier la requête dans establishment.class.php
	$d["LongitudeCarte"] = $e->d[0]['Longitude'];
	$d["LatitudeCarte"] = $e->d[0]['Latitude'];

// verif infos du tableau d
	echo "<pre>";
	echo "infos depuis variable d : <br/>";
	print_r($d);
	echo "</pre>";
}

elseif (!empty($id)){
	$e = new establishment($id);
>>>>>>> origin/master
	$d["item"] = $e->d;
	$d["LongitudeCarte"] = $e->d['Longitude'];
	$d["LatitudeCarte"] = $e->d['Latitude'];

}

elseif (!empty($Longitude)&&!empty($Latitude)) {
	$e = new establishment();
	$d["item"] = $e->findByCoord($Longitude, $Latitude);
	$d["LongitudeCarte"] = $Longitude;
	$d["LatitudeCarte"] = $Latitude;
}
else{
	//echo "erreur choix nuls";
	exit;
}

//start the mustache engine
$m = new Mustache_Engine;
//render the template with the set result
echo $m->render($template, $d);
<<<<<<< HEAD
=======


?>
>>>>>>> origin/master
=======
<?php
// load classes and libraries
require_once "libs.php";
<<<<<<< HEAD

//on crée un cookie pour enregistrer les différentes valeurs récupérées deuis de formulaire de l'index
setcookie("sessionFilter[city]", "" , time() + 120, URL_SITE."/include/getResults.php");
setcookie("sessionFilter[est]",  "", time() + 120, URL_SITE."/include/getResults.php");
setcookie("sessionFilter[longitude]",  "", time() + 120, URL_SITE."/include/getResults.php");
setcookie("sessionFilter[latitude]",  "", time() + 120, URL_SITE."/include/getResults.php");

if($_SERVER['REQUEST_METHOD'] == 'GET'){
	if(!empty($_REQUEST['city']))
	{
		//priorité choix de la ville
		$myCity = $_REQUEST['city'];
		// on enregistre la ville choisie
		$_COOKIE['sessionFilter[city']=$myCity ;
	}
	elseif(!empty($_REQUEST['etablissements']))
	{
		$name = "{$_REQUEST['etablissements']}";
		// on enregistre l'id de l'établissement choisi
		$_COOKIE['sessionFilter[est']=$name ;
	}
	else
	{ //si aucune ville ou aucun établissement choisis, on prend la géolocalisation

		$Longitude = $_REQUEST['longitude'];
		$Latitude = $_REQUEST['latitude'];
		// on enregistre les valeurs de longitude et latitude si elles existent

		$_COOKIE['sessionFilter[longitude]']=$Longitude ;
		$_COOKIE['sessionFilter[latitude]']=$Latitude ;
	}
=======


if(!empty($_REQUEST['city']))
{
	//priorité input ville
	$myCity = $_REQUEST['city'];

	// create cookie with data of search by city
	$allRequestCITY = "{$_REQUEST['city']}";
	setcookie("sessionFilterCITY[city]",  $allRequestCITY, time() + 120, URL_SITE."/include/getResults.php");

>>>>>>> origin/master
}

if($_SERVER['REQUEST_METHOD'] == 'POST')
{
<<<<<<< HEAD
	// create cookies for filter by type of handicap and for only city's searching
	if(isset($_COOKIE['sessionFilter'])) // ce cookie est créé à la ligne 15
	{

		$Hauditory = "{$_POST['surdity']}";
		setcookie("sessionFilter[auditoryFilter]", $Hauditory, time() + 120, URL_SITE."/include/getResults.php");

		$Hvisual = "{$_POST['blind']}";
		setcookie("sessionFilter[visualFilter]", $Hvisual, time() + 120, URL_SITE."/include/getResults.php");

		$Hmental = "{$_POST['mental']}";
		setcookie("sessionFilter[mentalFilter]", $Hmental, time() + 120, URL_SITE."/include/getResults.php");

		$Hmobility = "{$_POST['mobility']}";
		setcookie("sessionFilter[mobilityFilter]", $Hmobility, time() + 120, URL_SITE."/include/getResults.php");

	}
	else{
		exit;
	}
=======
	$id = $_REQUEST['etablissements'];

	// create cookie with data of search by establishment
	$allRequestEST = "{$_REQUEST['etablissements']}";
	setcookie("sessionFilterEST[est]",  $allRequestEST, time() + 120, URL_SITE."/include/getResults.php");

}
else
{ //si aucune ville ou aucun établissement choisis
	$Longitude = $_REQUEST['longitude'];
	$Latitude = $_REQUEST['latitude'];
}
>>>>>>> origin/master

}

// DEBUT SCRIPT POUR CREA DE 4 COOKIES DU FILTRE SELON
// LES CHECKBOX DU FORMULAIRE #filterHandicap -> resultats.html
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	// create cookies for filter by type of handicap and for only city's searching
	if(isset($_COOKIE['sessionFilterCITY'])) // ce cookie est créé à la ligne 15
	{

		$Hauditory = "{$_POST['surdity']}";
		setcookie("sessionFilterCITY[auditoryFilter]", $Hauditory, time() + 240, URL_SITE."/include/getResults.php");

		$Hvisual = "{$_POST['blind']}";
		setcookie("sessionFilterCITY[visualFilter]", $Hvisual, time() + 240, URL_SITE."/include/getResults.php");

		$Hmental = "{$_POST['mental']}";
		setcookie("sessionFilterCITY[mentalFilter]", $Hmental, time() + 240, URL_SITE."/include/getResults.php");

		$Hmobility = "{$_POST['mobility']}";
		setcookie("sessionFilterCITY[mobilityFilter]", $Hmobility, time() + 240, URL_SITE."/include/getResults.php");

}
	else{
		exit;
	}

}

// verif infos cookies enregistrés
echo "<pre>";
print_r($_COOKIE['sessionFilterCITY']);
echo "</pre>";

/*
 result view
 */

//register mustache library
require 'libs/Mustache/Autoloader.php';
Mustache_Autoloader::register();

//set the template for Mustache
$template = file_get_contents("template/resultats.html");

//create a new object establishment
<<<<<<< HEAD
	if (isset($_COOKIE['sessionFilter'])) {
		$arrayFilter = $_COOKIE['sessionFilter'];
	}
	else {
		$arrayFilter = [];
	}
=======
$arrayFilter = $_COOKIE['sessionFilterCITY'];
>>>>>>> origin/master

if (!empty($myCity)) { //si on a choisi une ville
	//print_r($arrayFilter);
	$e = new establishment();
<<<<<<< HEAD
	$d["item"] = $e->findByCity($myCity, $arrayFilter);
	$d["LongitudeCarte"] = $e->d[0]['Longitude'];
	$d["LatitudeCarte"] = $e->d[0]['Latitude'];
}

elseif (!empty($name)){
	$e = new establishment($name);
=======
	$d["item"] = $e->findByCity($myCity, $arrayFilter); // Pour ce 2ème argument => il faut modifier la requête dans establishment.class.php
	$d["LongitudeCarte"] = $e->d[0]['Longitude'];
	$d["LatitudeCarte"] = $e->d[0]['Latitude'];

// verif infos du tableau d
	echo "<pre>";
	echo "infos depuis variable d : <br/>";
	print_r($d);
	echo "</pre>";
}

elseif (!empty($id)){
	$e = new establishment($id);
>>>>>>> origin/master
	$d["item"] = $e->d;
	$d["LongitudeCarte"] = $e->d['Longitude'];
	$d["LatitudeCarte"] = $e->d['Latitude'];

}

elseif (!empty($Longitude)&&!empty($Latitude)) {
	$e = new establishment();
	$d["item"] = $e->findByCoord($Longitude, $Latitude);
	$d["LongitudeCarte"] = $Longitude;
	$d["LatitudeCarte"] = $Latitude;
}
else{
	//echo "erreur choix nuls";
	exit;
}

//start the mustache engine
$m = new Mustache_Engine;
//render the template with the set result
echo $m->render($template, $d);
<<<<<<< HEAD
=======


?>
>>>>>>> origin/master
>>>>>>> origin/master
