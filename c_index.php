<?php

require __DIR__ . '/model/UserModelClass.php';

session_start();

$user = $_SESSION["user"];

if ($user->getUserType() !== "C"){
	header("Location: /PdagangSystem/");
}

var_dump( $user );

echo "<br><br>Welcome to Contractor_Homepage";