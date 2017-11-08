<?php namespace Gwf\Gallery\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateGwfGalleryGalleries extends Migration
{
    public function up()
    {
        Schema::create('gwf_gallery_galleries', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->integer('activation_status');
            $table->integer('recorder');
            $table->date('created_at');
            $table->timestamp('updated_at');
            $table->string('slug');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('gwf_gallery_galleries');
    }
}
