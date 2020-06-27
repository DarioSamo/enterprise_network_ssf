<?php

function executeCommandIn($address, $command) {
  $username = "root";
  $password = "debian";
  $cmdstr = "sshpass -p " . $password . " ssh " . $username . "@" . $address . " \"" . $command . "\"";
  exec($cmdstr, $output, $result_var);
  if ($result_var != 0) {
    echo $command . " fallo en " . $address . "<br>";
  }
}

?>