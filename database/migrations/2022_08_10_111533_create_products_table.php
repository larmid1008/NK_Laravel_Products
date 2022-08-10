<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('products', static function(Blueprint $table) {
            $table->id();
            $table->string("title", 75);
            $table->text("description")->nullable();
            $table->float("price");
            $table->string("image_url", 255)->nullable();
            $table->timestamps();
            $table->dateTimeTz("published_at")->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
