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

            $table->string('company_name');
            $table->string('mm_company_name')->nullable();

            $table->string('business_name');
            $table->string('mm_business_name')->nullable();
            $table->string('registration_number');

            $table->string('bussiness_email')->unique();
            $table->string('bussiness_mobile')->unique();
            $table->text('address')->nullable();
            
            $table->string('website_url')->nullable();
            $table->string('approximate_sale')->nullable();

            $table->integer('status')->default(0);
            $table->boolean('active')->default(1);

            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('last_updated_by')->nullable();

            $table->timestamp('approved_at')->nullable();

            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();

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
