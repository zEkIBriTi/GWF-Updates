<?php namespace Gwf\Announcements\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateGwfAnnouncementsAnnouncements extends Migration
{
    public function up()
    {
        Schema::create('gwf_announcements_announcements', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('title');
            $table->text('author');
            $table->text('content');
            $table->dateTime('published_date');
            $table->integer('activation_status');
            $table->text('slug');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->integer('user_id');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('gwf_announcements_announcements');
    }
}
