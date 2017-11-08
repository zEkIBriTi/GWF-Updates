<?php namespace Gwf\EconomicActivities\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateGwfEconomicactivities extends Migration
{
    public function up()
    {
        Schema::create('gwf_economicactivities_', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('activityname', 100);
            $table->text('description');
            $table->integer('recorder');
            $table->string('slug', 150);
            $table->boolean('activation_status');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('gwf_economicactivities_');
    }
}
