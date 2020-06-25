<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientSocialMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('client_social_media', function (Blueprint $table) {

            
            $table->integer('clients_id')->unsigned();
            $table->foreign('clients_id')->references('id')->on('clients') ->onDelete('cascade');
            $table->bigInteger('socialmedia_id')->unsigned();
            $table->foreign('socialmedia_id')->references('id')->on('socialMedia')->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('client_social_media');
    }
}
