<?php namespace Gwf\Advertisements\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGwfAdvertisementsAdvertisements extends Migration
{
    public function up()
    {
        Schema::table('gwf_advertisements_advertisements', function($table)
        {
            $table->date('updated_at');
        });
    }
    
    public function down()
    {
        Schema::table('gwf_advertisements_advertisements', function($table)
        {
            $table->dropColumn('updated_at');
        });
    }
}
