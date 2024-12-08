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
            'customerid' => $this->email->customer->id,
            'id' => $this->email->id,
        ]);
    }

    public function update(array $attributes): array
    {
        return $this->email->customer->server->request(
            'EmailAccounts.update',
            array_merge($attributes, [
                'customerid' => $this->email->customer->id,
                'id' => $this->email->id,
            ])
        );
    }
}