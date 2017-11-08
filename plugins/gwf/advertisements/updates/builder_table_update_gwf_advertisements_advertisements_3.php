<?php namespace Gwf\Advertisements\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGwfAdvertisementsAdvertisements3 extends Migration
{
    public function up()
    {
        Schema::table('gwf_advertisements_advertisements', function($table)
        {
            $table->smallInteger('activation_status')->unsigned();
        });
    }
    
    public function down()
    {
        Schema::table('gwf_advertisements_advertisements', function($table)
        {
            $table->dropColumn('activation_status');
        });
    }
}
