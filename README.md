

<div align="center">
<h1><b>RBLX.local</b></h1>

An open source 2014M ROBLOX clone, using ROBLOX's source as a guidance.
</div>

## Authors
- [meditext](https://github.com/TheGuyWhoIsIdiot)
- [Carbon](https://github.com/Carbonapi)
- [SkylerClock](https://github.com/SkylerClockYT)
- [exrand](https://github.com/randomyaps)
- [newuser](https://github.com/therealestnewuser)
- [Kqsane](https://github.com/kqsane)
- [watrabi](https://github.com/watrabi)

## Contributors
- [Denied_ID](https://github.com/denied-id)
- [Waylon](https://github.com/WayloFunk)
- [floof](https://github.com/verify-stack)
- [omnifla](https://github.com/omnifla)

## Deployment

Before you deploy this on your main hardware, make sure you have installed the following stuff
- [PostgreSQL](https://www.postgresql.org/download/)
- IIS (Enable it on Windows Features)
- [Composer](https://getcomposer.org/download/)
- [PHP 8.3+](https://www.php.net/manual/en/install.php)
- Apache support soon

1. Setup IIS and PostgreSQL
2. Extract PHP and put it on C:\PHP
3. Go to PHP.ini (dev or prod) and enable PDO_pgsql and also enable openssl and other shit if the site requires that
4. Go to IIS and create a new CGI handle on Module Mapping with the request path being *.php and Module being FastCGIModule and the executable being C:\php\php-cgi.exe (this will allow IIS to use PHP and if u don't have FastCGIModule enable it on windows features it should be called CGI there)
5. In Default Documents add index.php there.
6. Make a new website on IIS and port it to C:\rblxlocalwebsitefile\Main (if something fails then u didn't give IUSR permission to use the website files)
7. Time for the website stuff, go to the site files and rename .env-example to .env only, put your PostgreSQL database credentials there aswell as other shit
8. Start the site and you should see the landing page, if you do then congrats but you're still not done yet as you will need to import schema.sql onto the database you chose and you should be good to go.

RBLXLocal API Service
---------
This isn't required really, but makes your life easier as it provides very important resources.
- [rbx-api-service](https://github.com/rblx-local/rbx-api-service)
- [node.js v20+](https://nodejs.org/en)

Now you've gotten everything installed, go into `rbx-api-service` and run `npm run createEnv`. It'll give you a wizard which creates the `.env` required for pretty much everything.

Afterwards, you need to run the migrations on the database via `npm run migrate`.

## FAQ
Coming soon...

## Features
- Working feeds (but overall shitty, we will redo this)
- Working user profiles (i think)

## Roadmap
- Add forums 
- Add working launcher
- Add renders
- Admin panel
- Add api.site.com apis other than /Setting/QuietGet
