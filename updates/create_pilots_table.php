<?php namespace Pensoft\Pilots\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

/**
 * CreatePilotsTable Migration
 */
class CreatePilotsTable extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('pensoft_pilots_pilots'))
        {
            Schema::create('pensoft_pilots_pilots', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->string('title')->nullable();
                $table->boolean('published')->nullable();
                $table->text('intro')->nullable();
                $table->string('name')->nullable();
                $table->text('stakeholders')->nullable();
                $table->timestamp('timeline_start')->nullable();
                $table->timestamp('timeline_end')->nullable();
                $table->text('objectives')->nullable();
                $table->string('link_to_news')->nullable();
                $table->integer('sort_order')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('pensoft_pilots_pilots'))
        {
            Schema::dropIfExists('pensoft_pilots_pilots');
        }
    }
}
