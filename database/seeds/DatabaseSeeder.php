<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleTableSeeder::class);
  // User seeder will use the roles above created.
  		$this->call(UserTableSeeder::class);
        $this->call(CourceTableSeeder::class);
        $this->call(StudentTableSeeder::class);
        $this->call(ParentsTableSeeder::class);
        $this->call(ParentStudentTableSeeder::class);

        
        

    }
}
