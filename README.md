# contacts-app

## Installing

### 1.Install Apache,PHP and MySQL 

- You should follow the tutorial on this [link](https://www.unixmen.com/how-to-install-lamp-stack-on-ubuntu-16-04/)
- Don't forget to memorize the mysql user and password

### 2.Install composer

- You should also have the composer installed in your environment follow this [link](https://getcomposer.org/doc/00-intro.md)

### 3.Install git

- You should also install git in your environment and have an account on github follow this [link](https://www.atlassian.com/git/tutorials/install-git)

### 4.Create a database

- Open your terminal and write `mysql -u mysql-user -p` then enter the password
- Run the following command `CREATE DATABASE your-database-name`

### 5.Install the application

- Create a directory for the application
- Open your terminal in this directory and run `git clone https://github.com/miessam16/contacts-app.git` to download the project code
- Then run `composer install` to install laravel packages
- Edit .env file and add the database name , user and password
- Migrate the database tables by using `php artisan migrate` command
- Seed the mock data to the database by using `php artisan db:seed` command

### 6.Running the project

- Now just run `php artisan serve` and go to localhost:8000 in your browser to check the project you can login using the following credentials **admin@test.com** **secret** or you can register with a new user
- To run the tests use the following command `php artisan dusk`
