<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    protected $signature = 'make:admin-user';
    protected $description = 'Create an admin user';

    public function handle()
    {
        $name = $this->ask('Name');
        $email = $this->ask('Email');
        $password = $this->secret('Password');

        if (User::where('email', $email)->exists()) {
            $this->error('A user with this email already exists!');
            return 1;
        }

        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'role' => User::ROLE_ADMIN,
        ]);

        $this->info('Admin user created successfully!');
        $this->info("Email: {$email}");
        
        return 0;
    }
}
