<?php namespace Gwf\Profiles\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGwfProfilesProfiles extends Migration
{
    public function up()
    {
        Schema::table('gwf_profiles_profiles', function($table)
        {
            $table->string('slug', 250);
        });
    }
    
    public function down()
    {
        Schema::table('gwf_profiles_profiles', function($table)
        {
            $table->dropColumn('slug');
        });
    }
}
