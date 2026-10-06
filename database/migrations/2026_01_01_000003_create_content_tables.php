<?php
use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up(): void {
 Schema::create('galleries',function(Blueprint $t){$t->id();$t->string('title');$t->text('description')->nullable();$t->enum('type',['image','video'])->default('image');$t->string('file_path')->nullable();$t->string('thumbnail')->nullable();$t->string('category')->nullable();$t->boolean('status')->default(true);$t->unsignedInteger('sort_order')->default(0);$t->timestamps();});
 Schema::create('videos',function(Blueprint $t){$t->id();$t->string('title');$t->text('description')->nullable();$t->string('video_url');$t->string('thumbnail')->nullable();$t->boolean('status')->default(true);$t->unsignedInteger('sort_order')->default(0);$t->timestamps();});
 Schema::create('testimonials',function(Blueprint $t){$t->id();$t->string('customer_name');$t->string('designation')->nullable();$t->string('image')->nullable();$t->unsignedTinyInteger('rating')->default(5);$t->text('testimonial');$t->boolean('status')->default(true);$t->unsignedInteger('sort_order')->default(0);$t->timestamps();});
 Schema::create('website_settings',function(Blueprint $t){$t->id();$t->string('key')->unique();$t->text('value')->nullable();$t->timestamps();});
}};
