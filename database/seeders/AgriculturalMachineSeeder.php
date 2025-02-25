<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AgriculturalMachine;

class AgriculturalMachineSeeder extends Seeder
{
    public function run()
    {
        $machines = [
            [
                "name" => "John Deere Traktor",
                "license_plate" => "ABC-123",
                "daily_price" => 150
            ],
            [
                "name" => "Case IH Traktor",
                "license_plate" => "DEF-456",
                "daily_price" => 160
            ],
            [
                "name" => "New Holland Kombájn",
                "license_plate" => "GHI-789",
                "daily_price" => 250
            ],
            [
                "name" => "Claas Kombájn",
                "license_plate" => "JKL-012",
                "daily_price" => 260
            ],
            [
                "name" => "Földművelő Szántógép",
                "license_plate" => "MNO-345",
                "daily_price" => 120
            ],
            [
                "name" => "Öntöző Rendszer",
                "license_plate" => "PQR-678",
                "daily_price" => 90
            ],
            [
                "name" => "Permetező Gépezet",
                "license_plate" => "STU-901",
                "daily_price" => 110
            ],
            [
                "name" => "Búzamező Kombájn",
                "license_plate" => "VWX-234",
                "daily_price" => 270
            ],
            [
                "name" => "Gyümölcsszedő",
                "license_plate" => "YZA-567",
                "daily_price" => 140.0
            ],
            [
                "name" => "Növényvédő Szóró",
                "license_plate" => "BCD-890",
                "daily_price" => 100
            ],
            [
                "name" => "Lisztő Traktor",
                "license_plate" => "EFG-123",
                "daily_price" => 155
            ],
            [
                "name" => "Gabona Betakarító",
                "license_plate" => "HIJ-456",
                "daily_price" => 240
            ],
            [
                "name" => "Fűrendező Gép",
                "license_plate" => "KLM-789",
                "daily_price" => 130
            ],
            [
                "name" => "Réti Munkagép",
                "license_plate" => "NOP-012",
                "daily_price" => 115
            ],
            [
                "name" => "Pálinkafőző Traktor",
                "license_plate" => "QRS-345",
                "daily_price" => 145
            ]
        ];

        foreach ($machines as $machine) {
            AgriculturalMachine::create($machine);
        }
    }
}
