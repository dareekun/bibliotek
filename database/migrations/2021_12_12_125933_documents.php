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
            $table->string('title');
            $table->string('creator');
            $table->string('pic')->nullable();
            $table->string('department');
            $table->string('category');
            $table->string('subcategory');
            $table->string('issuedate');
            $table->string('expireddate');
            $table->integer('reminder');
            $table->string('remark')->nullable();
            $table->string('docloc');
            $table->string('location');
            $table->boolean('statusdoc');
            $table->timestamp('created_at', $precision = 0);
        });
        DB::statement('ALTER TABLE document ADD no INT(5) NOT NULL AUTO_INCREMENT AFTER id, ADD UNIQUE (no)');
    }
    
    // ALTER TABLE `document` ADD `no` INT(5) NOT NULL AUTO_INCREMENT AFTER `id`, ADD UNIQUE (`no`);

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
