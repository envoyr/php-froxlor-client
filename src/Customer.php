<?php

namespace Envoyr\Froxlor;

class Customer
{
    public array $attributes;
    public Databases $databases;
    public Domains $domains;
    public Ftps $ftps;
    public Emails $emails;
    public string $loginname;
    public Server $server;

    public function __construct(Server $server, string $loginname)
    {
        $this->server = $server;
        $this->loginname = $loginname;
        $this->attributes = $this->server->request('Customers.get', [
            'loginname' => $this->loginname
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

    public function database(string $dbname): Database
    {
        return new Database($this, $dbname);
    }

    public function domain(string $domainname): Domain
    {
        return new Domain($this, $domainname);
    }

    public function email(string $emailaddr): Email
    {
        return new Email($this, $emailaddr);
    }

    public function ftp(string $username): Ftp
    {
        return new Ftp($this, $username);
    }

    public function deactivated(bool $deactivated): array
    {
        return $this->server->request('Customers.update', [
            'loginname' => $this->loginname,
            'deactivated' => $deactivated
        ]);
    }

    public function update(array $attributes): array
    {
        return $this->server->request(
            'Customers.update',
            array_merge($attributes, [
                'loginname' => $this->loginname
            ])
        );
    }

    public function delete(): array
    {
        return $this->server->request('Customers.delete', [
            'loginname' => $this->loginname
        ]);
    }
}
