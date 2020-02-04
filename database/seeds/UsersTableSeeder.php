<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * @throws Exception
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Автор не известен',
                'email' => 'anonim@gmail.com',
                'password' => bcrypt(str_random(16)),
                'balance' => random_int(1,100),
            ],

            [
                'name' => 'Автор',
                'email' => 'author@gmail.com',
                'password' => bcrypt(123123),
                'balance' => random_int(1,100),
            ],

            [
                'name' => 'Diana',
                'email' => 'babenko@gmail.com',
                'password' => bcrypt(1231234),
                'balance' => random_int(1,100),
            ],
        ];

        DB::table('users')->insert($data);
    }
}
