<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_affiliate_commissions_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffiliateCommissionsTable extends Migration {
    public function up() {
        Schema::create('affiliate_commissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('affiliate_link_id')->constrained('affiliate_links');
            $table->foreignId('order_id')->constrained('orders');
            $table->decimal('commission_amount', 10, 2);
            $table->enum('status', ['pending', 'approved', 'refunded'])->default('pending');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('affiliate_commissions');
    }
}
