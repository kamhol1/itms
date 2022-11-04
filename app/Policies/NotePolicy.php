<?php

namespace App\Policies;

use App\Models\Note;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class NotePolicy
{
    use HandlesAuthorization;

    public function edit(User $user, Note $note)
    {
        if ($note->user->id != $user->id && $note->user->id != null && !$user->isAdmin())
            return false;
        else
            return true;
    }

    public function delete(User $user, Note $note)
    {
        if (!$user->isAdmin() && $note->user->id != $user->id)
            return false;
        else
            return true;
    }
}
