<?php

namespace Envoyr\Froxlor;

class Customers
{
    public Server $server;

    public function __construct(Server $server)
    {
        $this->server = $server;
    }

    public function create(array $attributes): array
    {
        return $this->server->request('Customers.add', $attributes);
    }
}