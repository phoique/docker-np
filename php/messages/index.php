<?php
  header("Content-Type: application/json");

  $main_response = array(
    "status" => false,
    "desc" => "",
    "result" => []
  );

  // mysql conn
  try {
    $db = new PDO("mysql:host=localhost;dbname=example;charset=utf8", "root", "");

  } catch (PDOException $e){

    $main_response = array(
      "status" => false,
      "desc" => "An error occurred!",
      "error" => $e->getMessage()
    );

    echo json_encode($main_response);
  }

  // get all messages
  $query = $db->prepare("SELECT * FROM messages LIMIT 100");
  $query->execute();
  $result=$query->fetchAll();
  
  if ($query) {
    $main_response = array(
      "status" => false,
      "desc" => "Messages listed.",
      "result" => $result
  );

    echo json_encode($main_response);
  }
  else {
    $main_response = array(
      "status" => false,
      "desc" => "Messages not found!",
  );

    echo json_encode($main_response);
  }
  
?>