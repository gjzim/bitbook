<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FriendshipController extends Controller
{
    /**
     * Display the friends of a user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return view('users.friends.index', ['user' => $user]);
    }

    /**
     * Display the pending friends of a user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function pendingIndex(User $user)
    {
        return view('users.friends.pending', ['user' => $user]);
    }

    /**
     * Display the suggested friends of a user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function suggestionsIndex(User $user)
    {
        return view('users.friends.suggestions', ['user' => $user]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $receiver
     * @return \Illuminate\Http\Response
     */
    public function create(User $receiver)
    {
        if (auth()->user()->friendshipWith($receiver)->exists()) {
            abort(409, 'Friendship already exists.');
        }

        auth()->user()->sentFriendRequestsTo()->attach($receiver);

        return response()->json([
            'success' => true,
            'message' => 'Successfully sent friend request.',
            'data' => [],
        ]);
    }

    /**
     * Remove the friendship from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $sender
     * @param  \App\Models\User  $receiver
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $sender, User $receiver)
    {
        $action = $request->post('action');
        $message = 'Successfully completed the request.';

        if ($action == 'accept-friendship') {
            $sender->sentFriendRequestsTo()->updateExistingPivot($receiver->id, [
                'status' => 'accepted',
                'accepted_at' => now()->toDateTimeString(),
            ]);

            $message = 'Successfully accepted the friendship request.';
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => []
        ]);
    }

    /**
     * Remove the friendship from storage.
     *
     * @param  \App\Models\User  $sender
     * @param  \App\Models\User  $receiver
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $sender, User $receiver)
    {
        $sender->sentFriendRequestsTo()->detach($receiver);
        $receiver->sentFriendRequestsTo()->detach($sender);

        return response()->json([
            'success' => true,
            'message' => 'Successfully removed the friendship.',
            'data' => []
        ]);
    }
}
