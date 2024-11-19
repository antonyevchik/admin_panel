<?php

namespace App\Policies;

use App\Models\User;

class AdminPolicy
{
    public function viewAny(): bool
    {
        return auth()->check();
    }

    public function view(): bool
    {
        return auth()->check();
    }

    public function create(User $user): bool
    {
        return auth()->check();
    }

    public function update(User $user, User $admin): bool
    {
        return auth()->check() || $user->id === $admin->id;
    }

    public function delete(User $user, User $admin): bool
    {
        return auth()->check() && $user->id !== $admin->id;
    }
}
