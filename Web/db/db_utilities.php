<?php
require_once('db_credentials.php');
$mysqli= new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
$result = '';


if ($mysqli -> connect_errno)
{
	echo 'Error en la conexión';
	exit;
}

function deleteEstudiante($id)
{
		global $mysqli;
	    $sql="DELETE FROM estudianteXequipo WHERE estudianteID=$id";
	    $mysqli->query($sql);
}

function deleteRespuesta($id)
{
		global $mysqli;
	    $sql="DELETE FROM respuesta WHERE ID=$id";
	    $mysqli->query($sql);
}

function deletePregunta($id)
{
		global $mysqli;
	    $sql1="DELETE FROM respuesta WHERE preguntaID=$id";
		$sql2="DELETE FROM pregunta WHERE ID=$id";
	    $mysqli->query($sql1);
		$mysqli->query($sql2);
}

