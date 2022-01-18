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
            'loginname' => $this->email->customer->loginname,
            'emailaddr' => $this->email->emailaddr,
            'email_password' => $email_password,
            'sendinfomail' => $sendinfomail,
        ]);
    }
}