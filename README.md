## What is this?
Simple web service example using docker compose. Node.js, Php and Mysql was used in the web service part.

#### Run Docker compose
After downloading the repo, write to the console.
```
docker-compose up
```
if you made a change you will need to build.
```
docker-compose up --build
```

#### Mysql settings
While Compose is running, open a new console.
```
docker container ls
```
Find out the running mysql container id.

```
docker exec -it <mysql_container_id> mysql -u root -p
```
Type "password1" in the Password section.
After entering the container

```
ALTER USER 'root' IDENTIFIED WITH mysql_native_password BY 'password1';
```
```
flush privileges;
```
Write in order. [stackoverflow.com](https://stackoverflow.com/questions/50093144/mysql-8-0-client-does-not-support-authentication-protocol-requested-by-server)

#### Web service - Endpoint

For Php: 
- [index GET](http://localhost)
- [all messages POST](http://localhost/messages/index.php)
- [add message GET](http://localhost/message/add.php)

For Node.js
- [index GET](http://localhost:3000)
- [all messages GET](http://localhost:3000/messages)
- [add message POST](http://localhost:3000/message/add)