## Features
This is invoice generator that can perform following functionalities:

1. Creating new invoice.
2. Preview or Download Invoice pdf.
3. Retrieving previous invoice.
4. Editing or Deleting previous invoice.


It also specify two roles of users as admin or normal user. Admin can perform these additional operations:

1. Creating new user.
2. Editing or Deleting previous users.


This project used PHP and MySQL database thus can be deployed easily on any hosting. 
For PDF creation this project use DomPdf.

## Prerequisites

* You should have some PHP supporting web server available

## How to run?

1. Go to root directory of PHP web server.
2. Create a folder
3. Git clone the repository
4. Go to phpmyadmin of web server and run the SQL script given in database folder of repo
5. Come to folder and edit password, host and username in config.php based on what are there values for phpmyadmin.
5. By default a user with email root@gmail.com and password raiqa will be created with admin rights use it to   login the and use the app
6. To customize the PDF of invoice go to invoice_pdf.php and edit html code in loadHtml()