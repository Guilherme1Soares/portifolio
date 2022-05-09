<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Nome do cliente',
            'username' => 'adm', 
            'email' => 'admin@engenhodeimagens.com.br',
            'password' => Hash::make('12345678'),
        ]);
    }
}
