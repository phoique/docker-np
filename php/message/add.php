<?php
  header("Content-Type: application/json");

  // php json body parse
  $body = json_decode(file_get_contents('php://input'), true);

  $main_response = array(
    "status" => false,
    "desc" => "",
    "result" => []
  );

  if(isset($body['message'])) {

    // mysql conn
    try {
      $db = new PDO("mysql:host=database_mysql;dbname=example;charset=utf8", "root", "password1");
    
      // create table
      $sql ="CREATE table messages(
        ID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
        message VARCHAR( 50 ) NOT NULL
        );";
      
      $db->exec($sql);
  
    } catch (PDOException $e){

      $main_response = array(
        "status" => false,
        "desc" => "An error occurred!",
        "error" => $e->getMessage()
      );

      echo json_encode($main_response);
    }
  
    // insert message
    $query = $db->prepare("INSERT INTO messages SET message = ?");
    $insert = $query->execute(array($body['message']));
    
    if ($insert) {
      $main_response = array(
        "status" => false,
        "desc" => "Message added.",
        "result" => true
      );

      echo json_encode($main_response);
    }
    else {
      $main_response = array(
        "status" => false,
        "desc" => "Message could not be added!",
      );

      echo json_encode($main_response);
    }

  }
  else {
    $main_response = array(
      "status" => false,
      "desc" => "message cannot be empty!"
    );
    echo json_encode($main_response);
  }
  
?>
