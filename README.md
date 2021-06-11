# DocTech

# Description:
DocTech is a web application directed to doctors and hospitals to provide the service of creating and following up medical reports for patients in an instant and remote manner

# Getting Started
# Tree (Mind_Map):
![Diagram](https://user-images.githubusercontent.com/46310934/121714609-ec864780-cad5-11eb-9274-5296779a1c75.png)
Format: ![Alt Text](url)
=============================================
# Tools:
1/ Database
MySQL Database (Php, My Admin)
Server Xamp
2/ Backend
API Development 
- Php
- Testing by Postman
- IDE Subline
3/ Frontend
- Angular
- IDE: Visual Studio Code 2019
=============================================
# To use
# Step 1_Database: 
you need to:
- Xamp server (for Apache 2 MySQL) Server
- Php My Admin
# Scheme of Database:
![GitHub Logo](C:\Users\amirl\Pictures\Diagram.png)
Format: ![Alt Text](url)
# Note:
1- DB SQL is a file attached on the name "Medecale.sql".
2- Import "medecale.sql" on php My Adminto get all tables with their informations.
# Step 2 API_Rest_Backend: 
If you want to test the API Rest Backend (Which is coded using Php in the attached folder API_Dossier)
Just Import Collection "WebAPI_Test.postman_collection" into postman (for this step you need to istall postman)
# Step 3 HopTech_Frontend:
- Run "undex.html" page from the "HopTech" project on the Browser 
- Follow the next steps:
1.Doctor choose the name of hospital (if doctor is logout or new),automated show services list to choose his service where he work
2.Doctor make login with his username and password (if doctor enter wrong informations, a message appear to know him or for signup else home page appear)
3.Home page contain Liste of medicale reports with their numbers and three buttons witch are:
3.1.Button1(Show report): will show informations of this report
3.1.Button2(Add report): 
To add report you must to :
  1.Choose a patient from Dropdown list if exist, if not Doctor shoud enter all informations of new patient then continue enter informations of consultation:
  Diagnostic; Amount; Also choose the drags list prescriped 
4.For extract report medicale for this patient comme file txt  
