<?php

use App\Models\OperationType;
use Illuminate\Database\Seeder;

class OperationTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $operations = [
            [
                'name' => 'entrada',
            ],
            [
                'name' => 'salida',
            ],

        ];

        foreach ($operations as $operation) {
            $newOperation = OperationType::where('name', '=', $operation['name'])->first();
            if ($newOperation === null) {
                $newOperation = OperationType::create([
                    'name'          => $operation['name'],
                ]);
            }
        }
    }
}
