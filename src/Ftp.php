<?php

namespace Envoyr\Froxlor;

class Ftp
{
    public array $attributes;
    public string $username;
    public Customer $customer;

    public function __construct(Customer $customer, string $username)
    {
        $this->customer = $customer;
        $this->username = $username;
        $this->attributes = $this->customer->server->request('Ftps.get', [
            'loginname' => $this->customer->loginname,
            'username' => $this->username
        ]);
    }

    public function update(array $attributes): array
    {
        return $this->customer->server->request(
            'Ftps.update',
            array_merge($attributes, [
                'loginname' => $this->customer->loginname,
                'username' => $this->username,
            ])
        );
    }

    public function delete(): array
    {
        return $this->customer->server->request('Ftps.delete', [
            'loginname' => $this->customer->loginname,
            'username' => $this->username
        ]);
    }
}
