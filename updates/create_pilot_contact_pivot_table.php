<?php namespace Pensoft\Pilots\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;


class CreatePilotContactTable extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('pensoft_pilot_contact_pivot'))
        {
            Schema::create('pensoft_pilot_contact_pivot', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('pilot_id')->unsigned();
                $table->integer('contact_id')->unsigned();

                $table->foreign('pilot_id')->references('id')->on('pensoft_pilots_pilots')->onDelete('cascade');

                $table->unique(['pilot_id', 'contact_id'], 'pilot_contact_unique');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('pensoft_pilot_contact_pivot'))
        {
            Schema::dropIfExists('pensoft_pilot_contact_pivot');
        }
    }
}
