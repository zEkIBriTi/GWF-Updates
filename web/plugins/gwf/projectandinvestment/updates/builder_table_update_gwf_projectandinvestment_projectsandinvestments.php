<?php namespace gwf\ProjectAndInvestment\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGwfProjectandinvestmentProjectsandinvestments extends Migration
{
    public function up()
    {
        Schema::table('gwf_projectandinvestment_projectsandinvestments', function($table)
        {
            $table->string('title', 25)->change();
            $table->string('slug', 120)->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('gwf_projectandinvestment_projectsandinvestments', function($table)
        {
            $table->string('title', 255)->change();
            $table->string('slug', 255)->nullable(false)->change();
        });
    }
}
