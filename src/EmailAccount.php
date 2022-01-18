<?php

namespace Envoyr\Froxlor;

class EmailAccount
{
    public array $attributes;
    public Email $email;

    public function __construct(Email $email)
    {
        $this->email = $email;
        $this->attributes = $this->email->attributes;
    }

    public function delete()
    {
        $this->email->customer->server->request('EmailAccounts.delete', [
            'loginname' => $this->email->customer->loginname,
            'emailaddr' => $this->email->emailaddr,
        ]);
    }

    public function update(array $attributes): array
    {
        return $this->email->customer->server->request(
            'EmailAccounts.update',
            array_merge($attributes, [
                'loginname' => $this->email->customer->loginname,
                'emailaddr' => $this->email->emailaddr,
            ])
        );
    }
}