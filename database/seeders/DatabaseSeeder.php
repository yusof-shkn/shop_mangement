<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use App\Models\products;
use App\Models\category;
use App\Models\employees;
use App\Models\Expense;
use App\Models\Income;
use App\Models\purchases;
use App\Models\roles;
use App\Models\Salary;
use App\Models\sales;
use App\Models\Shift;
use Carbon\Carbon;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
       Role::create(['name'=>'admin']);
       Role::create(['name'=>'inventory_manager']);
       Role::create(['name'=>'service_manager']);

       $yusof = User::create([
        'name' => 'yusof',
        'username' => 'yusof_0090',
        'role' => 1,
        'email' => 'yusof.shkn21@gmail.com',
        'password' => Hash::make('password'),
        'email_verified_at' => now(),
       ]);
       $yusof->assignRole('admin');

       $admin = Admin::create([
        'user_id' => $yusof->id,
       ]);

       $bozorg = employees::create([
        'admin_id' => $admin->id,
        'name' => 'bozorg',
        'phone_number' => '909342029',
        'hourly_rate' => 123,
        'role' => 2,
        ]);
       $bozorg2 = User::create([
        'name' => 'bozorg',
        'username' => 'bozorg',
        'admin_id' => $admin->id,
        'manager_id'=> $bozorg->id,
        'role' => 2,
        'email' => 'yusof.shkn21@gmail.com',
        'password' => Hash::make('password'),
        'email_verified_at' => now(),
       ]);
       $bozorg2->assignRole('inventory_manager');

       $sonira = employees::create([
        'admin_id' => $admin->id,
        'name' => 'sonira',
        'phone_number' => '49812339',
        'hourly_rate' => 123,
        'role' => 3,
        ]);

        $sonira2 = User::create([
            'name' => 'sonira',
            'username' => 'sonira',
            'admin_id' => $admin->id,
            'manager_id' => $sonira->id,
            'role' => 3,
            'email' => 'yusof.shkn21@gmail.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);
        $sonira2->assignRole('service_manager');

        for($i=1;$i<=30;$i++){
            $startDate = Carbon::now()->subDays(30);
            $endDate = Carbon::now();
            $randomDate = Carbon::createFromTimestamp(mt_rand($startDate->timestamp,$endDate->timestamp));
            $start_time = $randomDate->format('H:i:s');
            $end_time = $randomDate->addHours(rand(0,12))->format('H:i:s');

            $startTimeObj = Carbon::createFromFormat('H:i:s', $start_time);
            $endTimeObj = Carbon::createFromFormat('H:i:s', $end_time);

            if($endTimeObj < $startTimeObj){
                $endTimeObj->addDay();
            }
            $totalHours = $endTimeObj->diffInHours($startTimeObj);
            $totalAmountSonira = $totalHours * $sonira->hourly_rate;
            $totalAmountBozorg = $totalHours * $bozorg->hourly_rate;
            
            Shift::create([
                'admin_id'=>$admin->id,
                'employee_id'=>$sonira->id,
                'start_time' => $start_time,
                'end_time' => $end_time,
                'totalHours' => $totalHours,
                'totalAmount' => $totalAmountSonira,
                'created_at' => $randomDate,
                'updated_at' => $randomDate,

            ]);
            Shift::create([
                'admin_id'=>$admin->id,
                'employee_id'=>$bozorg->id,
                'start_time' => $start_time,
                'end_time' => $end_time,
                'totalHours' => $totalHours,
                'totalAmount' => $totalAmountBozorg,
                'created_at' => $randomDate,
                'updated_at' => $randomDate,

            ]);
        }
        $month = 0;
        for($i=1;$i<=12;$i++){
            $startDate = Carbon::now()->subYear(1)->addMonth($month)->subDays(19);
            $endDate = Carbon::now()->subYear(1)->addMonth($month + 1)->subDays(19);
            $amount = rand(150,1500);
            Salary::create([
                'admin_id'=>$admin->id,
                'employee_id'=>$bozorg->id,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'salary_amount' => $amount,
                'created_at' => $endDate,
                'updated_at' => $endDate,
            ]);
            Salary::create([
                'admin_id'=>$admin->id,
                'employee_id'=>$sonira->id,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'salary_amount' => $amount,
                'created_at' => $endDate,
                'updated_at' => $endDate,
            ]);

            Expense::create([
                'admin_id'=>$admin->id,
                'category'=>'Salary',
                'amount'=> 2 * $amount,
                'created_at' => $endDate,
                'updated_at' => $endDate,
            ]);
        }
            $month += 1;
        $faker = Faker::create();
        for($i=1;$i<=3;$i++){
        $newRole = roles::create([
            'name'=>'example',
            'admin_id'=>$admin->id,
            ]);
            }
        for($g=0;$g<=10;$g++){
            $role = $faker->randomElement(['worker','cleaner','marketer','driver','plumber']);
            $newRole = roles::create([
                'name'=>$role,
                'admin_id'=>$admin->id,
            ]);
            $role_id = $newRole->id;

            $employee = employees::create([
                'admin_id'=>$admin->id,
                'role'=> $role_id,
                'name'=>$faker->name,
                'hourly_rate'=>'1000',
                'phone_number'=>$faker->phoneNumber,
            ]);

            
            for($i=1;$i<=30;$i++){
                $startDate = Carbon::now()->subDays(30);
                $endDate = Carbon::now();
                $randomDate = Carbon::createFromTimestamp(mt_rand($startDate->timestamp,$endDate->timestamp));
                $start_time = $randomDate->format('H:i:s');
                $end_time = $randomDate->addHours(rand(0,12))->format('H:i:s');
        
                $startTimeObj = Carbon::createFromFormat('H:i:s', $start_time);
                $endTimeObj = Carbon::createFromFormat('H:i:s', $end_time);
        
                if($endTimeObj < $startTimeObj){
                    $endTimeObj->addDay();
                }
                $totalHours = $endTimeObj->diffInHours($startTimeObj);
                $totalAmount = $totalHours * $employee->hourly_rate;
                Shift::create([
                    'admin_id'=>$admin->id,
                    'employee_id'=>$employee->id,
                    'start_time' => $start_time,
                    'end_time' => $end_time,
                    'totalHours' => $totalHours,
                    'totalAmount' => $totalAmount,
                    'created_at' => $randomDate,
                    'updated_at' => $randomDate,

                ]);
            }
            $month = 0;
            for($i=1;$i<=12;$i++){
                $startDate = Carbon::now()->subYear(1)->addMonth($month)->subDays(19);
                $endDate = Carbon::now()->subYear(1)->addMonth($month + 1)->subDays(19);
                $amount = rand(150,1500);
                Salary::create([
                    'admin_id'=>$admin->id,
                    'employee_id'=>$employee->id,
                    'start_date' => $startDate,
                    'end_date' => $endDate,
                    'salary_amount' => $amount,
                    'created_at' => $endDate,
                    'updated_at' => $endDate,
                ]);
                Expense::create([
                    'admin_id'=>$admin->id,
                    'category'=>'Salary',
                    'amount'=>$amount,
                    'created_at' => $endDate,
                    'updated_at' => $endDate,
                ]);
                $month += 1;
            }
        }
        for($i=1;$i<=3;$i++){
            $category_name = $faker->randomElement(['fruit','book','phone','Computer']);
            $category2 =category::create([
                'name' => $category_name,
                'admin_id' => $admin->id,
            ]);

            for($j=0;$j<=5;$j++){
                $Productprice = rand(10,100);
                $products =products::create([
                    'name' => "$category_name$j",
                    'admin_id' => $admin->id,
                    'category_id'=>$category2->id,
                    'price'=>$Productprice,
                    'markup'=>5,
                    'quantity'=>rand(1,20),
                    'usage'=>rand(0,100),
                ]);
                $day = 0;
                for ($x = 1; $x <= 30; $x++) {  // Assuming 12 months of sales data
                    $startDateIncome = Carbon::now()->subMonth(1)->addDays($day);
                    $quantity = rand(1,30);
                    $price = rand(10,1000);
                    $markup = 5;
                    $sellingPrice = $price + ($price * $markup / 100);
                    $total = $price * $quantity;
                    $purchase = purchases::create([
                        'product_id' => $products->id,
                        'admin_id' => $admin->id, 
                        'inventory_manager_id' => $sonira->id, 
                        'total_amount' => $total,
                        'oldPrice' => $price, 
                        'markup' => $markup, 
                        'price' => $sellingPrice, 
                        'quantity' => $quantity,
                    ]);
                    $products->update([
                        'price' => $sellingPrice,
                    ]);
                    Expense::create([
                        'admin_id'=>$admin->id,
                        'category'=>'Purchase',
                        'amount'=>$purchase->total_amount,
                        'created_at' => $startDateIncome,
                        'updated_at' => $startDateIncome,
                    ]);
                    $sale = sales::create([
                        'product_id' => $products->id,
                        'admin_id' => $admin->id, 
                        'service_manager_id' => $sonira->id, 
                        'total_amount' => $products->price * $quantity,
                        'price' => $products->price, 
                        'quantity' => $quantity,
                    ]);
                    Income::create([
                        'admin_id' => $admin->id, 
                        'category'=> 'Sales',
                        'amount'=> $sale->total_amount,
                        'created_at' => $startDateIncome,
                        'updated_at' => $startDateIncome,
                    ]);
                    $day += 1;
                }
            }
        }
    }
}