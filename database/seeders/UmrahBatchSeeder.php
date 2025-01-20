<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UmrahBatch;

class UmrahBatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $batch1=UmrahBatch::updateOrCreate(
            [
                'code_batch'=>'MST001',
            ],
            [
                'departure_schedule'=>'2025-01-01',
                'return_schedule'=>'2025-01-10',
                'description'=>'description',
                'availability'=>'available',
                'basic_price'=>25000000,
            ]
        );

        $batch2=UmrahBatch::updateOrCreate(
            [
                'code_batch'=>'MST002',
            ],
            [
                'departure_schedule'=>'2025-01-20',
                'return_schedule'=>'2025-01-30',
                'description'=>'description batch 2',
                'availability'=>'available',
                'basic_price'=>23000000,
            ]
        );

        $batch3=UmrahBatch::updateOrCreate(
            [
                'code_batch'=>'MST003',
            ],
            [
                'departure_schedule'=>'2025-01-20',
                'return_schedule'=>'2025-01-30',
                'description'=>'description batch 3',
                'availability'=>'unavailable',
                'basic_price'=>27000000,
            ]
        );
    }
}
