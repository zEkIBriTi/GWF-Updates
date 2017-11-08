<?php namespace Gwf\Contactus\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGwfContactusContactus6 extends Migration
{
    public function up()
    {
        Schema::table('gwf_contactus_contactus', function($table)
        {
            $table->integer('user_id')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('gwf_contactus_contactus', function($table)
        {
            $table->integer('user_id')->nullable(false)->change();
        });
    }
}
