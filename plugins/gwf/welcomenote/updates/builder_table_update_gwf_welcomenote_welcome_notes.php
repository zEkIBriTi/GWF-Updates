<?php namespace Gwf\Welcomenote\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGwfWelcomenoteWelcomeNotes extends Migration
{
    public function up()
    {
        Schema::table('gwf_welcomenote_welcome_notes', function($table)
        {
            $table->string('slug', 250);
        });
    }
    
    public function down()
    {
        Schema::table('gwf_welcomenote_welcome_notes', function($table)
        {
            $table->dropColumn('slug');
        });
    }
}
