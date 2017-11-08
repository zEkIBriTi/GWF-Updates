<?php namespace Gwf\Contactus\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGwfContactusContactus extends Migration
{
    public function up()
    {
        Schema::table('gwf_contactus_contactus', function($table)
        {
            $table->string('slug', 255);
            $table->increments('id')->unsigned(false)->change();
        });
    }
    
    public function down()
    {
        Schema::table('gwf_contactus_contactus', function($table)
        {
            $table->dropColumn('slug');
            $table->increments('id')->unsigned()->change();
        });
    }
}
