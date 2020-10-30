<?php
  header("Content-Type: application/json");

  try {
    $db = new PDO("mysql:host=localhost;dbname=example;charset=utf8", "root", "");
  
    $sql ="CREATE table messages(
      ID INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
      message VARCHAR( 50 ) NOT NULL
      );" ;
    
    $db->exec($sql);

  } catch ( PDOException $e ){
    echo json_encode(array(
      "status" => false,
      "desc" => "An error occurred!",
      "error" => $e->getMessage()
    ));
  }

  $query = $db->prepare("INSERT INTO messages SET message = ?");
  $insert = $query->execute(array("Tayfun Erbilen"));
  
  if ( $insert ){
      $last_id = $db->lastInsertId();
      print "insert işlemi başarılı!";
  }
  
?>


