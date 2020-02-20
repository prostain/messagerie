<?php

use App\User;
use Illuminate\Database\Seeder;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create('fr_FR');

        for ($i = 1; $i <= 15; $i++){

            $user = new User;
            $user->name = $faker->name();
            $user->email = $faker->unique()->email;
            $user->password = bcrypt('123456');
            $user->save();
        }
    }
}
