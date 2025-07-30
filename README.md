> [!CAUTION]
> This revival is in **heavy development**, if you encounter bugs or anything related, please make an issue at the **Issues** tab.

<p align="center">
    <img src="https://github.com/rblx-local/rblxlocal/blob/main/n6a3dp.png#gh-dark-mode-only" width="420">
    <img src="https://github.com/rblx-local/rblxlocal/blob/main/n6a3dp.png#gh-light-mode-only" width="420">
</p>

<div align="center">
An open source 2014M ROBLOX clone, using ROBLOX's source as a guidance.
</div>

## Authors
- [meditext](https://github.com/TheGuyWhoIsIdiot)
- [Carbon](https://github.com/Carbonapi)
- [SkylerClock](https://github.com/SkylerClockYT)
- [exrand](https://github.com/randomyaps)
- [newuser](https://github.com/therealestnewuser)
- [Chloe](https://github.com/kqsane)
- [watrabi](https://github.com/watrabi)

## Contributors
- [Waylon](https://github.com/WayloFunk)
- [floof](https://github.com/verify-stack)
- [omnifla](https://github.com/omnifla)

## Deployment

Before you deploy this on your main hardware, make sure you have installed the following stuff
> [!NOTE]
> *extra note for noobies: php 8.3+ required*
- [![PostgreSQL](https://img.shields.io/badge/PostgreSQL-4169E1?style=for-the-badge&logo=postgresql&logoColor=white)](https://www.postgresql.org/)
- [![IIS](https://img.shields.io/badge/IIS-0078D7?style=for-the-badge&logo=microsoft&logoColor=white)](https://learn.microsoft.com/en-us/iis/)
- [![Composer](https://img.shields.io/badge/Composer-885630?style=for-the-badge&logo=composer&logoColor=white)](https://getcomposer.org/download/)
- [![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/manual/en/install.php)
- Apache support soon

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

## FAQ
Coming soon...

## Features
- [x] Working feeds (but overall shitty, we will redo this)
- [x] Working user profiles (i think)

## Roadmap
- [ ] Add forums 
- [ ] Add working launcher
- [ ] Add renders
- [ ] Admin panel
- [ ] Add api.site.com apis other than /Setting/QuietGet

## Legalese
rblx-local does not use any official ROBLOX and ROBLOX Corporation code, all of this is our own code loosely based on legacy ROBLOX code.

> [!WARNING]
> no questioncawk allowed here noise and the people are actually having a whole world if we go to the site to do it tomorrow and then we have been doing the same happend and I have a great guy that has been a good thing and I was hoping it could get a fix the avatar page and edited the same happend 
