<?php namespace Gwf\announcements\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGwfAnnouncementsAnnouncements extends Migration
{
    public function up()
    {
        Schema::table('gwf_announcements_announcements', function($table)
        {
            $table->dropColumn('author');
        });
    }
    
    public function down()
    {
        Schema::table('gwf_announcements_announcements', function($table)
        {
            $table->text('author');
        });
    }
}
