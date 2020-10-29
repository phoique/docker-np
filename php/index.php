<?php
  header("Content-Type: application/json");

  echo json_encode(array(
    "status" => true,
    "desc" => "Php Web Service"
  ));
  
?>