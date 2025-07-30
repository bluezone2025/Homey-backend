<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' =>'Nagwa Ali',
            'email' =>'nnnnali123@gmail.com',
            'password' =>\Illuminate\Support\Facades\Hash::make('123456'),
            'password_view' =>'123456',
            'job_id' =>1,
        ]);

        $user->attachRole('admin');
    }
}
