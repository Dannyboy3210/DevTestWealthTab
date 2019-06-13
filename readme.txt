Daniel Stellema Dev Test for WEALTHTAB April 22, 2019

Tasks:

- create REST API with bearer authentication and 2 database collections - Done.
- allow us to store 2 PDFs - Can upload 1 pdf at a time but every user may store multiple pdfs in the database.
- password protect both PDF documents from being opened on the client - Not Completed

backend to be used: Laravel, mySQL or equivalent for DB - Laravel/mySQL used.

optional: create Javascript client (web app) to connect to the REST API, the client should allow 2 PDFs to be uploaded


How to run instructions:

While using Vagrant to ssh into your homestead instance, go to ~/code and run the command: 
artisan migrate:fresh 
to create databases.

Visit Home page by going to http://192.168.10.10

In the top right, click on Home button.
To log in, either register a new account or log into your existing account.
Register a new user account using the register button.
Log in using the login button.

Click on Manage PDFs to go to PDF Management page.

Click on Choose File to select the file you wish to upload. Then click on Upload button to upload file.

It does not yet validate that you have submitted a pdf file.
It does not yet allow you to upload two pdfs simultaneously.

Currently a successful upload will display a page containing showing the user_id, pdf_name, pdf, updated_at, created_at and id fields. 

Please click on your browser's back button to return to the preceding page.

Click on List to see all uploaded PDFs.
It does not yet allow you to view individual PDFs.
It does not yet ask you for a password to view the individual PDFs.


