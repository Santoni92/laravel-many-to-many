<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCoverPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //aggiungo la colonna cover
        Schema::table('posts',function(Blueprint $table){
            $table -> string('cover')->nullable()->after('slug');   //nullable serve per dire che non necessariamente dobiamo riempire questo campo della tabella
            //after() serve per dire che la colonna 'cover' va messa dopo la colonna 'slug'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('posts',function(Blueprint $table){
            $table->dropColumn('cover');
        });
    }
}

