<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->enum('status', ['new', 'read', 'replied', 'archived'])->default('new')->after('message');
            $table->string('subject')->nullable()->after('phone');
            $table->string('project_type')->nullable()->after('subject');
            $table->string('budget_range')->nullable()->after('project_type');
            $table->string('timeline')->nullable()->after('budget_range');
            $table->string('ip_address')->nullable()->after('timeline');
            $table->text('user_agent')->nullable()->after('ip_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contact_messages', function (Blueprint $table) {
            $table->dropColumn(['status', 'subject', 'project_type', 'budget_range', 'timeline', 'ip_address', 'user_agent']);
        });
    }
};
