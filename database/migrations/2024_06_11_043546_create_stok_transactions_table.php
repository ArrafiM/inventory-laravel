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
        Schema::create('stok_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('item_id')
                    ->nullable()
                    ->constrained('items')
                    ->nullOnDelete();
            $table->integer('status'); // 1(in) or 2(out)
            $table->integer('qty');
            $table->foreignId('supplier_id')
                    ->nullable()
                    ->constrained('suppliers')
                    ->nullOnDelete();
            $table->foreignId('created_by')
                    ->nullable()
                    ->constrained('users')
                    ->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stok_transactions');
    }
};
