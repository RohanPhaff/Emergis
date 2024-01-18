<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
            $table->string('department')->nullable();
            $table->string('department_man_hours')->nullable();
            $table->integer('budget')->nullable();
            $table->string('category_budget')->nullable();
            $table->integer('spent_costs')->nullable();

            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();

            $table->string('projectleader');
            $table->string('second_projectleader')->nullable();
            $table->string('initiator')->nullable();
            $table->string('actor')->nullable();

            $table->string('reasoning');
            $table->binary('uploaded_document_start')->nullable();
            $table->binary('uploaded_document_planning')->nullable();
            $table->string('program')->nullable();
            $table->string('community_link')->nullable();
            $table->string('project_status')->nullable();
            $table->integer('progress');
            $table->boolean('check_discussion_RvB')->nullable();

            $table->string('risk_ids')->nullable();
            $table->string('task_ids')->nullable();
            $table->string('user_ids')->nullable();

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
