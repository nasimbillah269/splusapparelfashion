<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('src_id')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->string('billing_name', 100)->nullable();
            $table->string('billing_mobile', 30)->nullable();
            $table->string('billing_email', 100)->nullable();
            $table->text('billing_address')->nullable();
            $table->text('billing_note')->nullable();
            $table->string('type', 20)->nullable()->default('0')->comment('0=order, 1=Recharge,2=Refund');
            $table->string('transection_id', 100)->nullable();
            $table->string('payment_method', 50)->nullable();
            $table->float('amount', 10, 2)->default(0.00);
            $table->string('currency', 10)->nullable()->comment('BDT');
            $table->string('status', 50)->nullable()->default('Pending')->comment('Pending, Fail, Cancel, Success');
            $table->bigInteger('addedby_id')->nullable();
            $table->bigInteger('editedby_id')->nullable();
            $table->timestamps();
        });

        // Laravel 10 creates float() as DOUBLE; keep the original FLOAT(10,2) type
        DB::statement("ALTER TABLE `transactions` MODIFY `amount` FLOAT(10,2) NOT NULL DEFAULT 0.00");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
