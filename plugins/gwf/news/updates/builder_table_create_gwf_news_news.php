<?php namespace Gwf\News\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateGwfNewsNews extends Migration
{
    public function up()
    {
        Schema::create('gwf_news_news', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title', 250);
            $table->text('content');
            $table->date('published_date');
            $table->boolean('activation_status');
            $table->integer('recorder');
            $table->string('slug', 250);
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('gwf_news_news');
    }
}
