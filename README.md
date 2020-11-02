# laravel-game-essentials

[![Packagist](https://img.shields.io/packagist/v/furic/game-essentials)](https://packagist.org/packages/furic/game-essentials)
[![Packagist](https://img.shields.io/packagist/dt/furic/game-essentials)](https://packagist.org/packages/furic/game-essentials)
[![License](https://img.shields.io/github/license/furic/laravel-game-essentials)](https://packagist.org/packages/furic/game-essentials)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/furic/laravel-game-essentials/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/furic/laravel-game-essentials/?branch=main)
[![Build Status](https://scrutinizer-ci.com/g/furic/laravel-game-essentials/badges/build.png?b=main)](https://scrutinizer-ci.com/g/furic/laravel-game-essentials/build-status/main)

> Game Essentials for [Laravel 5.*](https://laravel.com/). This package is required and used by few packages in [Sweaty Chair Studio](https://www.sweatychair.com) creating the basic data and essential functions for a gaming server backend. This provides functions such as registering players and assign the players in a game. After that the data can be used for analytics purpose.

> If you are using other packages that requires this package, this will be added automatically and you do not need to install it manually. However, you can still use this package alone without using other packages.

## Table of Contents
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
    - [Web Console](#web-console)
    - [Redeem Code Parameters](#redeem-code-parameters)
    - [Redeem Validator API](#redeem-validator-api)
    - [Unity Client Repo](#unity-client-repo)
- [TODO](#todo)
- [License](#license)

## Installation

Install this package via Composer:
```bash
$ composer require furic/game-essentials
```

> If you are using Laravel 5.5 or later, then installation is done. Otherwise follow the next steps.

#### Open `config/app.php` and follow steps below:

Find the `providers` array and add our service provider.

```php
'providers' => [
    // ...
    Furic\GameEssentials\GameEssentialsServiceProvider::class
],
```

## Configuration

Publish config & migration file using Artisan command:
```bash
$ php artisan vendor:publish
```

To create table for redeem codes in database run:
```bash
$ php artisan migrate
```

## Usage

### Game Parameters

A game has following parameters:
```
            $table->string('name', 128);
            $table->smallInteger('version_ios')->unsigned();
            $table->smallInteger('version_android')->unsigned();
            $table->smallInteger('version_tvos')->unsigned();
```
- Name: The name of the game/app.
- iOS Version: The latest version number in iOS, used for force update in client.
- Android Version: The latest version number in Android, used for force update in client.
- tvOS Version: The latest version number in tvOS, used for force update in client.

### Player Parameters

A game has following parameters:
```
            $table->string('facebook_id', 128)->nullable();
            $table->string('gamecenter_id', 128)->nullable();
            $table->string('playgames_id', 128)->nullable();
            $table->string('udid', 128);
            $table->string('name', 128)->nullable;
            $table->string('ip', 15);
```
- Facebook ID: The Facebook ID of a player. (Optional)
- Game Center ID: The Game Center ID of a player in iOS. (Optional)
- Google Play Games ID: The Google Play Games ID of a player in Android. (Optional)
- UDID: The unique device UDID of a player. If the player is using multiple devices, only the first device UDID is used here.
- Name: The name of the player input in game/app. (Optional)
- IP: The IP of the player when being first seen.

### Player Parameters

Finally, a player-game has following parameters:
```
            $table->integer('player_id')->unsigned();
            $table->integer('game_id')->unsigned();
            $table->tinyInteger('channel')->unsigned();
            $table->smallInteger('version')->unsigned();
            $table->boolean('is_hack')->default(false);
```
- Player ID: The ID of a player.
- Game ID: The ID of a the game that player launched.
- Channel: The channel of the player getting into the game. Mostly used for Android players, e.g. Sumsung Store, Huawei App Gallery, etc. (Optional)
- Version: The current game version that the player device running.
- Is Hacked: A boolean to mark if the player ever performed any hack in game, for analytics and limiting functions in client.

### API

GET `<server url>/games/{game-id}`
Returns a JSON data from a given game ID, for debug usage only.

GET `<server url>/games/{game-id}/versions`
Returns a JSON data containing the versions from a given game ID, for client checking the latest game version and perform force-update.

GET `<server url>/players/{player-id}`
Returns a JSON data from a given player ID, for debug usage only.

GET `<server url>/players/name/{player-name}`
Returns a JSON data from a given player name, for debug usage only.

POST `<server url>/players`
Creates a player with given POST data.

POST `<server url>/players/{player-id}`
Updates a player with a given player id and POST data.

GET `<server url>/games/{game-id}/players`
Returns a JSON array of all players from a given game ID, for debug usage only.

## TODO

- Create the web console to add/edit games.
- Add admin login for web console.
- Add tests.

## License

laravel-redeem-codes is licensed under a [MIT License](https://github.com/furic/laravel-game-essentials/blob/main/LICENSE).
