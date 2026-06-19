<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('landing_settings', function (Blueprint $table): void {
            $table->id();

            $table->string('phone_main_tel');
            $table->string('phone_main_display');
            $table->string('phone_office_tel');
            $table->string('phone_office_display');
            $table->string('phone_mobile_tel');
            $table->string('phone_mobile_display');
            $table->string('email');
            $table->string('address');
            $table->string('address_map_url')->nullable();
            $table->string('lead_mail_to');

            $table->boolean('show_whatsapp')->default(true);
            $table->boolean('show_telegram')->default(true);
            $table->boolean('show_max')->default(true);
            $table->string('whatsapp_phone');
            $table->string('telegram_phone');
            $table->string('max_phone');

            $table->string('company_name');
            $table->string('city');
            $table->unsignedTinyInteger('work_hours_start');
            $table->unsignedTinyInteger('work_hours_end');
            $table->string('work_hours_label');
            $table->string('yandex_profile_url');
            $table->string('yandex_rating');

            $table->timestamps();
        });

        DB::table('landing_settings')->insert([
            'phone_main_tel' => '+79029905005',
            'phone_main_display' => '8 (902) 990-50-05',
            'phone_office_tel' => '+73912420808',
            'phone_office_display' => '+7 (391) 242-08-08',
            'phone_mobile_tel' => '+79029905005',
            'phone_mobile_display' => '8 (902) 990-50-05',
            'email' => 'slom24@mail.ru',
            'address' => 'Красноярск, ул. Дубровинского, 58',
            'address_map_url' => 'https://yandex.ru/maps/?text=%D0%9A%D1%80%D0%B0%D1%81%D0%BD%D0%BE%D1%8F%D1%80%D1%81%D0%BA%2C%20%D0%94%D1%83%D0%B1%D1%80%D0%BE%D0%B2%D0%B8%D0%BD%D1%81%D0%BA%D0%BE%D0%B3%D0%BE%2C%2058',
            'lead_mail_to' => config('landing.lead_mail_to') ?: 'slom24@mail.ru',
            'show_whatsapp' => true,
            'show_telegram' => true,
            'show_max' => true,
            'whatsapp_phone' => '+79029905005',
            'telegram_phone' => '+79029905005',
            'max_phone' => '+79029905005',
            'company_name' => 'СЛОМ24',
            'city' => 'Красноярск',
            'work_hours_start' => 8,
            'work_hours_end' => 20,
            'work_hours_label' => 'Ежедневно 8:00 – 20:00',
            'yandex_profile_url' => 'https://yandex.ru/profile/228669360093',
            'yandex_rating' => '5.0',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('landing_settings');
    }
};
