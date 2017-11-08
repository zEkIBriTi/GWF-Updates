<?php namespace Gwf\Advertisements\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateGwfAdvertisementsAdvertisements extends Migration
{
    public function up()
    {
        Schema::create('gwf_advertisements_advertisements', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('title', 250);
            $table->text('content');
            $table->date('created_at');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('gwf_advertisements_advertisements');
    }
}
