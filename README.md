# DeckSymfony

Created by Ines LEGAUD & Ulysse ARNAUD

## Installation

You will need PHP 7.4 or newer to install this project.

At first, install all the dependencies needed for the project via Composer and Yarn.

```
composer install
yarn
```

Next, you have to prepare the database.

```
php bin/console doctrine:database:create
php bin/console doctrine:schema:update --force
```

## Usage

You have to build static files and launch local server.

```
yarn encore dev
symfony server:start
```

Your website may be launched at http://localhost:8000.

You may have to edit the environment file `.env` to configure the project.

## Features which could be created
* Decks
* Remove cards
* Edit cards
* Profile settings
* and maybe more