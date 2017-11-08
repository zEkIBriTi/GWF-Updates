<?php namespace Gwf\Tender\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableUpdateGwfTenderTender extends Migration
{
    public function up()
    {
        Schema::table('gwf_tender_tender', function($table)
        {
            $table->increments('id')->unsigned(false)->change();
            $table->date('created_at')->nullable(false)->unsigned(false)->default(null)->change();
            $table->date('updated_at')->nullable(false)->unsigned(false)->default(null)->change();
            $table->string('slug')->nullable()->change();
            $table->integer('recorder')->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('gwf_tender_tender', function($table)
        {
            $table->increments('id')->unsigned()->change();
            $table->timestamp('created_at')->nullable(false)->unsigned(false)->default('0000-00-00 00:00:00')->change();
            $table->timestamp('updated_at')->nullable(false)->unsigned(false)->default('0000-00-00 00:00:00')->change();
            $table->string('slug', 255)->nullable(false)->change();
            $table->integer('recorder')->nullable(false)->change();
        });
    }
}
