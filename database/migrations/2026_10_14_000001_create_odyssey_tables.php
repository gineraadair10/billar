<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('products', function (Blueprint $t) {
            $t->id();
            $t->string('name');
            $t->string('slug')->unique();
            $t->text('description');
            $t->unsignedInteger('price');           // MXN
            $t->string('badge')->nullable();        // Destacado | Nuevo | Más vendido
            $t->string('tone', 7)->default('#1f3a2c'); // color del placeholder
            $t->string('image')->nullable();        // ruta en public/images
            $t->json('sizes');                      // [{label, extra}]
            $t->json('colors');                     // [{name, hex}]
            $t->json('surfaces');                   // ["Madera", "Pizarra"]
            $t->timestamps();
        });
        Schema::create('orders', function (Blueprint $t) {
            $t->id();
            $t->string('number')->unique();
            $t->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $t->string('name'); $t->string('email'); $t->string('phone');
            $t->string('address'); $t->string('city'); $t->text('notes')->nullable();
            $t->unsignedInteger('total');
            $t->string('status')->default('pendiente');
            $t->timestamps();
        });
        Schema::create('order_items', function (Blueprint $t) {
            $t->id();
            $t->foreignId('order_id')->constrained()->cascadeOnDelete();
            $t->foreignId('product_id')->nullable()->constrained()->nullOnDelete();
            $t->string('name'); $t->string('size'); $t->string('color'); $t->string('surface');
            $t->unsignedInteger('unit_price'); $t->unsignedSmallInteger('qty');
            $t->timestamps();
        });
        Schema::create('contact_messages', function (Blueprint $t) {
            $t->id();
            $t->string('name'); $t->string('email'); $t->string('subject')->nullable();
            $t->text('message'); $t->timestamps();
        });
    }
    public function down(): void {
        foreach (['contact_messages','order_items','orders','products'] as $n) Schema::dropIfExists($n);
    }
};
