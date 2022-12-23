<?php namespace Webmaxx\Seo\Updates;

use Schema;
use Winter\Storm\Database\Updates\Migration;

class CreateTagsTable extends Migration
{
    public function up()
    {
        Schema::create('webmaxx_seo_tags', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('tags')->nullable();
            $table->string('taggable_id')->index()->nullable();
            $table->string('taggable_type')->index()->nullable();
            $table->timestamps();

            $table->unique(['taggable_id', 'taggable_type']);
        });
    }

    public function down()
    {
        Schema::drop('webmaxx_seo_tags');
    }
}
