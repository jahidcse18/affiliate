<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_affiliate_links_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffiliateLinksTable extends Migration {
    public function up() {
        Schema::create('affiliate_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('unique_code')->unique();
            $table->integer('clicks')->default(0);
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('affiliate_links');
    }
}
