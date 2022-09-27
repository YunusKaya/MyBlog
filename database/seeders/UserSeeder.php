<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker=Faker::create();
        DB::table('users')->insert([
            'name'=>'Yunus Kaya',
            'email'=>'yk.kayayunus@gmail.com',
            'password'=> bcrypt('102030'),
            'role'=>'admin',
            'img'=>$faker->imageUrl('800', '800', 'people'),
            'borderimg' =>$faker->imageUrl('800', '400', 'city'),
            'slug' => (Str::slug('Yunus Kaya') . uniqid()),
            'biography'=>$faker->paragraph(20),
        ]);

        for ($i=1; $i <= 6 ; $i++)
        {
            $name = $faker->firstName('male'|'female').' '.$faker->lastName;
            DB::table('users')->insert([
                'name'=>$name,
                'email'=>$faker->freeEmail,
                'password'=> bcrypt('102030'),
                'role'=>'article',
                'img'=>$faker->imageUrl('800', '800', 'people'),
                'borderimg' =>$faker->imageUrl('800', '400', 'city'),
                'slug' => (Str::slug($name) . uniqid()),
                'biography'=>$faker->paragraph(20),
            ]);
        }

    }
}
