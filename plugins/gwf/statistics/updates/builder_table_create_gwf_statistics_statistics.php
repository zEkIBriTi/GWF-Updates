<?php namespace gwf\Statistics\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateGwfStatisticsStatistics extends Migration
{
    public function up()
    {
        Schema::create('gwf_statistics_statistics', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title', 250);
            $table->string('value', 250);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('gwf_statistics_statistics');
    }
}
