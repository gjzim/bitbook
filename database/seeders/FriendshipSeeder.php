<?php

namespace Database\Seeders;

use App\Models\Friendship;
use App\Models\User;
use Illuminate\Database\Seeder;
use Symfony\Component\VarDumper\VarDumper;

class FriendshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createFriendshipsForAllUsers();
    }

    private function createFriendshipsForAllUsers()
    {
        $allUsers = User::select('id')->get();

        while ($allUsers->count() > 1) {
            $user = $allUsers->pop();

            $this->createFriendshipsForUser($user, $allUsers, random_int(5, 15));
        }
    }

    private function createFriendshipsForUser($user, $allUsers, $noOfFriendships)
    {
        $usedUsers = collect();

        while ($noOfFriendships-- > 0) {
            $otherUser = $allUsers->random();
            if ($usedUsers->contains($otherUser)) {
                continue;
            }

            try {
                $friendship = new Friendship([
                    'sender_id' => $user->id,
                    'receiver_id' => $otherUser->id,
                    'status' => random_int(1, 10) < 8 ? 'accepted' : 'pending',
                ]);

                if ($friendship->status == 'accepted') {
                    $friendship->accepted_at = now()->toDateTimeString();
                }

                $friendship->save();

                $usedUsers->push($otherUser);
            } catch (\Illuminate\Database\QueryException $e) {
                dump($e->getMessage());
            }
        }
    }
}
