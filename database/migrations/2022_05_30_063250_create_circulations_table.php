<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('circulations', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_code')->unique();
            $table->foreignId('member_id')->constrained('members')->onUpdate('cascade');
            $table->foreignId('collection_id')->constrained('collections')->onUpdate('cascade');
            $table->date('borrowed_date');
            $table->date('returned_date')->nullable();
            $table->integer('duration');
            $table->date('return_deadline');
            $table->string('status')->default('Borrowed');
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
        Schema::dropIfExists('circulations');
    }
};
