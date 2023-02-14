# godesign_task_automation

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
