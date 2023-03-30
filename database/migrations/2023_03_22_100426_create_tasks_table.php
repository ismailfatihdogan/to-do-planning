<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provider_id')->constrained('providers')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('sprint_plan_id')->nullable()->constrained('sprint_plans')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('developer_id')->nullable()->constrained('developers')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('title');
            $table->unsignedTinyInteger('level');
            $table->unsignedFloat('time', 4);
            $table->unsignedFloat('developer_estimation_time', 4)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['provider_id', 'title']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
};
