# CodeIgniter RestServer FGAC

[![StyleCI](https://github.styleci.io/repos/230589/shield?branch=master)](https://github.styleci.io/repos/230589)

A fully RESTful server implementation for CodeIgniter using one library, one config file and one controller.

In this Fork we implement a *Fine-grained Access Control* (FGAC) to allow Controllers and Methods.

The original code only allow you to control Access to Controllers, but we need more!

## Requirements

- PHP 7.2 or greater
- CodeIgniter 3.1.11+
- rmccue/requests

## Installation

git clone https://github.com/igorvc/codeigniter-restserver.git
composer require rmccue/requests


## Usage


Note that you will need to copy `rest.php` to your `config` directory (e.g. `application/config`)

Step 1: Add this to your controller (should be before any of your code)

```php
use chriskacerguis\RestServer\RestController;
```

Step 2: Extend your controller

```php
class Example extends RestController
```

Step 3: Configure rest.php to use REST Enable Keys and REST Method Access Control

```php
$config['rest_enable_keys'] = true;
$config['rest_enable_access'] = true;
```

Step 4: Add Table *REST Enable Keys* and *REST Method Access Control* (FGAC version)

```php
| Default table schema:
|   CREATE TABLE `keys` (
|       `id` INT(11) NOT NULL AUTO_INCREMENT,
|       `user_id` INT(11) NOT NULL,
|       `key` VARCHAR(40) NOT NULL,
|       `level` INT(2) NOT NULL,
|       `ignore_limits` TINYINT(1) NOT NULL DEFAULT '0',
|       `is_private_key` TINYINT(1)  NOT NULL DEFAULT '0',
|       `ip_addresses` TEXT NULL DEFAULT NULL,
|       `date_created` INT(11) NOT NULL,
|       PRIMARY KEY (`id`)
|   ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
|
|   CREATE TABLE `access` (
|       `id` INT(11) unsigned NOT NULL AUTO_INCREMENT,
|       `key` VARCHAR(40) NOT NULL DEFAULT '',
|       `all_access` TINYINT(1) NOT NULL DEFAULT '0',
|       `controller` VARCHAR(50) NOT NULL DEFAULT '',
|       `method` VARCHAR(200) NOT NULL DEFAULT '',
|       `date_created` DATETIME DEFAULT NULL,
|       `date_modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
|       PRIMARY KEY (`id`)
|    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;
|
```

## Basic GET example

Here is a basic example. This controller, which should be saved as `Api.php`, can be called in two ways:

* `http://domain/api/users/` will return the list of all users
* `http://domain/api/users/id/1` will only return information about the user with id = 1

```php
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Api extends RestController {

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
    }

    public function users_get()
    {
        // Users from a data store e.g. database
        $users = [
            ['id' => 0, 'name' => 'John', 'email' => 'john@example.com'],
            ['id' => 1, 'name' => 'Jim', 'email' => 'jim@example.com'],
        ];

        $id = $this->get( 'id' );

        if ( $id === null )
        {
            // Check if the users data store contains users
            if ( $users )
            {
                // Set the response and exit
                $this->response( $users, 200 );
            }
            else
            {
                // Set the response and exit
                $this->response( [
                    'status' => false,
                    'message' => 'No users were found'
                ], 404 );
            }
        }
        else
        {
            if ( array_key_exists( $id, $users ) )
            {
                $this->response( $users[$id], 200 );
            }
            else
            {
                $this->response( [
                    'status' => false,
                    'message' => 'No such user found'
                ], 404 );
            }
        }
    }

    public function usersRestrict_get()
    {
        // Users from a data store e.g. database
        $users = [
            ['id' => 0, 'name' => 'John', 'email' => 'john@example.com'],
            ['id' => 1, 'name' => 'Jim', 'email' => 'jim@example.com'],
        ];

        $id = $this->get( 'id' );

        if ( $id === null )
        {
            // Check if the users data store contains users
            if ( $users )
            {
                // Set the response and exit
                $this->response( $users, 200 );
            }
            else
            {
                // Set the response and exit
                $this->response( [
                    'status' => false,
                    'message' => 'No users were found'
                ], 404 );
            }
        }
        else
        {
            if ( array_key_exists( $id, $users ) )
            {
                $this->response( $users[$id], 200 );
            }
            else
            {
                $this->response( [
                    'status' => false,
                    'message' => 'No such user found'
                ], 404 );
            }
        }
    }
}
```

## Basic FGAC GET example


Step 1: Create Database Keys to access

```php

--
-- 1º Key, root, access all Controller/Method
--

INSERT INTO `keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(1, 1, 'a50348e70dc84e99496db527055a65db', 0, 0, 0, NULL, 0);

--
-- 2º Key access specific Controller, all methods in that controller
--

INSERT INTO `keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(2, 1, 'c5ba6c0463e35622f9c89bbda027b9b9', 0, 0, 0, NULL, 0);

--
-- 3º Key access only specific method
--

INSERT INTO `keys` (`id`, `user_id`, `key`, `level`, `ignore_limits`, `is_private_key`, `ip_addresses`, `date_created`) VALUES
(3, 1, 'a4b5d7002911890ae82acc3e54392c5f', 0, 0, 0, NULL, 0);


```

Step 2: Create Database REST Method Access Control (FGAC) controlls to keys

```php

--
-- 1º Key, root, access all Controller/Method
--

INSERT INTO `access` (`id`, `key`, `all_access`, `controller`, `method`, `date_created`) VALUES
(1, 'a50348e70dc84e99496db527055a65db', 1, '', '', NULL);

--
-- 2º Key access specific Controller, all methods in that controller
--

INSERT INTO `access` (`id`, `key`, `all_access`, `controller`, `method`, `date_created`) VALUES
(1, 'c5ba6c0463e35622f9c89bbda027b9b9', 0, '/Api', '', NULL);

--
-- 3º Key access only specific method /Api/users
--

INSERT INTO `access` (`id`, `key`, `all_access`, `controller`, `method`, `date_created`) VALUES
(1, 'a4b5d7002911890ae82acc3e54392c5f', 0, '/Api', 'users', NULL);


```

