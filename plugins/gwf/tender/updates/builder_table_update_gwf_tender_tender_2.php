<?php namespace Gwf\Tender\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGwfTenderTender2 extends Migration
{
    public function up()
    {
        Schema::table('gwf_tender_tender', function($table)
        {
            $table->boolean('activation_status');
        });
    }
    
    public function down()
    {
        Schema::table('gwf_tender_tender', function($table)
        {
            $table->dropColumn('activation_status');
        });
    }
}
