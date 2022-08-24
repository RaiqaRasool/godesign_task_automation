## Features
This is invoice generator that can perform following functionalities:

1. Creating new invoice.
2. Preview or Download Invoice pdf.
3. Retrieving previous invoices.
4. Editing or Deleting previous invoices.


It also specify two roles of users as admin or normal user. Admin can perform these additional operations:

1. Creating new user.
2. Editing or Deleting previous users.


This project use PHP and MySQL database thus can be deployed easily on any hosting. 
For PDF creation this project use DomPdf.

## Prerequisites

* You should have some PHP supporting web server available

## How to use?

1. Go to Document-Root(Directory that forms the main document tree visible from the web mostly have name www,htdocs etc.) of PHP web server.
3. And execute following commands:
```
 git clone https://github.com/RaiqaRasool/invoice_generator.git
 
 cd invoice_generator
 git clone https://github.com/dompdf/dompdf.git
 cd dompdf
 composer install

```
4. Go to MySQL DBMS and create database now run the SQL script given in database folder of repo
5. Come to folder and edit password, host and username in config.php based on what are there values for your db.
6. By default a user with email root@gmail.com and password raiqa will be created with admin rights use it to   login the and use the app
7. To customize the PDF of invoice go to invoice_pdf.php and edit html code in loadHtml()

