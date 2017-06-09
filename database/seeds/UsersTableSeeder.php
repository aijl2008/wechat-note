<?php
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run () {
        DB::statement ( 'truncate table users' );
        DB::table ( 'users' )->insert ( [
            'id' => 1 ,
            'name' => 'Jerry' ,
            'email' => 'awz@awz.cn' ,
            'password' => bcrypt ( '790928' ) ,
            'created_at' => date ( 'Y-m-d H:i:s' ) ,
            'updated_at' => date ( 'Y-m-d H:i:s' ) ,
        ] );
    }
}
