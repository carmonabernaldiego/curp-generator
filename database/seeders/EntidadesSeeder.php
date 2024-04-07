<?php

namespace Database\Seeders;

use App\Models\Entidades;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EntidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estados = [
            'Aguascalientes' => 'AS',
            'Baja California' => 'BC',
            'Baja California Sur' => 'BS',
            'Campeche' => 'CC',
            'Chiapas' => 'CS',
            'Chihuahua' => 'CH',
            'Coahuila' => 'CL',
            'Colima' => 'CM',
            'Ciudad de México' => 'DF',
            'Durango' => 'DG',
            'Guanajuato' => 'GT',
            'Guerrero' => 'GR',
            'Hidalgo' => 'HG',
            'Jalisco' => 'JC',
            'México' => 'MC',
            'Michoacán' => 'MN',
            'Morelos' => 'MS',
            'Nayarit' => 'NT',
            'Nuevo León' => 'NL',
            'Oaxaca' => 'OC',
            'Puebla' => 'PL',
            'Querétaro' => 'QT',
            'Quintana Roo' => 'QR',
            'San Luis Potosí' => 'SP',
            'Sinaloa' => 'SL',
            'Sonora' => 'SR',
            'Tabasco' => 'TC',
            'Tamaulipas' => 'TS',
            'Tlaxcala' => 'TL',
            'Veracruz' => 'VZ',
            'Yucatán' => 'YN',
            'Zacatecas' => 'ZS',
        ];

        foreach ($estados as $nombre => $clave) {
            Entidades::create([
                'codigo' => $clave,
                'nombre' => $nombre,
            ]);
        }
    }
}
