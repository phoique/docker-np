const express = require("express");
const app = express();

app.get("/", (req, res) => {
  res.status(200).json({
    status: true,
    desc: "Node.js Web Service"
  });
});

app.listen(3000, () => console.log("Node.js Web Service - 3000"));