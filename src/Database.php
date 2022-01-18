<?php

namespace Envoyr\Froxlor;

class Database
{
    public array $attributes;
    public string $dbname;
    public Customer $customer;

    public function __construct(Customer $customer, string $dbname)
    {
        $this->customer = $customer;
        $this->dbname = $dbname;
        $this->attributes = $this->customer->server->request('Mysqls.get', [
            'dbname' => $this->dbname
        ]);
    }

    public function update(array $attributes): array
    {
        return $this->customer->server->request(
            'Mysqls.update',
            array_merge($attributes, [
                'loginname' => $this->customer->loginname,
                'dbname' => $this->dbname,
            ])
        );
    }

    public function delete(): array
    {
        return $this->customer->server->request('Mysqls.delete', [
            'loginname' => $this->customer->loginname,
            'dbname' => $this->dbname
        ]);
    }
}