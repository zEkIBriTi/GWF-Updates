<?php namespace Gwf\Faq\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGwfFaqFaq3 extends Migration
{
    public function up()
    {
        Schema::table('gwf_faq_faq', function($table)
        {
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });
    }
    
    public function down()
    {
        Schema::table('gwf_faq_faq', function($table)
        {
            $table->timestamp('created_at')->default('CURRENT_TIMESTAMP');
            $table->timestamp('updated_at')->default('0000-00-00 00:00:00');
        });
    }
}
