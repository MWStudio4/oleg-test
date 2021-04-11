<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserMutationController extends Controller
{
    public function mute(Authenticatable $user, Request $request): Response
    {
        $request->validate([
            'userId' => 'required|integer|exists:App\Models\User,id',
        ]);

        $user->muteUsers()->attach($request->userId);

        return response()->noContent();
    }

    public function unmute(Authenticatable $user, Request $request): Response
    {
        $request->validate([
            'userIds.*' => 'required|integer|exists:App\Models\User,id',
        ]);

        $user->muteUsers()->detach($request->userIds);

        return response()->noContent();
    }
}
