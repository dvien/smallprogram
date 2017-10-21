# PHPWord

This repository is an source code of [PHPWord](http://phpword.codeplex.com/), turned into [Composer](http://getcomposer.org/) package.

The idea is similiar to [phpexcel/phpexcel](https://github.com/ddeboer/phpexcel), developed by [ddeboer](https://github.com/ddeboer).

## Installation
All you have to do is to [get composer](http://getcomposer.org/download/) and add following lines to your `composer.json`:

        "require": {
           "phpword/phpword": "*"
        }

After that, use composer to install all dependences with:

        $ ./composer.phar install

## Usage

You have to require your autoloader, generated automaticly by Composer.

        <?php
        require_once "vendor/autoload.php";

After that, you may call PHPWord library calling

        $doc = new \PHPWord();


