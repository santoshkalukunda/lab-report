<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('registed_date');
            $table->string('collection_date')->nullable();
            $table->string('reporting_date')->nullable();
            $table->string('lab_number')->nullable();
            $table->string('refer_by')->nullable();
            $table->string('consultant')->nullable();
            $table->foreignId('patient_id')->constrained('patients')->onDelete('cascade');
            $table->longText('remarks')->nullable();
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
