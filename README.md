# CMS for personal websites

## Installation:
After running `npm i`, fire up `npm run build` to start the compilation.

## Adding gitignored files:
You will need to create following PHP classes to get the app running:
* `config/Credentials.php`

## Setting up the database:
There is a SQL schema for the database to be found at `server/database/db.sql`. Run those SQL commands on your db server.
Furthermore, you will need to specify the credentials to your database as constants in `server/config/Credentials.php`:
* `DB_HOST`,
* `DB_USERNAME`,
* `DB_PASSWORD`,
* `DB_NAME`

## Development:
* Make sure you set the `PRODUCTION` flag to `false` in the `settings` table
* Run `npm run watch-ts` to listen for changes in the **TypeScript** code
* Run `npm run watch-sass` to listen for changes in the **Sass** code
