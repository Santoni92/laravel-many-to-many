<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('title');
            $table->text('content');
            $table->string('slug')->unique();   //Lo slug è un campo univoco, si usa in modo tale che nella SEO gli indirizzi dei post non siano determinati dai loro ID
                                                //Immagina la differenza tra www.sito.com/12423451233 e www.sito.com/panini-al-tonno
                                                //Il secondo è molto più parlante

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
