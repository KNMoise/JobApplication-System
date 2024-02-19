<?php

namespace App\Policies;

use App\Models\User;
use App\Models\JobApplication;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobApplicationPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function view(User $user, JobApplication $jobApplication)
    {
        return $user->id === $jobApplication->user_id;
    }
}
