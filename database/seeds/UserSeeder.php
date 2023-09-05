<?php

use Illuminate\Database\Seeder;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $user = new App\User();
        $user -> username = "admin";
        $user -> role = "admin";
        $user -> email = "admin@gmail.com";
        $user->password = bcrypt("password");
        $user->confirmation_code = "1122";
        $user->save();

        $user = new App\User();
        $user -> username = "bikash";
        $user -> role = "admin";
        $user -> email = "sapkotabikash194@gmail.com";
        $user->password = bcrypt("password");
        $user->confirmation_code = "1122";
        $user->save();

        $user = new App\User();
        $user -> username = "micah";
        $user -> role = "admin";
        $user -> email = "micah@gmail.com";
        $user->password = bcrypt("password");
        $user->confirmation_code = "1122";
        $user->save();


        $user = new App\User();
        $user -> username = "saroj";
        $user -> role = "admin";
        $user -> email = "saroj@gmail.com";
        $user->password = bcrypt("password");
        $user->confirmation_code = "1122";
        $user->save();


        $user = new App\User();
        $user -> username = "dhruba";
        $user -> role = "admin";
        $user -> email = "dhruba@gmail.com";
        $user->password = bcrypt("password");
        $user->confirmation_code = "1122";
        $user->save();

    }
}
