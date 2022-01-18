# PHP Froxlor API Client

API Wrapper for Froxlor.

## How to use

````
$froxlor = new \Envoyr\Froxlor\Server([
    'host' => 'https://froxlor.example.com',
    'key' => '',
    'secret' => ''
]);
````

### Customer

````
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
````

### Email

````
$response = $froxlor
    ->customer('example')
    ->email('hello@example.com')
    ->attributes;
````

### Info

Domains, Ftps, Email & EmailAccounts are also available.