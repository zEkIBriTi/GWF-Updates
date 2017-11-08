<?php namespace Gwf\Profiles\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGwfProfilesProfiles4 extends Migration
{
    public function up()
    {
        Schema::table('gwf_profiles_profiles', function($table)
        {
            $table->dropColumn('image_url');
        });
    }
    
    public function down()
    {
        Schema::table('gwf_profiles_profiles', function($table)
        {
            $table->string('image_url', 250);
        });
    }
}
