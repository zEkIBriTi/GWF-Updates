<?php namespace gwf\Howdoi\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateGwfHowdoiHowdoi extends Migration
{
    public function up()
    {
        Schema::create('gwf_howdoi_howdoi', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title', 250);
            $table->text('description');
            $table->text('slug');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('gwf_howdoi_howdoi');
    }
}
