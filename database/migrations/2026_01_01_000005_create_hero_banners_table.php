<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('hero_banners', function (Blueprint $t) {
            $t->id();
            $t->string('title');
            $t->text('subtitle')->nullable();
            $t->string('button_text')->nullable();
            $t->string('button_url')->nullable();
            $t->string('secondary_button_text')->nullable();
            $t->string('secondary_button_url')->nullable();
            $t->string('image');
            $t->string('mobile_image')->nullable();
            $t->boolean('status')->default(true);
            $t->unsignedInteger('sort_order')->default(0);
            $t->timestamps();
            $t->index(['status','sort_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_banners');
    }
};
