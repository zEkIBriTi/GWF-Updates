<?php namespace Gwf\News\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGwfNewsNews extends Migration
{
    public function up()
    {
        Schema::table('gwf_news_news', function($table)
        {
            $table->string('title', 255)->change();
            $table->string('slug', 255)->change();
        });
    }
    
    public function down()
    {
        Schema::table('gwf_news_news', function($table)
        {
            $table->string('title', 250)->change();
            $table->string('slug', 250)->change();
        });
    }
}
