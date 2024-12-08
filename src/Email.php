<?php

namespace Envoyr\Froxlor;

class Email
{
    public array $attributes;
    public EmailAccounts $email_accounts;
    public string $id;
    public Customer $customer;

    public function __construct(Customer $customer, string $id)
    {
        $this->customer = $customer;
        $this->id = $id;
        $this->attributes = $this->customer->server->request('Emails.get', [
            'id' => $this->id
        ]);

        $this->email_accounts = $this->email_accounts();
    }

    private function email_accounts(): EmailAccounts
    {
        return new EmailAccounts($this);
    }

    public function email_account(): EmailAccount
    {
        return new EmailAccount($this);
    }

    public function update(array $attributes): array
    {
        return $this->customer->server->request(
            'Emails.update',
            array_merge($attributes, [
                'customerid' => $this->customer->id,
                'id' => $this->id,
            ])
        );
    }

    public function delete(): array
    {
        return $this->customer->server->request('Emails.delete', [
            'customerid' => $this->customer->id,
            'id' => $this->id
        ]);
    }
}