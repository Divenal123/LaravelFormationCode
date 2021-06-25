<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Item;
use App\Models\Order;
use App\Models\Invoice;
use App\Models\User;
use Faker;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker\Factory::create();

        // Let's make two users
        $user1 = User::create(['name' => $faker->name]);
        $user2 = User::create(['name' => $faker->name]);

        // Create two categories, each having two subcategories
        $category1 = Category::create(['name' => $faker->word]);
        $category2 = Category::create(['name' => $faker->word]);

        $subCategory1 = SubCategory::create(['name' => $faker->word, 'category_id' => $category1->id]);
        $subCategory2 = SubCategory::create(['name' => $faker->word, 'category_id' => $category1->id]);

        $subCategory3 = SubCategory::create(['name' => $faker->word, 'category_id' => $category2->id]);
        $subCategory4 = SubCategory::create(['name' => $faker->word, 'category_id' => $category2->id]);

        // After categories, well, we have items
        // Let's create two items each for sub-category 2 and 4
        $item1 = Item::create([
            'sub_category_id' => 2,
            'name' => $faker->name,
            'description' => $faker->text,
            'type' => $faker->word,
            'price' => $faker->randomNumber(2),
            'quantity_in_stock' => $faker->randomNumber(2),
        ]);

        $item2 = Item::create([
            'sub_category_id' => 2,
            'name' => $faker->name,
            'description' => $faker->text,
            'type' => $faker->word,
            'price' => $faker->randomNumber(3),
            'quantity_in_stock' => $faker->randomNumber(2),
        ]);

        $item3 = Item::create([
            'sub_category_id' => 4,
            'name' => $faker->name,
            'description' => $faker->text,
            'type' => $faker->word,
            'price' => $faker->randomNumber(4),
            'quantity_in_stock' => $faker->randomNumber(2),
        ]);

        $item4 = Item::create([
            'sub_category_id' => 4,
            'name' => $faker->name,
            'description' => $faker->text,
            'type' => $faker->word,
            'price' => $faker->randomNumber(1),
            'quantity_in_stock' => $faker->randomNumber(3),
        ]);

        // Now that we have users and items, let's make user1 place a couple of orders
        $order1 = Order::create([
            'status' => 'confirmed',
            'total_value' => $faker->randomNumber(3),
            'taxes' => $faker->randomNumber(1),
            'shipping_charges' => $faker->randomNumber(2),
            'user_id' => $user1->id
        ]);

        $order2 = Order::create([
            'status' => 'waiting',
            'total_value' => $faker->randomNumber(3),
            'taxes' => $faker->randomNumber(1),
            'shipping_charges' => $faker->randomNumber(2),
            'user_id' => $user1->id
        ]);

        // now, assigning items to orders
        $order1->items()->attach($item1);
        $order1->items()->attach($item2);
        $order1->items()->attach($item3);

        $order2->items()->attach($item1);
        $order2->items()->attach($item4);

        // and finally, create invoices
        $invoice1 = Invoice::create([
            'raised_at' => $faker->dateTimeThisMonth(),
            'status' => 'settled',
            'totalAmount' => $faker->randomNumber(3),
            'order_id' => $order1->id,
        ]);
    }
}
