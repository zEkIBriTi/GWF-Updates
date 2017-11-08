<?php namespace gwf\Dashboardlinks\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateGwfDashboardlinks extends Migration
{
    public function up()
    {
        Schema::create('gwf_dashboardlinks_', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('name');
            $table->text('url');
            $table->integer('recorded_by');
            $table->boolean('activation_status');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('gwf_dashboardlinks_');
    }
}
