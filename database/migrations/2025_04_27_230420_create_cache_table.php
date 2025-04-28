<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCacheTable extends Migration
{
    public function up()
    {
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary(); // Унікальний ключ для кешу
            $table->text('value'); // Серіалізовані дані
            $table->integer('expiration')->nullable(); // Час до якого кеш буде дійсним
            $table->timestamps(); // Поля created_at та updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('cache');
    }
}
