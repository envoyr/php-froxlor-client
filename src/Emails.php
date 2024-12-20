<?php

namespace Envoyr\Froxlor;

class Emails
{
    public Customer $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function create(string $email_part, string $domain, string $description = null): array
    {
        return $this->customer->server->request('Emails.add', [
            'customerid' => $this->customer->id,
            'email_part' => $email_part,
            'domain' => $domain,
            'description' => $description,
        ]);
    }

    public function list(): array
    {
        return $this->customer->server->request('Emails.listing', [
            'customerid' => $this->customer->id,
        ]);
    }
}