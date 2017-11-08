<?php namespace Gwf\Contactus\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class BuilderTableCreateGwfContactusContactus extends Migration
{
    public function up()
    {
        Schema::create('gwf_contactus_contactus', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('physical_address', 200);
            $table->string('post_address', 200);
            $table->string('email', 255);
            $table->string('phone', 20);
            $table->string('mobile', 20);
            $table->string('fax', 50);
            $table->integer('user_d');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('gwf_contactus_contactus');
    }
}
