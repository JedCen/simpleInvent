<?php

use Illuminate\Database\Seeder;
use App\Models\Configuration;

class ConfigurationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         * Add Configuration
         *
         */
        if (Configuration::where('short', '=', 'nom_emp')->first() === null) {
            Configuration::create([
                'short'        => 'nom_emp',
                'name'        => 'Nombre de la empresa',
                'val' => 'Coba',
            ]);
        }

        if (Configuration::where('short', '=', 'tel')->first() === null) {
            Configuration::create([
                'short'        => 'tel',
                'name'        => 'Telefono',
                'val' => '984127',
            ]);
        }

        if (Configuration::where('short', '=', 'name_imp')->first() === null) {
            Configuration::create([
                'short'        => 'name_imp',
                'name'        => 'Nombre Impuesto',
                'val' => 'IVA',
            ]);
        }

        if (Configuration::where('short', '=', 'val_imp')->first() === null) {
            Configuration::create([
                'short'        => 'val_imp',
                'name'        => 'Valor de Impuesto',
                'val' => '16',
            ]);
        }

        if (Configuration::where('short', '=', 'symbol')->first() === null) {
            Configuration::create([
                'short'        => 'symbol',
                'name'        => 'Simbolo Moneda',
                'val' => '$',
            ]);
        }

        if (Configuration::where('short', '=', 'img_logo')->first() === null) {
            Configuration::create([
                'short'        => 'img_logo',
                'name'        => 'Logo Empresa',
                'val' => '/images/configs/6/config/config.jpeg',
            ]);
        }
    }
}
