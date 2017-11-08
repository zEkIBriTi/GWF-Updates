<?php namespace Gwf\Profiles\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateGwfProfilesProfiles extends Migration
{
    public function up()
    {
        Schema::create('gwf_profiles_profiles', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id')->unsigned();
            $table->string('salutation', 15);
            $table->string('name', 250);
            $table->string('title', 250);
            $table->text('bio');
            $table->string('image_url', 250);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('gwf_profiles_profiles');
    }
}
