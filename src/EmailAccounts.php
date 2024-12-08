<?php

namespace Envoyr\Froxlor;

class EmailAccounts
{
    public Email $email;

    public function __construct(Email $email)
    {
        $this->email = $email;
    }

    public function create(string $email_password, bool $sendinfomail = false): array
    {
        return $this->email->customer->server->request('EmailAccounts.add', [
            'customerid' => $this->email->customer->id,
            'id' => $this->email->id,
            'email_password' => $email_password,
            'sendinfomail' => $sendinfomail,
        ]);
    }
}