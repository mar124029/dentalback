<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\RRHH;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('es_PE');

        $rrhhAdmin = RRHH::create([
            'n_document' => $faker->unique()->numerify('7#######'),
            'name'       => 'Administrador',
            'surname'    => 'General',
            'birth_date' => $faker->date('Y-m-d', '1985-01-01'),
            'phone'      => $faker->phoneNumber,
            'email'      => 'admin@dentalsoft.com',
            'idcharge'   => null,
        ]);

        User::create([
            'idrrhh'             => $rrhhAdmin->id,
            'idrole'             => 1,
            'n_document'         => $rrhhAdmin->n_document,
            'email'              => $rrhhAdmin->email,
            'password'           => Hash::make('demo'),
            'encrypted_password' => Crypt::encryptString('demo'),
        ]);

        $rrhhRecep = RRHH::create([
            'n_document' => $faker->unique()->numerify('7#######'),
            'name'       => $faker->firstNameFemale,
            'surname'    => $faker->lastName,
            'birth_date' => $faker->date('Y-m-d', '1993-01-01'),
            'phone'      => $faker->phoneNumber,
            'email'      => 'recepcionista@dentalsoft.com',
            'idcharge'   => null,
        ]);

        User::create([
            'idrrhh'             => $rrhhRecep->id,
            'idrole'             => 4,
            'n_document'         => $rrhhRecep->n_document,
            'email'              => $rrhhRecep->email,
            'password'           => Hash::make('demo'),
            'encrypted_password' => Crypt::encryptString('demo'),
        ]);

        for ($i = 1; $i <= 3; $i++) {
            $firstName = $faker->firstNameMale;
            $lastName = $faker->lastName;

            $rrhh = RRHH::create([
                'n_document' => $faker->unique()->numerify('7#######'),
                'name'       => $firstName,
                'surname'    => $lastName,
                'birth_date' => $faker->date('Y-m-d', '1980-01-01'),
                'phone'      => $faker->phoneNumber,
                'email'      => strtolower($firstName) . $i . '@medicos.com',
                'idcharge'   => null,
            ]);

            User::create([
                'idrrhh'             => $rrhh->id,
                'idrole'             => 2,
                'n_document'         => $rrhh->n_document,
                'email'              => $rrhh->email,
                'password'           => Hash::make('demo'),
                'encrypted_password' => Crypt::encryptString('demo'),
            ]);
        }

        for ($i = 1; $i <= 5; $i++) {
            $firstName = $faker->firstName;
            $lastName = $faker->lastName;

            $rrhh = RRHH::create([
                'n_document' => $faker->unique()->numerify('7#######'),
                'name'       => $firstName,
                'surname'    => $lastName,
                'birth_date' => $faker->date('Y-m-d', '1995-01-01'),
                'phone'      => $faker->phoneNumber,
                'email'      => strtolower($firstName) . $i . '@pacientes.com',
                'idcharge'   => null,
            ]);

            User::create([
                'idrrhh'             => $rrhh->id,
                'idrole'             => 3,
                'n_document'         => $rrhh->n_document,
                'email'              => $rrhh->email,
                'password'           => Hash::make('demo'),
                'encrypted_password' => Crypt::encryptString('demo'),
            ]);
        }
    }
}
