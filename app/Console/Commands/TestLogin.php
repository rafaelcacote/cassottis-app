<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class TestLogin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:login {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Testa o login de um usuário';

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

        $this->info("Usuário encontrado: {$user->name} ({$user->email})");
        
        // Obter senha do banco
        $hashedPassword = $user->getAttributes()['password'] ?? $user->password;
        
        $this->info("Senha no banco (hash): " . substr($hashedPassword, 0, 20) . "...");
        $this->info("Tamanho do hash: " . strlen($hashedPassword));
        
        // Testar verificação
        $isValid = Hash::check($password, $hashedPassword);
        
        if ($isValid) {
            $this->info("✅ Senha válida!");
        } else {
            $this->error("❌ Senha inválida!");
            $this->warn("Tentando re-hashar a senha...");
            
            // Tentar atualizar a senha
            $user->password = Hash::make($password);
            $user->save();
            
            $this->info("Senha atualizada. Tente fazer login novamente.");
        }

        return 0;
    }
}


