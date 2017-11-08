<?php namespace Gwf\Profiles\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGwfProfilesProfiles5 extends Migration
{
    public function up()
    {
        Schema::table('gwf_profiles_profiles', function($table)
        {
            $table->boolean('activation_status');
        });
    }
    
    public function down()
    {
        Schema::table('gwf_profiles_profiles', function($table)
        {
            $table->dropColumn('activation_status');
        });
    }
}
