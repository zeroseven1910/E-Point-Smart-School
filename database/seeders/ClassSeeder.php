<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClassModel;

class ClassSeeder extends Seeder
{
    public function run(): void
    {
        $classes = [
            // Kelas 10
            '10 AK 1', '10 AK 2', '10 AK 3', '10 AK 4',
            '10 OTKP 1', '10 OTKP 2', '10 OTKP 3',
            '10 MP 1', '10 MP 2', '10 MP 3',
            '10 DKV 1', '10 DKV 2', '10 DKV 3',
            '10 TJKT 1', '10 TJKT 2',
            '10 PPLG 1',
            
            // Kelas 11
            '11 AK 1', '11 AK 2', '11 AK 3', '11 AK 4',
            '11 OTKP 1', '11 OTKP 2', '11 OTKP 3',
            '11 BD 1',
            '11 BR 1', '11 BR 2',
            '11 DKV 1', '11 DKV 2', '11 DKV 3',
            '11 TKJ 1', '11 TKJ 2',
            '11 RPL 1',
            
            // Kelas 12
            '12 AK 1', '12 AK 2', '12 AK 3', '12 AK 4',
            '12 OTKP 1', '12 OTKP 2', '12 OTKP 3',
            '12 BD 1',
            '12 BR 1', '12 BR 2',
            '12 DKV 1', '12 DKV 2', '12 DKV 3',
            '12 TKJ 1', '12 TKJ 2',
            '12 RPL 1',
        ];

        foreach ($classes as $className) {
            ClassModel::create([
                'name' => $className,
            ]);
        }
    }
}
