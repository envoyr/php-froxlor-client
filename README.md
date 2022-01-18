# PHP Froxlor API Client

API Wrapper for Froxlor.

## Installation 

You can install it via composer:

```console
$ composer require envoyr/php-froxlor-client
```

## How to use

```php
$froxlor = new \Envoyr\Froxlor\Server([
    'host' => 'https://froxlor.example.com',
    'key' => '',
    'secret' => ''
]);
```

### Customer

```php
$response = $froxlor
    ->customers
    ->create([
        'email' => 'hello@example.com',
        'firstname' => 'Test',
        'name' => 'Testman',
        'custom_notes' => 'Created By API',
        'customernumber' => 1337,
        'new_loginname' => 'username',
        'new_customer_password' => 'someRandomString',
        'hosting_plan_id' => 1,
        'api_allowed' => false,
        'createstdsubdomain' => true,
    ]);
```

### Email

```php
$response = $froxlor
    ->customer('example')
    ->email('hello@example.com')
    ->attributes;
```

### Info

Domains, Ftps, Email & EmailAccounts are also available.