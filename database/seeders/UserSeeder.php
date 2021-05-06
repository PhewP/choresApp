<?php

namespace Database\Seeders;

use App\Models\Urating;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    public $userNames = ['jeff', 'esperanza', 'pedro'];
    public $province = ['Cádiz', 'Cádiz', 'Málaga'];
    public $city = ['Chiclana', 'San Fernando', 'La malagueta'];
    public $address = ['Calle salchicha 10', 'Calle Chorizo 30', 'Calle Butifarra 40'];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->userNames as $key => $user) {
            $newUser = User::Create([
                'name' => $user,
                'email' => $user . '@uca.es',
                'province' => $this->province[$key],
                'city' => $this->city[$key],
                'address' => $this->address[$key],
                'password' => Hash::make('12345678'),
            ]);

            $newUser->urating()->save(Urating::Create([
                'user_id' => $newUser->id
            ]));
        }
    }
}
