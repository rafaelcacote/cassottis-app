<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class ResetUserPassword extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:reset-password {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Redefine a senha de um usuário';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $password = $this->argument('password');

        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("Usuário não encontrado: {$email}");
            return 1;
        }

        // Atualizar senha diretamente no banco (bypassando o cast)
        $user->getConnection()->table('users')
            ->where('id', $user->id)
            ->update(['password' => Hash::make($password)]);

        $this->info("✅ Senha redefinida com sucesso para: {$email}");
        $this->info("Nova senha: {$password}");

        return 0;
    }
}



