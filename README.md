
# CMS for personal websites
> Content Management System for YOUR personal website and/or portfolio!

- [CMS for personal websites](#CMS-for-personal-websites)
  - [Demo:](#Demo)
  - [Installation:](#Installation)
  - [Adding gitignored files:](#Adding-gitignored-files)
  - [Setting up the database:](#Setting-up-the-database)
  - [Development:](#Development)
    - [Contributing](#Contributing)
    - [Deploying](#Deploying)

## Demo:
[My portfolio](https://jasper.lichte.info)

## Installation:
After running `npm i`, fire up `npm run build` to start the compilation.

## Adding gitignored files:
You will need to create following PHP classes to get the app running:
* `server/config/Credentials.php`

## Setting up the database:
There is a SQL schema for the database to be found at `server/database/db.sql`. Run those SQL commands on your db server.
Furthermore, you will need to specify the credentials to your database as constants in `server/config/Credentials.php`:
* `DB_HOST`,
* `DB_USERNAME`,
* `DB_PASSWORD`,
* `DB_NAME`

## Development:
* Run `npm run watch-ts` to listen for changes in the **TypeScript** code
* Run `npm run watch-sass` to listen for changes in the **Sass** code

### Contributing
Any help on this project is more than welcome! If indeed you want to help us out (in whatever form that might be), you can find a list of top-priority todo items in `contribute/todo.md`. Feel free to pick any of those due tasks and just start going to work on it!

### Deploying
Run `npm run prepare-deploy`. This will create a directory that only stores every file and directory necessary to publish the app.
You can specify the output directory in `deploy/prepare.js`: Simply customize the `targetDir` attribute in the passed json object.
