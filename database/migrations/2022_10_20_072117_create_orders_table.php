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
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('innerCode')->unique();
            $table->string('outerCode')->nullable();
            $table->string('description')->nullable();
            $table->integer('hourSW')->default(0);
            $table->integer('hourMS')->default(0);
            $table->integer('hourFAT')->default(0);
            $table->integer('hourSAF')->default(0);
            $table->dateTime('opening');
            $table->dateTime('closing')->nullable();
            $table->timestamps();

            $table->foreignId('customer_id')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('created_by')
                ->constrained('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignId('company_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('country_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('status_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('job_type_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropConstrainedForeignId('customer_id');
            $table->dropConstrainedForeignId('user_id');
            $table->dropConstrainedForeignId('created_by');
            $table->dropConstrainedForeignId('company_id');
            $table->dropConstrainedForeignId('country_id');
            $table->dropConstrainedForeignId('status_id');
            $table->dropConstrainedForeignId('job_type_id');
        });
        Schema::dropIfExists('orders');
    }
};
