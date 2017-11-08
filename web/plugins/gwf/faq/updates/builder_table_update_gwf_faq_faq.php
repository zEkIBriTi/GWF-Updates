<?php namespace Gwf\Faq\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGwfFaqFaq extends Migration
{
    public function up()
    {
        Schema::rename('gwf_faq_', 'gwf_faq_faq');
        Schema::table('gwf_faq_faq', function($table)
        {
            $table->increments('id')->unsigned(false)->change();
        });
    }
    
    public function down()
    {
        Schema::rename('gwf_faq_faq', 'gwf_faq_');
        Schema::table('gwf_faq_', function($table)
        {
            $table->increments('id')->unsigned()->change();
        });
    }
}
