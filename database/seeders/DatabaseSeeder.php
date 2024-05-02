<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Book;
use App\Models\Review;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {   
        Book::factory(33)->create()->each(function (Book $book) { 
          $numreviews = random_int(5,30);

        Review::factory(0)->count($numreviews)
            ->good()
            ->for($book)
            ->create();
        }); 
        
        Book::factory(33)->create()->each(function (Book $book) { 
          $numreviews = random_int(5,30);

        Review::factory(0)->count($numreviews)
            ->average()
            ->for($book)
            ->create();
        });       
        
        Book::factory(33)->create()->each(function (Book $book) { 
          $numreviews = random_int(5,30);

        Review::factory(0)->count($numreviews)
            ->bad()
            ->for($book)
            ->create();
        });
    }
}
