<?php

use App\Models\Project;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });

Broadcast::channel('tasks.{project}', function ($user, Project $project) {
    // *Manual Access Management*
    // $canAccess = [];
    // if ($user->email === "antonis.gkoutzamanis@pfizer.com") {
    //     $canAccess = [1, 3];
    // }

    // if ($user->email === 'katerina@gmail.com') {
    //     $canAccess = [2, 4];
    // }

    // return in_array($projectId, $canAccess);

    // *Private Channel*
    //return $project->participants->contains($user);

    // *Presence Channel*
    if ($project->participants->contains($user)) {
        return ['name' => $user->name];
    }
});
