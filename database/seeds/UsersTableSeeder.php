<?php

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
        $data = [
            [
                'name' => 'Автор не известен',
                'email' => 'anonim@gmail.com',
                'password' => bcrypt(str_random(16)),
            ],
            [
                'name' => 'Автор',
                'email' => 'author@gmail.com',
                'password' => bcrypt(123123),
            ],
            [
                'name' => 'Diana',
                'email' => 'babenko@gmail.com',
                'password' => bcrypt(1231234),
            ],

        ];

        DB::table('users')->insert($data);
    }
}
