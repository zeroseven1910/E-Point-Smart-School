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
            'Ahmad Rizki Pratama', 'Siti Nurhaliza', 'Muhammad Fadli', 'Dewi Sartika',
            'Budi Setiawan', 'Maya Anggraini', 'Dimas Prakoso', 'Rina Wulandari',
            'Fajar Nugraha', 'Indira Permata', 'Arief Rahman', 'Lestari Putri',
            'Bayu Wijaya', 'Sari Melati', 'Yoga Pratama', 'Fitri Handayani',
            'Eko Saputra', 'Dian Pertiwi', 'Rizal Fauzi', 'Mega Sari',
            'Andi Firmansyah', 'Yuni Kartika', 'Hendra Gunawan', 'Nisa Ramadhani',
            'Gilang Ramadhan', 'Lia Amelia', 'Irfan Hakim', 'Vina Oktavia',
            'Reza Kurniawan', 'Putri Maharani', 'Dwi Prasetyo', 'Siska Utami',
            'Wahyu Hidayat', 'Ratna Dewi', 'Fikri Alamsyah', 'Diana Sari',
            'Agung Nugroho', 'Tika Wulandari', 'Doni Setiawan', 'Evi Rahayu',
            'Hadi Wijaya', 'Linda Safitri', 'Joni Pratama', 'Mira Handayani',
            'Krisna Wardhana', 'Sinta Dewi', 'Lucky Ramadan', 'Wati Sukmawati',
            'Nanda Pratama', 'Yessi Permata'
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