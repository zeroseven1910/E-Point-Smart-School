<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\ClassModel;
use App\Models\User;
use Faker\Factory as Faker;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $classes = ClassModel::all();
        $users = User::all();

        $studentNames = [
            'Abdullah Azzam Al-Ghifari', 'Alwan Baihaqi Tamami', 'Alya Rahma', 'Anasya Almira',
            'Bagus Bakhtiar', 'Denisa Saharani', 'Desti Syfy Asyfiani', 'Devina Rizqiani Kitnas Safaanah',
            'Diva Virna Monicca', 'Fairuz Nadhir', 'Fikhriz Yudha Bilhaq', 'Gilang Eko Saputra',
            'Husni Taufik Alfarisi', 'Ika Marcelina', ' Julian Jaka Wardana', 'La Tahzan Atfal Mitswahandy',
            'Laena Auliana', 'M. Aasief Fionoza As Sakhuri', 'M. Hafiizh Zahran', 'Moh. Fahrizky Putra Landria',
            'Muhammad Arif Sulaiman', 'Muhammad Anton Prabowo', 'Muhammad Faris Anwar', 'Muhammad Faydul Arzaq',
            'Muhammad Ibnu Affan', 'Muhammad Rafi Ash Shidqii', 'Naila Rizqiyana', 'Nur Azizah',
            'Rafit Indonesia Ken Sugi', 'Rifqi Ahmad Fahreza', 'Selvi Lindawati', 'Sendi Aulya Ramadhani Jumeno',
            'Tiara Ifani', 'Vanesa Yuliasari', 'Vina Novelia Putri', 'Zayinatul Aflah'
           
        ];

        foreach ($classes as $class) {
            // Generate 15-20 students per class
            $numStudents = rand(15, 20);
            
            for ($i = 0; $i < $numStudents; $i++) {
                $year = '20' . substr($class->name, 0, 2);
                $classCode = str_replace(' ', '', substr($class->name, 3));
                $sequential = str_pad($i + 1, 3, '0', STR_PAD_LEFT);
                
                Student::create([
                    'name' => $faker->randomElement($studentNames),
                    'nis' => $year . $classCode . $sequential,
                    'class_id' => $class->id,
                    'user_id' => $users->random()->id,
                ]);
            }
        }
    }
}