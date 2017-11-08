<?php namespace gwf\projectandinvestment\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGwfProjectandinvestmentProjectsandinvestments7 extends Migration
{
    public function up()
    {
        Schema::table('gwf_projectandinvestment_projectsandinvestments', function($table)
        {
            $table->string('title', 255)->change();
            $table->integer('user_id')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('gwf_projectandinvestment_projectsandinvestments', function($table)
        {
            $table->string('title', 25)->change();
            $table->integer('user_id')->nullable(false)->change();
        });
    }
}
