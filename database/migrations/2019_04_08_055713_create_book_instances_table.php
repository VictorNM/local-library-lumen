<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Carbon\Carbon;

class CreateBookInstancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_instances', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('book_id');
            $table->enum('status', ['Available', 'Maintenance', 'Loaned', 'Reserved'])->default('Maintenance');
            $table->date('due_back')->default(Carbon::today());
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
        Schema::dropIfExists('book_instances');
    }
}
