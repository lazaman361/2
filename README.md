## My goal was to...

**[English]**

Make a website with an administration system. It is necessary for the website to provide the following functionalities: 

- Login and registration.
- News feed.
- Adding comments.
- News feed by categories (there is a navigation menu which enables choosing news by category).
- Adding and removing news that only the website administrator can do.
- Adding and removing comments that the website administrator can do.
- Every user should be able to remove his own comments.

**[Serbian/Srpski]**

Napraviti web sajt i odgovarajući sistem administracije za njega. Potrebno je da sajt obezbeđuje sledeće funkcionalnosti:

- Logovanje i registraciju korisnika.
- Prikaz vesti.
- Dodavanje komentara.
- Prikaz vesti po kategorijama (na strani postoji navigacioni meni kroz koji se bira prikaz vesti za svaku kategoriju).
- Dodavanje i uklanjanje vesti koje može da vrši samo administrator sajta.
- Dodavanje i uklanjanje komentara koje može da vrši administrator sajta.
- Obezbediti svakom korisniku mogućnost da briše svoj komentar.

## Requirements (Windows/Linux)

- **Wampserver 3.0.9**+ (http://www.wampserver.com/en/)

OR, individually:

- **PHP 5.6**+ (http://php.net/downloads.php). Note: PHP 7 is just fine, too.
- **Apache 2.4.23**+ (https://httpd.apache.org/download.cgi).
- **MySQL 5.7.14**+ (https://dev.mysql.com/downloads/mysql/).
- **phpMyAdmin 4.6.4**+ (https://www.phpmyadmin.net/downloads/) or **MySQL Workbench 6.3**+ (https://dev.mysql.com/downloads/workbench/), which is similar to phpMyAdmin, but with a nicer GUI and more advanced features.

## How to check the website offline (on your own computer)

1. Start the Wampserver.
2. Create Database (using phpMyAdmin or MySQL Workbench). Remember the database name for step 4.
3. Import "data_export.sql" and "data_export_extra.sql" to your database.
4. Configure "config.php" to your needs. DB_NAME is the one created in step 2. As an aditional feature, you can allow only certain IPs to login. To do that, please uncomment $allowedIPs in "config.php" and in "login.php".
5. git clone this repository to (default folder of x64 Wampserver on Windows) c:\wamp64\www\
6. Start your browser and visit 'http://localhost/'

## Experiencing responsiveness issues on the given website? Please be patient or try again later :)

Please be patient if the website is slow, it's on a free web hosting.