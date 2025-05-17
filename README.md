# 2025-app-comp-u1o2
so far only login and signup works
<br>
if you click projects -> Pay Calculator there is a blank page where i will make the paycalc
<br>
<br>
**How to set up table/database**
<br>
<br>
First set up xampp
<br>
Then run apache and mysql
<br>
In phpmyadmin run this sql script (put it in a database called users_db)
```
CREATE TABLE IF NOT EXISTS users (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    email VARCHAR(40) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
    password VARCHAR(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
);
ALTER TABLE users
ADD UNIQUE INDEX username (username);

ALTER TABLE users
ADD UNIQUE INDEX email (email);
```
<br>

**for windows**
<br>
<br>
Where the xampp root folder is navigate to "htdocs"
<br>
In htdocs make a new directory:
<br>
0\school\2025yr11php\ --> now clone the repo into this folder then wallah
