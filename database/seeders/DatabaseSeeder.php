<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\CategoryItem;
use App\Models\Item;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@szerveroldali.hu',
            'is_admin' => true,
            'password' => Hash::make('password'),
        ]);
        User::create([
            'name' => 'user1',
            'email' => 'user1@szerveroldali.hu',
            'is_admin' => false,
            'password' => Hash::make('password'),
        ]);

        //Category
        Category::create([
            'name' => 'Monitor',
        ]);
        Category::create([
            'name' => 'Bill',
        ]);
        Category::create([
            'name' => 'Kacsák',
        ]);

        //items

        Item::create([
            'name' => 'Samsung',
            'description' => 'eh',
            'price' => 10,
        ]);
        Item::create([
            'name' => 'LG',
            'description' => '(y)',
            'price' => 100,
        ]);
        Item::create([
            'name' => 'Apple',
            'description' => ':)',
            'price' => 2100,
        ]);
        Item::create([
            'name' => 'Nokia',
            'description' => 'Finn',
            'price' => 89000,
        ]);
        Item::create([
            'name' => 'Mercedes',
            'description' => 'Amg',
            'price' => 577000,
        ]);
        Item::create([
            'name' => 'BMW',
            'description' => 'M5',
            'price' => 700,
        ]);
        Item::create([
            'name' => 'Audi',
            'description' => 'négykarika',
            'price' => 43000,
        ]);
        Item::create([
            'name' => 'Renault',
            'description' => 'clio',
            'price' => 50400,
        ]);
        Item::create([
            'name' => 'Tesla',
            'description' => 'Model3',
            'price' => 50600,
        ]);

        CategoryItem::create([
            'category_id' => 1,
            'item_id' => 1,
        ]);
        CategoryItem::create([
            'category_id' => 1,
            'item_id' => 2,
        ]);
        CategoryItem::create([
            'category_id' => 1,
            'item_id' => 3,
        ]);
        CategoryItem::create([
            'category_id' => 2,
            'item_id' => 4,
        ]);
        CategoryItem::create([
            'category_id' => 2,
            'item_id' => 5,
        ]);
        CategoryItem::create([
            'category_id' => 2,
            'item_id' => 6,
        ]);
        CategoryItem::create([
            'category_id' => 3,
            'item_id' => 7,
        ]);
        CategoryItem::create([
            'category_id' => 3,
            'item_id' => 8,
        ]);
        CategoryItem::create([
            'category_id' => 3,
            'item_id' => 9,
        ]);



    }
}
