<?php namespace Gwf\Faq\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGwfFaqFaq2 extends Migration
{
    public function up()
    {
        Schema::table('gwf_faq_faq', function($table)
        {
            $table->string('slug');
        });
    }
    
    public function down()
    {
        Schema::table('gwf_faq_faq', function($table)
        {
            $table->dropColumn('slug');
        });
    }
}
