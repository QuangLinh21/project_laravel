<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TblBlog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_blog', function (Blueprint $table) {
            $table->increments('blog_id');            
            $table->string('customer_name');            
            $table->string('customer_email');            
            $table->text('content');            
            $table->string('time');  
            $table->string('date');
            $table->string('quyen');
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
        Schema::dropIfExists('tbl_blog');
    }
}
