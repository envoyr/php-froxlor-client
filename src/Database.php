<?php

namespace Envoyr\Froxlor;

class Database
{
    public array $attributes;
    public string $id;
    public Customer $customer;

    public function __construct(Customer $customer, string $id)
    {
        $this->customer = $customer;
        $this->id = $id;
        $this->attributes = $this->customer->server->request('Mysqls.get', [
            'id' => $this->id
        ]);
    }

    public function update(array $attributes): array
    {
        return $this->customer->server->request(
            'Mysqls.update',
            array_merge($attributes, [
                'customerid' => $this->customer->id,
                'id' => $this->id,
            ])
        );
    }

    public function delete(): array
    {
        return $this->customer->server->request('Mysqls.delete', [
            'customerid' => $this->customer->id,
            'id' => $this->id
        ]);
    }
}