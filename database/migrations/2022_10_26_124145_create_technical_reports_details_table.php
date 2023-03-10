<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('technical_report_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hour_id')
                    ->constrained()
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();

            $table->foreignId('technical_report_id')
                    ->constrained()
                    ->cascadeOnUpdate()
                    ->cascadeOnDelete();

            $table->boolean('nightEU')->default(false);
            $table->boolean('nightExtraEU')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('technical_report_details', function (Blueprint $table) {
            $table->dropConstrainedForeignId('hour_id');
            $table->dropConstrainedForeignId('technical_report_id');
        });
        Schema::dropIfExists('technical_report_details');
    }
};
