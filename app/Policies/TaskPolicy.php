<?php

namespace App\Policies;

use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
{
    use HandlesAuthorization;

    public function edit(User $user, Task $task)
    {
        if ($task->assignee_id != $user->id && $task->assignee_id != null && !$user->isAdmin())
            return false;
        else
            return true;
    }

    public function delete(User $user)
    {
        if (!$user->isAdmin())
            return false;
        else
            return true;
    }
}
