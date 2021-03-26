<?php

class Conexion{

	public static function conectar(){

		$link = new PDO("mysql:host=65.99.225.36;dbname=kusoftde_jaes_pruebas","kusoftde_edgar_edmin","mZz{mQ,GU0kr");
		return $link;

	}

}

?>