<?php

use Illuminate\Database\Seeder;


use Illuminate\Support\Str; //importo il modello Str per riuscire a fare la versiione slugata del nome del tag
use App\Tag;    //importo il modello
class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $tags = ['routine','lifestyle','viaggi'];
        foreach($tags as $tag)
        {
            $new_Tag = new Tag();
            $new_Tag->name = $tag;
            $new_Tag->slug = Str::slug($tag);
            $new_Tag->save();
        }
    }
}
