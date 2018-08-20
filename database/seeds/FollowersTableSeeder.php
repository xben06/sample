<?php

use Illuminate\Database\Seeder;
use App\Models\User;


class FollowersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $user = $users->first();
        $user_id = $user->id;

        //获取去掉 ID 为 1 的所用用户 ID 为数组
        $followers = $users->slice(1);
        $followers_ids = $followers->pluck('id')->toArray();

        //关注除了 1 号用户以外的所有用户都来关注 1 号用户
        $user->follow($followers_ids);

        //除了一号用户以外的所有用户都来关注 1 号用户
        foreach ($followers as $follower) {
            $follower->follow($user_id);
        }
    }
}
