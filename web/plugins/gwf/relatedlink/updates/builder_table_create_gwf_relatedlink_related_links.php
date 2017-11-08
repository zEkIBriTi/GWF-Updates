<?php namespace gwf\Relatedlink\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateGwfRelatedlinkRelatedLinks extends Migration
{
    public function up()
    {
        Schema::create('gwf_relatedlink_related_links', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title', 255);
            $table->string('url', 255);
            $table->boolean('activation_status');
            $table->date('created_at');
            $table->date('update_at');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('gwf_relatedlink_related_links');
    }
}
