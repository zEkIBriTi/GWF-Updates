<?php namespace Gwf\Contactus\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGwfContactusContactus2 extends Migration
{
    public function up()
    {
        Schema::table('gwf_contactus_contactus', function($table)
        {
            $table->string('url', 255)->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('gwf_contactus_contactus', function($table)
        {
            $table->dropColumn('url');
        });
    }
}
