<?php namespace gwf\Publication\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGwfPublicationPublications extends Migration
{
    public function up()
    {
        Schema::table('gwf_publication_publications', function($table)
        {
            $table->text('document_link');
        });
    }
    
    public function down()
    {
        Schema::table('gwf_publication_publications', function($table)
        {
            $table->dropColumn('document_link');
        });
    }
}
