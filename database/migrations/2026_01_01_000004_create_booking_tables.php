<?php
use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; use Illuminate\Support\Facades\Schema;
return new class extends Migration { public function up(): void {
 Schema::create('bookings',function(Blueprint $t){$t->id();$t->string('booking_no')->unique();$t->foreignId('user_id')->constrained()->cascadeOnDelete();$t->string('event_type');$t->date('event_date');$t->time('start_time')->nullable();$t->time('end_time')->nullable();$t->text('venue');$t->unsignedInteger('guest_count');$t->foreignId('package_id')->nullable()->nullOnDelete();$t->decimal('budget',12,2)->nullable();$t->text('special_requirements')->nullable();$t->enum('status',['pending','contacted','quotation_sent','confirmed','in_progress','completed','cancelled','rejected'])->default('pending');$t->text('admin_notes')->nullable();$t->timestamps();$t->index(['event_date','status']);});
 Schema::create('booking_items',function(Blueprint $t){$t->id();$t->foreignId('booking_id')->constrained()->cascadeOnDelete();$t->foreignId('food_id')
    ->constrained('foods')
    ->restrictOnDelete();$t->unsignedInteger('quantity')->default(1);$t->string('notes')->nullable();$t->timestamps();});
 Schema::create('booking_additional_services',function(Blueprint $t){$t->id();$t->foreignId('booking_id')->constrained()->cascadeOnDelete();$t->foreignId('additional_service_id')->constrained()->cascadeOnDelete();$t->timestamps();$t->unique(
    ['booking_id', 'additional_service_id'],
    'booking_additional_service_unique'
);});
 Schema::create('booking_status_histories',function(Blueprint $t){$t->id();$t->foreignId('booking_id')->constrained()->cascadeOnDelete();$t->string('status');$t->text('note')->nullable();$t->timestamps();});
 Schema::create('food_tasting_requests',function(Blueprint $t){$t->id();$t->foreignId('user_id')->nullable()->nullOnDelete();$t->string('name');$t->string('email')->nullable();$t->string('phone');$t->string('event_type')->nullable();$t->date('event_date')->nullable();$t->unsignedInteger('guest_count')->nullable();$t->date('preferred_date');$t->time('preferred_time')->nullable();$t->text('location')->nullable();$t->string('food_preference')->nullable();$t->text('message')->nullable();$t->enum('status',['pending','confirmed','rescheduled','completed','cancelled'])->default('pending');$t->text('admin_notes')->nullable();$t->timestamps();});
 Schema::create('enquiries',function(Blueprint $t){$t->id();$t->string('name');$t->string('email')->nullable();$t->string('phone')->nullable();$t->string('subject')->nullable();$t->text('message');$t->enum('status',['new','read','replied'])->default('new');$t->text('admin_notes')->nullable();$t->timestamps();});
}};
