<?php

namespace Database\Seeders;

use App\Models\Like;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class LikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $totalLikes = 3000;
        while ($totalLikes-- > 0) {
            try {
                Like::create([
                    'post_id' => Post::inRandomOrder()->first()->id,
                    'user_id' => User::inRandomOrder()->first()->id,
                ]);
            } catch (\Illuminate\Database\QueryException $e) {
                dump($e->getMessage());
            }
        }
    }
}
