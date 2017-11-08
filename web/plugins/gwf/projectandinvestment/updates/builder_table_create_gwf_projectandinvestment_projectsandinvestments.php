<?php namespace gwf\ProjectAndInvestment\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateGwfProjectandinvestmentProjectsandinvestments extends Migration
{
    public function up()
    {
        Schema::create('gwf_projectandinvestment_projectsandinvestments', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->smallInteger('project_category_id');
            $table->string('title');
            $table->string('summary');
            $table->date('start_date');
            $table->date('expire_date');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->string('slug');
            $table->integer('user_id');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('gwf_projectandinvestment_projectsandinvestments');
    }
}
