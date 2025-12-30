<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@escolaparque.com.br',
            'password' => Hash::make('Admin@123'),
            'role' => 'admin',
            'email_verified_at' => now(),
            'require_email_verification' => false,
        ]);

        $this->command->info('Usuário administrador criado com sucesso!');
        $this->command->info('Email: admin@escolaparque.com.br');
        $this->command->info('Senha: Admin@123');
    }
}
