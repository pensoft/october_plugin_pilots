<?php namespace Pensoft\Pilots\Updates;

use Schema;
use Illuminate\Database\Schema\Blueprint;
use October\Rain\Database\Updates\Migration;

class UpdatePilotsTable extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('pensoft_pilots_pilots', 'pilot_number')) {
            Schema::table('pensoft_pilots_pilots', function (Blueprint $table) {
                $table->integer('pilot_number')->unique()->nullable();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('pensoft_pilots_pilots', 'pilot_number')) {
            Schema::table('pensoft_pilots_pilots', function (Blueprint $table) {
                $table->dropColumn('pilot_number');
            });
        }
    }
}
