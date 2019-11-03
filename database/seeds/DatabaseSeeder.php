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
        DB::table('users')->insert(array(
            [
                'name'=>'Hayk Karapetyan',
                'email' => 'haykokalipsis@gmail.com',
                'gender' => 'male',
                'id' => 'fb61ced6-3ef4-4f31-ad70-db7eadca2db3',
                'password' => '$2y$10$3vsblDfHwb15QOcvAgUw0uRQcpKTUE6R2mXE47WsvAUlQJnouQ3Qm',

                'created_at'=>\Carbon\Carbon::now()->toDateTimeString(),
                'updated_at'=>\Carbon\Carbon::now()->toDateTimeString()
            ],
        ));
        
        factory(App\User::class, 15)->create();
        // $this->call(UsersTableSeeder::class);
    }
}
