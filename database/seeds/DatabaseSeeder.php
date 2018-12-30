<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        /* add some fake users with some posts for test */
          factory(App\User::class, 25)->create()->each(function ($u) {
          for ($i=0; $i <= 3; $i++) {
            $u->posts()->save(factory(App\Post::class)->make());
          }
        });

        // $this->call(UsersTableSeeder::class);

    }
}
