<?php

namespace Envoyr\Froxlor;

class Databases
{
    public Customer $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function create(
        string $password,
        string $description = null,
        bool $mail = false,
        string $suffix = null
    ): array {
        return $this->customer->server->request('Mysqls.add', [
            'customerid' => $this->customer->id,
            'mysql_password' => $password,
            'description' => $description,
            'sendinfomail' => $mail,
            'custom_suffix' => $suffix,
        ]);
    }

    public function list(): array
    {
        return $this->customer->server->request('Mysqls.listing', [
            'customerid' => $this->customer->id,
        ]);
    }
}