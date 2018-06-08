<?php

use Illuminate\Database\Seeder;
// use DB;

class OfficemateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('tblGender')->insert(
        [
          [ 'Gender' => 'Male'],
          [ 'Gender' => 'Female'],
        ]
      );

      DB::table('users')->insert(
        [
          [ 'first_name' => 'Stanley', 'last_name' => 'Ume', 'email' => 'stanley.umeanozie@cavidel.com', 'password' => bcrypt('secret'), 'is_superadmin' => '1', 'code' => uniqid()],
        ]
      );

    }
}
