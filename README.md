# Online Counselling System – Benue State University

A web-based counselling platform built with PHP and MySQL. Designed for student-counsellor interactions at Benue State University, providing a digital channel for mental health support and academic guidance.

##  Features

- Student registration & login
- Anonymous counselling session booking
- Counsellor dashboard with request management
- Admin panel for managing users and reports
- Basic messaging between student and counsellor

##  Tech Stack

- PHP (Procedural)
- MySQL
- HTML5 / CSS3
- XAMPP / Apache

##  Screenshots

> *check `/screenshots` folder for all Screenshots*  
> [Link](/screenshots)

##  Setup Instructions

1. Clone the repository  
   ```bash
   git clone https://github.com/isamaj20/online-counselling-system.git
   
2. Install [XAMPP / Apache](https://www.apachefriends.org/) and setup MySQL database


3. Import the Database

   - Go to http://localhost/phpmyadmin

   - Click "New", create a new database (e.g., my_project)

   - Click the database name, then go to the Import tab

   - Import `project_db` from `/db`folder and click Go
   

4. Update DB Connection in PHP
   - Go to `/php` and update `DBConnect.php`
   Update this lines:
   ```bash
    $host="localhost";
    $user="root";
    $password="your-db-password";//or leave blank if no password
    $dbName="your-db-name"; //database name you created

    
5. Go to `http://localhost:8000/`