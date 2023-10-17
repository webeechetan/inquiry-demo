<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->string("first_name")->nullable();
            $table->string("last_name")->nullable();
            $table->string("email")->nullable();
            $table->string("phone")->nullable();
            $table->string("company_name");
            $table->string("requirements")->nullable();
            $table->string("budget");
            $table->string("captcha")->nullable();
            $table->unsignedBigInteger("handled_by")->nullable();
            $table->foreign("handled_by")->references("id")->on("users")->onDelete("cascade");
            $table->string('L1')->nullable()->comment('Done , Not Done');
            $table->longText('L1_minutes')->nullable();
            $table->string('brief')->nullable()->comment('Done , Not Done');
            $table->longText('brief_details')->nullable();
            $table->boolean('commercial')->nullable();
            $table->string('lead_source')->nullable();
            $table->string('lead_status')->nullable()->default('Lead')->comment('Oppurtunity, Qualified Lead, Lead, AWOL, Converted');
            $table->dateTime('first_contacted')->nullable();
            $table->dateTime('last_client_contacted')->nullable();
            $table->dateTime('last_contacted')->nullable();
            $table->longText('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inquiries');
    }
};
