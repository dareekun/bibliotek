<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Documents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('pic');
            $table->string('department');
            $table->string('category');
            $table->string('issuedate');
            $table->string('expireddate');
            $table->integer('remider');
            $table->string('file');
            $table->string('remark');
            $table->boolean('statusdoc');
            $table->string('location');
            $table->boolean('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
