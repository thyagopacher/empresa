<?php

use App\User;
use App\Cliente;
use App\StatusConta;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
    }
}

class UsersTableSeeder extends Seeder
{
    public function run(){
        $user = User::get();
        if($user->count() == 0){
            User::create(array(
                'email' => 'thyago.pacher@gmail.com',
                'password' => Hash::make('brasil'),
                'name' => 'Thyago Henrique Pacher'
            ));
            Cliente::create(array(
                'email' => 'thyago.pacher@gmail.com',
                'senha' => Hash::make('brasil'),
                'nome' => 'Thyago Henrique Pacher'
            ));
        }
    }

}

class StatusContaTableSeeder extends Seeder
{
    public function run(){
        $status = StatusConta::get();
        if($status->count() == 0){
            StatusConta::create(array('nome' => 'cadastrada', 'codigo' => '01'));
            StatusConta::create(array('nome' => 'ativa', 'codigo' => '10'));
            StatusConta::create(array('nome' => 'desativada', 'codigo' => '50'));
            StatusConta::create(array('nome' => 'reativada', 'codigo' => '55'));
            StatusConta::create(array('nome' => 'excluida', 'codigo' => '90'));
            StatusConta::create(array('nome' => 'banida', 'codigo' => '99'));
        }
    }

}
