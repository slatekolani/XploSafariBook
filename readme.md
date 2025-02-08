## **Project Title**
NEXT PROJECT

## **Getting Started**

This is NextProject template for Nextbyte laravel projects.

## **Prerequisites**

- PHP Web Server (Nginx)
- Postgres Database
- 

## **Installing**

- 1. Copy .env.example to .env (For Linux:  cp .env.example .env ) & .env.example to .env.testing
- 2. i) Install all dependent packages using composer (composer install)
    ii) 
- 3. (Linux Only) make write permission on the folder storage, bootstrap/cache, .env
- Steps 4
- _chmod 777 -R storage_
- _chmod 777 -R bootstrap_
- _chmod 777 -R .env_
- _chmod 777 /home/var/www/html_

- 4. Create the following folders
#_storage/app/public/application (For linux: mkdir -p storage/app/public/application)_


- 5. Create a link to the storage directory : **php artisan storage:link**

(Can be skipped - Step 1 to 3)
## Securing Sensitive Environment Variables
- 1. Issue the following command, `php artisan tinker`
- 2. >>> $c = new \Illuminate\Encryption\Encrypter(config("env.key"));
     => Illuminate\Encryption\Encrypter {#765}
     # encrypt your plain text values
     >>> $c->encrypt("Some Value");
- 3. To refer to the protected environment use the helper function `sec_env`

## Support for real time notification

[Linux Dependent]
- 1. Install Redis 
     _(Key-Value Database)_
     CentOS  : **yum install redis**
               **service redis start / systemctl start redis**
               **chkconfig redis on**
               git p
               **yum install nodejs**
               _(JavaScript runtime)_
  
- 2. In the subfolder nodejs in the root directory
      Install : **npm install**     
               
- 3. NodeJS will be set to listen on port 8890

- 4. Install (NodeJS Noarch) 
      _(Grunt is a JavaScript library used for automation and running tasks)_
      CentOS  : **npm install -g grunt**
- 5. Install laravel-echo-server
     npm install -g laravel-echo-server
     
     Issue the following command to initialize laravel echo server configuration
     laravel-echo-server init

Note: (Tested Versions)
npm v6.4.0
nodejs v8.11.4

- 5. Create file nodejs/Server/config/constants.js
     Add the following contents
     var port = "8890";
     module.exports.port = port;

## **Running the tests**


## **Deployment**



## **Built With**

- Laravel - Laravel PHP Framework.  (Current ver 5.6)
- Composer - PHP Dependency Management.
- MySql - Database Management System.

## **Contributing**

Not Applied.

## **Version Control**

We use Git for version control. For the versions available, see the tags on this repository.

## **Authors**

- [Nextbyte](info@nextbyte.co.tz)



## **License**

This project is licensed to Nextbyte ICT Solutions.

## **Copyright**

This project work is copyrighted to Nextbyte ICT Solutions.

## **Acknowledgments**


## **Similar Work**


## Design Template Used


## Template Url


## Supervisor Sample Configuration

Change the memory limit in php.ini file
memory_limit = 1024M
memory_limit = 512M
memory_limit = 128M

[program:oas_horizon]
process_name=%(program_name)s_%(process_num)02d
command=php /var/www/html/oas/artisan horizon
autostart=true
autorestart=true
user=root
numprocs=2
redirect_stdout=true
redirect_stderr=true
stdout_logfile=/var/log/supervisor/oas_horizon.log
stdout_logfile_maxbytes=1MB
stderr_logfile=/var/log/supervisor/oas_horizon_stderr.log
stderr_logfile_maxbytes=1MB

[program:oas_echo_server]
process_name=%(program_name)s_%(process_num)02d
directory=/var/www/html/tbs_oas
command=laravel-echo-server start
autostart=true
autorestart=true
user=gwanchi/linux_user
numprocs=1
redirect_stdout=true
redirect_stderr=true
stdout_logfile=/var/log/supervisor/oas_echo_server.log
stdout_logfile_maxbytes=1MB
stderr_logfile=/var/log/supervisor/oas_echo_server_stderr.log
stderr_logfile_maxbytes=1MB


## For Task Scheduling for background processes
For **CentOS** : Make sure that **_cronie & cronie-anacron_** is installed by issuing the following command 
_`rpm -q cronie cronie-anacron`_

Edit file /etc/crontab, add the following entry

* * * * * {user} php /path-to-your-project/artisan schedule:run >> /dev/null 2>&1

## Date Formats
This system use the php date format Y-n-j or optionally Y-m-d, and use the helper function _fix_form_date_ to convert the date into format YYYY-MM-DD before saving into the database.

##Sample Seeds
Enable Users Seed
Default User 
email : admin@tbs-oas.go.tz
password : TBSOASadmin
