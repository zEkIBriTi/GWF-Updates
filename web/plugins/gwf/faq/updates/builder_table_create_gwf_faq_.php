<?php namespace Gwf\Faq\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateGwfFaq extends Migration
{
    public function up()
    {
        Schema::create('gwf_faq_', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('questions');
            $table->string('answers');
            $table->integer('activation_status');
            $table->date('created_at');
            $table->date('updated_at');
            $table->integer('user_id');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('gwf_faq_');
    }
}
