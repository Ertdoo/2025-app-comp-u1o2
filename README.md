# 2025-app-comp-u1o2
so far only login and signup works
<br>
if you click projects -> Pay Calculator there is a blank page where i will make the paycalc
<br>
***passwords dont hash because its a school project so i want to see my password in the database table***
(adding a hashing and unhashing system would take like 3 lines anyway i think)
**also im using absolute paths for page redirects so changing the file structure may be a bit iffy**
<br>
<br>
**How to set up table/database**
<br>
First set up xampp 8.0.30 / PHP 8.0.30 (https://www.apachefriends.org/download.html)
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

**Directory setup (windows):**
<br>
Where the xampp root folder is navigate to "htdocs"
<br>
In htdocs make a new directory:
<br>
`0\school\2025yr11php\` --> now clone the repo and move it into this folder then wallah
<br>
<br>
**Directory setup (archlinux):**
<br>
cd into htdocs `cd /opt/lampp/htdocs`
<br>
In htdocs make a new directory:
<br>
now make this directory inside htdocs: `sudo mkdir -p 0/school/2025yr11php/`
<br>
now cd into it: `cd 0/school/2025yr11php/`
<br>
Make sure the directory is empty and now clone this repo: `git clone https://github.com/Ertdoo/2025-app-comp-u1o2 . --the dot indicates to clone in current directory (cd)`
<br>
or you can just do `sudo -E thunar` and just use the gui lol
<br>
<br>
now after you set up xampp and put the files in now start xampp with the gui or if ur on linux use `sudo /opt/lampp/lampp start` and enter this url into your browser: http://localhost/0/school/2025yr11php/
