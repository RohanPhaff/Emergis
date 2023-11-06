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
        Schema::create('projects', function (Blueprint $table) {
            $table->id()->unique();
            $table->string('name');
            $table->string('code')->nullable()->unique();
            $table->string('description');
            $table->integer('man_hours')->nullable();
            $table->integer('budget')->nullable();
            $table->integer('expected_costs')->nullable();

            $table->date('start_date');
            $table->date('end_date');

            $table->string('alt_projectleader')->nullable();
            $table->string('initiator')->nullable();
            $table->string('actor')->nullable();
            $table->string('portfolio_holder');

            $table->string('reasoning');
            $table->binary('uploaded_document_start')->nullable();
            $table->binary('uploaded_document_planning')->nullable();
            $table->string('program')->nullable();
            $table->string('community_link')->nullable();
            $table->string('project_status')->nullable();
            $table->boolean('check_discussion_RvB')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
