<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_commission_rates_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommissionRatesTable extends Migration {
    public function up() {
        Schema::create('commission_rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products');
            $table->decimal('rate', 5, 2);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('commission_rates');
    }
}

