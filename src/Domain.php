<?php

namespace Envoyr\Froxlor;

class Domain
{
    public array $attributes;
    public Customer $customer;
    public string $id;

    public function __construct(Customer $customer, string $id)
    {
        $this->id = $id;
        $this->customer = $customer;
        $this->attributes = $this->customer->server->request('Domains.get', [
            'id' => $this->id
        ]);
    }

    public function update(array $attributes): array
    {
        return $this->customer->server->request(
            'Domains.update',
            array_merge($attributes, [
                'id' => $this->id,
            ])
        );
    }

    public function delete(): array
    {
        return $this->customer->server->request('Domains.delete', [
            'id' => $this->id
        ]);
    }
}