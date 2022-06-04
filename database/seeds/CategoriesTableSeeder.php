<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Str; //importo la classe Slug così da ottenere la versione slugata del name
use App\Category;   //importo il modello
class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $categories = ['Spa','Trattamenti','Cibo','Wellness'];
        foreach($categories as $category)
        {
            $new_category_object = new Category();
            $new_category_object->name = $category;
            $new_category_object->slug = Str::slug( $category);
            $new_category_object->save();
        }
    }
}
