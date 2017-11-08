<?php namespace Flosch\Slideshow\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateFloschSlideshowSlideshows2 extends Migration
{
    public function up()
    {
        Schema::table('flosch_slideshow_slideshows', function($table)
        {
            $table->renameColumn('active', 'activate');
        });
    }
    
    public function down()
    {
        Schema::table('flosch_slideshow_slideshows', function($table)
        {
            $table->renameColumn('activate', 'active');
        });
    }
}
