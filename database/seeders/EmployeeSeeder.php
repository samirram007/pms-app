<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Employee::create([
            'name' => 'Priyanshu',
            'email' => 'employeeyop@gmail.com',
            'password' => bcrypt('password'),
            'code' => '123456789',
        ]);
    }
}
