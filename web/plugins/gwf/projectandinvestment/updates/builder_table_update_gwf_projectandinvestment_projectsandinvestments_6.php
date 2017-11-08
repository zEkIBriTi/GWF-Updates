<?php namespace gwf\projectandinvestment\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGwfProjectandinvestmentProjectsandinvestments6 extends Migration
{
    public function up()
    {
        Schema::table('gwf_projectandinvestment_projectsandinvestments', function($table)
        {
            $table->text('summary')->nullable(false)->unsigned(false)->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('gwf_projectandinvestment_projectsandinvestments', function($table)
        {
            $table->string('summary', 255)->nullable(false)->unsigned(false)->default(null)->change();
        });
    }
}
