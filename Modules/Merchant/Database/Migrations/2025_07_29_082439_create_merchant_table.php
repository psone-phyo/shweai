<?php

use App\Enums\Table;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMerchantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Table::MERCHANTS, function (Blueprint $table) {
            $table->increments('id');

            $table->string('name');
            $table->string('mm_name')->nullable();

            $table->string('business_name')->nullable();
            $table->string('mm_business_name')->nullable();

            $table->string('email')->unique();
            $table->string('phone');
            $table->text('address')->nullable();

            $table->integer('status')->default(0);

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();

            $table->timestamp('approved_at')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Table::MERCHANTS);
    }
}
