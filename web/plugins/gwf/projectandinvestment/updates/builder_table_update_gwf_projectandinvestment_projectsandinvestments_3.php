<?php namespace gwf\projectandinvestment\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGwfProjectandinvestmentProjectsandinvestments3 extends Migration
{
    public function up()
    {
        Schema::table('gwf_projectandinvestment_projectsandinvestments', function($table)
        {
            $table->renameColumn('expire_date', 'end_date');
        });
    }
    
    public function down()
    {
        Schema::table('gwf_projectandinvestment_projectsandinvestments', function($table)
        {
            $table->renameColumn('end_date', 'expire_date');
        });
    }
}
