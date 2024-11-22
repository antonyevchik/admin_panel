<?php

namespace App\DataTransferObjects;

class AdminDTO
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public string $status,
        public ?string $avatar = null
    ) {
    }

    public static function fromRequest(array $validatedData): self
    {
        return new self(
            $validatedData['name'],
            $validatedData['email'],
            bcrypt($validatedData['password']),
            $validatedData['status'],
            $validatedData['avatar'] ?? null
        );
    }
}
