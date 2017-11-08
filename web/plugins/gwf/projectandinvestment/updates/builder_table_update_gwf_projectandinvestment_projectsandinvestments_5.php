<?php namespace gwf\projectandinvestment\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGwfProjectandinvestmentProjectsandinvestments5 extends Migration
{
    public function up()
    {
        Schema::table('gwf_projectandinvestment_projectsandinvestments', function($table)
        {
            $table->string('projectcategory_id', 250)->nullable(false)->unsigned(false)->default(null)->change();
        });
    }
    
    public function down()
    {
        Schema::table('gwf_projectandinvestment_projectsandinvestments', function($table)
        {
            $table->smallInteger('projectcategory_id')->nullable(false)->unsigned(false)->default(null)->change();
        });
    }
}
