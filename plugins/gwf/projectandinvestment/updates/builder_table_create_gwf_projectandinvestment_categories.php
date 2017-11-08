<?php namespace gwf\projectandinvestment\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateGwfProjectandinvestmentCategories extends Migration
{
    public function up()
    {
        Schema::create('gwf_projectandinvestment_categories', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title', 250);
            $table->string('slug', 250);
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->boolean('activation_status');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('gwf_projectandinvestment_categories');
    }
}
