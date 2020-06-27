<?php

require("execute_remote.php");

// Main
$USERNAME = $_POST["uname"];
$PASSWORD = $_POST["psw"];
if (empty($USERNAME) || empty($PASSWORD)) {
  die("Username and password can't be empty.");
}

$PASSWORD_HASH = $PASSWORD;
$DBSERVER = "db.patora.roca";
$DBNAME = "patora";
$conn = new mysqli($DBSERVER, "admin", "12345", $DBNAME);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Agregar a base de datos.
$SQL = "INSERT INTO USERS (name, pwdhash) VALUES('" . $USERNAME . "', '" . $PASSWORD_HASH . "')";
if ($conn->query($SQL) === TRUE) {
  // Crear usuarios en Mail y SFTP.
  $command = "/usr/scripts/create_client.sh " . $USERNAME . " " . $PASSWORD;
  executeCommandIn("mail.patora.roca", $command);
  executeCommandIn("sftp.patora.roca", $command);
  echo "Usuario registrado.<br>";
}
else {
  echo "El usuario ya existe.<br>";
}

?>