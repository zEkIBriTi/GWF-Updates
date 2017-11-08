<?php namespace Gwf\Contactus\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGwfContactusContactus4 extends Migration
{
    public function up()
    {
        Schema::table('gwf_contactus_contactus', function($table)
        {
            $table->dropColumn('moto');
        });
    }
    
    public function down()
    {
        Schema::table('gwf_contactus_contactus', function($table)
        {
            $table->string('moto', 255);
        });
    }
}
