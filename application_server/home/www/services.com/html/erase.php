<?php

require("execute_remote.php");
$USERNAME = $_POST["uname"];
$command = "/usr/scripts/lock_client.sh " . $USERNAME;
executeCommandIn("mail.patora.roca", $command);
executeCommandIn("sftp.patora.roca", $command);
echo "Usuario " . $USERNAME . " borrado.";

?>