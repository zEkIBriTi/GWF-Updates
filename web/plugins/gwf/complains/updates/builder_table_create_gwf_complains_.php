<?php namespace gwf\Complains\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateGwfComplains extends Migration
{
    public function up()
    {
        Schema::create('gwf_complains_', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('title');
            $table->text('email');
            $table->integer('phone');
            $table->string('description');
            $table->string('attachment');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->string('slug');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('gwf_complains_');
    }
}
