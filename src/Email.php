<?php

namespace Envoyr\Froxlor;

class Email
{
    public array $attributes;
    public EmailAccounts $email_accounts;
    public string $emailaddr;
    public Customer $customer;

    public function __construct(Customer $customer, string $emailaddr)
    {
        $this->customer = $customer;
        $this->emailaddr = $emailaddr;
        $this->attributes = $this->customer->server->request('Emails.get', [
            'emailaddr' => $this->emailaddr
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
                'loginname' => $this->customer->loginname,
                'emailaddr' => $this->emailaddr,
            ])
        );
    }

    public function delete(): array
    {
        return $this->customer->server->request('Emails.delete', [
            'loginname' => $this->customer->loginname,
            'emailaddr' => $this->emailaddr
        ]);
    }
}