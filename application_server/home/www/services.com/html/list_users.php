<?php

$DBSERVER = "db.patora.roca";
$DBNAME = "patora";
$conn = new mysqli($DBSERVER, "admin", "12345", $DBNAME);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Agregar a base de datos.
$SQL = "SELECT id, name FROM USERS;";
$result = $conn->query($SQL);
$USERDATA = "";
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $USERDATA .= "<tr><td>" . $row["name"] . "</td><td>" . $row["id"] . "</td></tr>";
  }
}
else {
  $USERDATA = "No existen usuarios.";
}
?>

<html>
  <head>
    <title>Usuarios de Monsters Inc</title>
  </head>
  <body>
    <table>
      <tr>
        <th>Nombre</th>
        <th>Id</th>
      </tr>
      <?php echo $USERDATA; ?>
    </table>
  </body>
</html>