<?php

namespace Envoyr\Froxlor;

class Customer
{
    public array $attributes;
    public Databases $databases;
    public Domains $domains;
    public Ftps $ftps;
    public Emails $emails;
    public string $id;
    public Server $server;

    public function __construct(Server $server, string $id)
    {
        $this->server = $server;
        $this->id = $id;
        $this->attributes = $this->server->request('Customers.get', [
            'id' => $this->id
        ]);

        $this->databases = $this->databases();
        $this->domains = $this->domains();
        $this->ftps = $this->ftps();
        $this->emails = $this->emails();
    }

    private function databases(): Databases
    {
        return new Databases($this);
    }

    private function domains(): Domains
    {
        return new Domains($this);
    }

    private function ftps(): Ftps
    {
        return new Ftps($this);
    }

    private function emails(): Emails
    {
        return new Emails($this);
    }

    public function database(string $id): Database
    {
        return new Database($this, $id);
    }

    public function domain(string $id): Domain
    {
        return new Domain($this, $id);
    }

    public function email(string $id): Email
    {
        return new Email($this, $id);
    }

    public function ftp(string $id): Ftp
    {
        return new Ftp($this, $id);
    }

    public function deactivated(bool $deactivated): array
    {
        return $this->server->request('Customers.update', [
            'id' => $this->id,
            'deactivated' => $deactivated
        ]);
    }

    public function update(array $attributes): array
    {
        return $this->server->request(
            'Customers.update',
            array_merge($attributes, [
                'id' => $this->id
            ])
        );
    }

    public function delete(): array
    {
        return $this->server->request('Customers.delete', [
            'id' => $this->id
        ]);
    }
}
