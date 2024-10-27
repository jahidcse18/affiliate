<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_wallets_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWalletsTable extends Migration {
    public function up() {
        Schema::create('wallets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->decimal('balance', 10, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('wallets');
    }
}
