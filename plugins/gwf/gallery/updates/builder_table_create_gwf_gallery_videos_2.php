<?php namespace Gwf\Gallery\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateGwfGalleryVideos2 extends Migration
{
    public function up()
    {
        Schema::create('gwf_gallery_videos', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title')->nullable(false)->unsigned(false)->default(null);
            $table->text('description');
            $table->string('url', 255);
            $table->boolean('activation_status');
            $table->date('created_at');
            $table->timestamp('updated_at');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('gwf_gallery_videos');
    }
}
