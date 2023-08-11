<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no',50)->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('promoter_id')->index();
            $table->unsignedBigInteger('event_id')->index();
            $table->unsignedBigInteger('package_id')->index();
            $table->string('status');
            $table->string('payment_method',100);
            $table->double('total_amount');
            $table->string('event_slug',100);
            $table->string('event_title',100)->nullable();
            $table->text('event_description')->nullable();
            $table->string('event_banner',255)->nullable();
            $table->date('event_date',100)->nullable();
            $table->string('event_selected_package_name',100);
            $table->integer('qty');
            $table->double('price');
            $table->double('tax');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
