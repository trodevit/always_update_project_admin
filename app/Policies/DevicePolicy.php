<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class DevicePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function view(User $user, string $level)
    {
        return true;
    }


}
