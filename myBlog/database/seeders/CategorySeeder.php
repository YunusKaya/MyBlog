<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $data=['Bilim','Teknoloji','Yazılım','Uzay','Gelecek','Tarih','Evrim','Sağlık','Yaşam'];
        foreach ($data as $dat)
        {
            DB::table('categories')->insert([
                'name'=>$dat,
                'slug'=>(Str::slug($dat).uniqid())
            ]);
        }
    }
}
