<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class DevicePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function accessSSC(User $user)
    {
        $levels = json_decode($user->levels ?? '[]', true);
        $levels = is_array($levels) ? $levels : [];
        return in_array('SSC', $levels);
    }

    public function accessHSC(User $user)
    {
        return in_array('HSC', $user->levels ?? []);
    }

    public function accessHonors(User $user)
    {
        return in_array('Honors', $user->levels ?? []);
    }

}
