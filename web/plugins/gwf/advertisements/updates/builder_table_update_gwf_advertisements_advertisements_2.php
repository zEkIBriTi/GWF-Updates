<?php namespace Gwf\Advertisements\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGwfAdvertisementsAdvertisements2 extends Migration
{
    public function up()
    {
        Schema::table('gwf_advertisements_advertisements', function($table)
        {
            $table->string('slug');
        });
    }
    
    public function down()
    {
        Schema::table('gwf_advertisements_advertisements', function($table)
        {
            $table->dropColumn('slug');
        });
    }
}
