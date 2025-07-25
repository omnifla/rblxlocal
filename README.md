# RBLX.local
> [!WARNING]
> RBLXLocal is still incomplete, report bugs on the Issues tab.

An open source 2014M ROBLOX clone, using ROBLOX's source as a guidance.

## Authors
- [meditext](https://github.com/TheGuyWhoIsIdiot)
- [Carbon](https://github.com/Carbonapi)
- [SkylerClock](https://github.com/SkylerClockYT)
- [exrand](https://github.com/randomyaps)
- [newuser](https://github.com/randomyaps)
- [Kqsane](https://github.com/kqsane)
- [watrabi](https://github.com/watrabi)

## Contributors
- [Waylon](https://github.com/WayloFunk)
- [floof](https://github.com/verify-stack)
- [omnifla](https://github.com/omnifla)
- [Denied_ID](https://github.com/denied-id)

## Deployment

Before you deploy this on your main hardware, make sure you have installed the following stuff
- [PostgreSQL](https://www.postgresql.org/download/)
- IIS (Enable it on Windows Features)
- [Composer](https://getcomposer.org/download/)
- [PHP 8.3+](https://www.php.net/manual/en/install.php)
---------
This isn't required really, but makes your life easier as it provides very important resources.
- [rbx-api-service](https://github.com/verify-stack/rbx-api-service)
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
