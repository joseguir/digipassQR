<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Lote;

class LotePolicy
{
    /**
     * Create a new policy instance.
     */
   
     public function update(User $user, Lote $lote): bool
    {
        return $lote->evento->user_id === $user->id;
    }

    public function delete(User $user, Lote $lote): bool
    {
        return $lote->evento->user_id === $user->id;
    }
}
