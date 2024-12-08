<?php

namespace Envoyr\Froxlor;

class Ftps
{
    public Customer $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function create(string $password, string $path = '/', string $description = null, bool $mail = false): array
    {
        return $this->customer->server->request('Ftps.add', [
            'customerid' => $this->customer->id,
            'ftp_password' => $password,
            'path' => $path,
            'ftp_description' => $description,
            'sendinfomail' => $mail,
        ]);
    }

    public function list(): array
    {
        return $this->customer->server->request('Ftps.listing', [
            'customerid' => $this->customer->id,
        ]);
    }
}