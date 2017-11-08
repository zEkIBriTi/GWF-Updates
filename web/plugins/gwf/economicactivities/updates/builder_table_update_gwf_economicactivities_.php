<?php namespace Gwf\EconomicActivities\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGwfEconomicactivities extends Migration
{
    public function up()
    {
        Schema::table('gwf_economicactivities_', function($table)
        {
            $table->increments('id')->unsigned(false)->change();
        });
    }
    
    public function down()
    {
        Schema::table('gwf_economicactivities_', function($table)
        {
            $table->increments('id')->unsigned()->change();
        });
    }
}
