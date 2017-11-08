<?php namespace gwf\Publication\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateGwfPublicationPublications extends Migration
{
    public function up()
    {
        Schema::create('gwf_publication_publications', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title', 250);
            $table->integer('publicationcategory_id');
            $table->boolean('activation_status');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->string('slug', 250);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('gwf_publication_publications');
    }
}
