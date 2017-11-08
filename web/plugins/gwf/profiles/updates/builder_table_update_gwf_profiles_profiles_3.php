<?php namespace Gwf\Profiles\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGwfProfilesProfiles3 extends Migration
{
    public function up()
    {
        Schema::table('gwf_profiles_profiles', function($table)
        {
            $table->integer('recorder');
        });
    }
    
    public function down()
    {
        Schema::table('gwf_profiles_profiles', function($table)
        {
            $table->dropColumn('recorder');
        });
    }
}
