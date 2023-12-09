# SE-Project

This is a web application built using HTML, CSS, JavaScript (front-end), PHP, and MySQL . It requires certain environment settings for proper execution. Follow the instructions below to run the code and set up the necessary environment.

# Prerequisites

## Before running the web application, make sure you have the following software installed on your computer:

1. ### PHP:

- Install PHP on your system by following the official installation instructions for your operating system. You can download the PHP installation package from the official PHP website: https://www.php.net/downloads.php

- Configure PHP
  From the System Properties window, click on the Advanced tab, and then click on the Environment Variables button at the bottom. Select the Path variable from the System Variables section, and then click on Edit. Add: path:path\php to your system path. Click OK until you have exited the System Properties window.

2. ### MySQL:

Set up a MySQL database server to host the application's database. You can install MySQL locally on your computer or use a remote MySQL server.

# Installation and Setup

## To run the web application and connect it to your own database, follow these steps:

1. Clone the repository: Start by cloning this repository to your local machine using the following command:

```
   git clone https://github.com/Cyuen0310/SE-Project.git
```

2. Configure the database connection: Open the db_conn.php file located in the project's root directory. Edit the database connection parameters according to your MySQL server configuration. Update the following lines with your own database details:

```
  <?php
    $db_server = "hostname";
    $db_user = "your_username";
    $db_pass = "your_password";
    $db_name = "your_database_name";
   ?>
```

3. Host the database: Create a MySQL database on your server that will be used by the web application. Import the provided SQL file (ARS.sql) into your database to set up the required tables and data.

4. Start a web server: Set up a local web server on your machine to run the web application. You can use tools like XAMPP, WAMP, or MAMP, which provide a pre-configured environment for PHP development. Alternatively, you can use the built-in PHP development server by running the following command from the project's root directory:
   php -S localhost:8000

5. Access the web application: Once your web server is running, open a web browser and navigate to http://localhost:8000 to access the web application.

# Troubleshooting

If you encounter any issues or errors while running the web application, please make sure you have followed the installation and setup instructions correctly. Additionally, check that your PHP and MySQL installations are properly configured.
