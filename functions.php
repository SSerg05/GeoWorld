<?php
function connect() {
	$user = "root";
	$password = "";
	$dsn = "mysql:host=localhost;dbname=geoworld;port=3306;charset=utf8";
	$connetion = new PDO($dsn, $user, $password);
	$connetion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
	return $connetion;
}

function getContinents(PDO $connection) {
	$sql = "SELECT * FROM continents";
	$stmt = $connection->prepare($sql);
	$stmt->execute();
	$continents = $stmt->fetchAll();
	return $continents;
}

function getContinent(PDO $connection, $code) {
	$sql = "SELECT * FROM continents WHERE code=?";
	$stmt = $connection->prepare($sql);
	$stmt->execute([$code]);
	$continent = $stmt->fetch();
	return $continent;
}

function getCountriesByContinent(PDO $connection, $code) {
	$sql = "SELECT * FROM countries WHERE continent_code=?";
	$stmt = $connection->prepare($sql);
	$stmt->execute([$code]);
	$countries = $stmt->fetchAll();
	return $countries;
}

function getCountry(PDO $connection, $code) {
	$sql = "SELECT * FROM countries WHERE code=?";
	$stmt = $connection->prepare($sql);
	$stmt->execute([$code]);
	$country = $stmt->fetch();
	return $country;
}

function replaceUnderSpaceBySpace($str){
	// $str = ucwords($str, " \t\r\n\f\v");
	$str1 = str_replace("_", " ", $str);
	$str2 = ucwords($str1, " \t\r\n\f\v");
	return $str2;
}

function replaceSpaceByUnderSpace($str){
	// $str = ucwords($str, " \t\r\n\f\v");
	$str1 = str_replace(" ", "_", $str);
	return $str1;
}


function searchCountry(PDO $connection, $nameCountry) {
	$sql = "SELECT * FROM countries WHERE name LIKE ?";
	$stmt = $connection->prepare($sql);
	$value = $nameCountry.'%';
	$stmt->execute(array($value));
	$countries = $stmt->fetchAll();
	return $countries;
}