<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            if (!Schema::hasColumn('bookings', 'payment_gateway')) {
                $table->string('payment_gateway', 40)->nullable()->after('payment_method');
                $table->index(['payment_gateway']);
            }

            if (!Schema::hasColumn('bookings', 'gateway_order_id')) {
                $table->string('gateway_order_id', 120)->nullable()->after('payment_gateway');
                $table->index(['gateway_order_id']);
            }
            if (!Schema::hasColumn('bookings', 'gateway_payment_id')) {
                $table->string('gateway_payment_id', 120)->nullable()->after('gateway_order_id');
                $table->index(['gateway_payment_id']);
            }
            if (!Schema::hasColumn('bookings', 'gateway_signature')) {
                $table->string('gateway_signature', 256)->nullable()->after('gateway_payment_id');
            }

            if (!Schema::hasColumn('bookings', 'refund_id')) {
                $table->string('refund_id', 120)->nullable()->after('gateway_signature');
                $table->index(['refund_id']);
            }
            if (!Schema::hasColumn('bookings', 'refund_amount')) {
                $table->decimal('refund_amount', 10, 2)->default(0)->after('refund_id');
            }
            if (!Schema::hasColumn('bookings', 'refund_status')) {
                $table->string('refund_status', 40)->nullable()->after('refund_amount');
                $table->index(['refund_status']);
            }
            if (!Schema::hasColumn('bookings', 'refunded_at')) {
                $table->dateTime('refunded_at')->nullable()->after('refund_status');
            }
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $drops = [];
            foreach ([
                'payment_gateway',
                'gateway_order_id',
                'gateway_payment_id',
                'gateway_signature',
                'refund_id',
                'refund_amount',
                'refund_status',
                'refunded_at',
            ] as $col) {
                if (Schema::hasColumn('bookings', $col)) {
                    $drops[] = $col;
                }
            }

            if (!empty($drops)) {
                $table->dropColumn($drops);
            }
        });
    }
};

