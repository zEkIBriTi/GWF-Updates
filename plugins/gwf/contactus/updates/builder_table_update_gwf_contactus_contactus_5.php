<?php namespace Gwf\Contactus\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGwfContactusContactus5 extends Migration
{
    public function up()
    {
        Schema::table('gwf_contactus_contactus', function($table)
        {
            $table->renameColumn('user_d', 'user_id');
        });
    }
    
    public function down()
    {
        Schema::table('gwf_contactus_contactus', function($table)
        {
            $table->renameColumn('user_id', 'user_d');
        });
    }
}
