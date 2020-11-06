const express = require("express");
const mysql = require("mysql");
const app = express();

// Express body parser.
app.use(
  express.json(),
  express.urlencoded({ extended: false })
);

app.get("/", (req, res) => {
  res.status(200).json({
    status: true,
    desc: "Node.js Web Service"
  });
});

// Message add endpoint
app.post("/message/add", (req, res) => {

  // Mysql conn
  let conn = mysql.createConnection({
    host: "database_mysql",
    user: "root",
    password: "password1",
    database: "example",
    port: "3306",
    insecureAuth : true
  });

  // if there is an error in mysql conn
  conn.connect((err) => {
    if(err) throw err;
  });

  var main_response = {
    status: false,
    desc: "",
    result: []
  };

  if(req.body.message === undefined) {
    main_response = {status: false, desc: "message cannot be empty!"};
    return res.status(400).json(main_response);
  }

  // Create table query
  var createTableSql = `CREATE TABLE IF NOT EXISTS messages(
    id INT AUTO_INCREMENT PRIMARY KEY,
    message VARCHAR(50) NOT NULL
    )`;

  // Create table
  conn.query(createTableSql, (err, result) => {
    if(err) {
      main_response = {status: false, desc: "table could not be created."};
      return res.json(main_response);
    }
  });

  // add message query
  var addMessageSql = `INSERT INTO messages SET ?;`;
  var messageData = {message: req.body.message};

  // add message
  conn.query(addMessageSql, messageData, (err, result) => {

    if(err) {
      main_response = {status: false, desc: "Message could not be added!"};
      return res.json(main_response);
    }
    else {
      main_response = {status: true, desc: "Message added.", result: true};
      return res.status(201).json(main_response);
    }

  });

});

// all messages endpoint
app.get("/messages", (req, res) => {

  // Mysql conn
  let conn = mysql.createConnection({
    host: "database_mysql",
    user: "root",
    password: "password1",
    database: "example",
    port: "3306",
    insecureAuth : true
  });

  // if there is an error in mysql conn
  conn.connect((err) => {
    if(err) throw err;
  });

  var main_response = {
    status: false,
    desc: "",
    result: []
  };

  // Create table query
  var getMessagesSql = `SELECT * FROM messages LIMIT 100`;

  // Create table
  conn.query(getMessagesSql, (err, result) => {
    if(err) {
      main_response = {status: false, desc: "An error occurred."};
      return res.json(main_response);
    }
    else {
      if(result.length > 0) {
        main_response = {status: true, desc: "messages listed.", result};
        return res.status(200).json(main_response);
      }
      else {
        main_response = {status: true, desc: "messages not found!", result};
        return res.status(404).json(main_response);
      }
    }
  });

});


app.listen(3000, () => console.log("Node.js Web Service - 3000"));