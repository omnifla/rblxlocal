## IIS Deployment 

Before you deploy this on your main hardware, make sure you have installed the following stuff
> [!NOTE]
> *extra note for noobies: php 8.3+ required*
- [![PostgreSQL](https://img.shields.io/badge/PostgreSQL-4169E1?style=for-the-badge&logo=postgresql&logoColor=white)](https://www.postgresql.org/)
- [![IIS](https://img.shields.io/badge/IIS-0078D7?style=for-the-badge&logo=microsoft&logoColor=white)](https://learn.microsoft.com/en-us/iis/)
- [![Composer](https://img.shields.io/badge/Composer-885630?style=for-the-badge&logo=composer&logoColor=white)](https://getcomposer.org/download/)

1. Setup IIS and PostgreSQL
2. Extract PHP and put it on `C:\PHP`
3. Go to `PHP.ini` (dev or prod) and enable `PDO_pgsql` and also enable `openssl` and other shit if the site requires that
4. Go to IIS and create a new CGI handle on Module Mapping with the request path being *.php and Module being `FastCGIModule` and the executable being `C:\php\php-cgi.exe` (this will allow IIS to use PHP and if u don't have `FastCGIModule` enable it on windows features it should be called CGI there)
5. In Default Documents add `index.php` there.
6. Make a new website on IIS and port it to `C:\rblxlocalwebsitefile\Main` (if something fails then u didn't give IUSR permission to use the website files)
7. Time for the website stuff, go to the site files and rename `.env-example` to `.env` only, put your PostgreSQL database credentials there aswell as other shit
8. Start the site and you should see the landing page, if you do then congrats but you're still not done yet as you will need to import `schema.sql` onto the database you chose and you should be good to go.

RBLXLocal API Service
---------
> [!NOTE]
> This isn't required really, but makes your life easier as it provides very important resources.
- [rbx-api-service](https://github.com/rblx-local/rbx-api-service)
- [node.js v20+](https://nodejs.org/en)

Now you've gotten everything installed, go into `rbx-api-service` and run `npm run createEnv`. It'll give you a wizard which creates the `.env` required for pretty much everything.

Afterwards, you need to run the migrations on the database via `npm run migrate`.
_____________________________________________________________________

## Apache Deployment

Before you deploy this on your main hardware, make sure you have installed the following stuff
> [!NOTE]
> *extra note for noobies: php 8.3+ required*
- [![PostgreSQL](https://img.shields.io/badge/PostgreSQL-4169E1?style=for-the-badge&logo=postgresql&logoColor=white)](https://www.postgresql.org/)
- [![Composer](https://img.shields.io/badge/Composer-885630?style=for-the-badge&logo=composer&logoColor=white)](https://getcomposer.org/download/)
- [![Apache](https://img.shields.io/badge/Apache-D22128?style=for-the-badge&logo=apache&logoColor=white)](https://https.apache.org/)

1. Make someone else write Apache instructions
2. Follow those instruction
