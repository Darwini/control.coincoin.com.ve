<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = array( [
            'username' => 'boss', 
            'email' => 'ctrlcoin@gmail.com', 
            'password' => bcrypt('ctrlcoin'), 
            'roles_id' => 1,
            'group_id' => 1, ]
        );
        
        // Loop through each user above and create the record for them in the database
        foreach ($users as $user) {
            User::create($user);
        }
        
    }
}
