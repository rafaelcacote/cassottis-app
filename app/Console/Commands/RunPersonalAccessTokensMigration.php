<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class RunPersonalAccessTokensMigration extends Command
{
    protected $signature = 'migrate:personal-access-tokens';
    protected $description = 'Cria a tabela personal_access_tokens se não existir';

    public function handle()
    {
        if (Schema::hasTable('personal_access_tokens')) {
            $this->info('Tabela personal_access_tokens já existe.');
            
            // Marcar migration como executada
            DB::table('migrations')->insertOrIgnore([
                'migration' => '2025_12_13_021547_create_personal_access_tokens_table',
                'batch' => DB::table('migrations')->max('batch') + 1
            ]);
            
            return 0;
        }

        $this->info('Criando tabela personal_access_tokens...');

        Schema::create('personal_access_tokens', function ($table) {
            $table->id();
            $table->morphs('tokenable');
            $table->text('name');
            $table->string('token', 64)->unique();
            $table->text('abilities')->nullable();
            $table->timestamp('last_used_at')->nullable();
            $table->timestamp('expires_at')->nullable()->index();
            $table->timestamps();
        });

        // Marcar migration como executada
        DB::table('migrations')->insert([
            'migration' => '2025_12_13_021547_create_personal_access_tokens_table',
            'batch' => DB::table('migrations')->max('batch') + 1
        ]);

        $this->info('✅ Tabela personal_access_tokens criada com sucesso!');
        return 0;
    }
}


