<?php namespace Gwf\Tender\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateGwfTenderTender extends Migration
{
    public function up()
    {
        Schema::create('gwf_tender_tender', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('title');
            $table->date('expire_date');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');
            $table->string('slug');
            $table->integer('recorder');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('gwf_tender_tender');
    }
}
