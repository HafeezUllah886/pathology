<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\units;

class unitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            ['name' => 'mg/dL'],
            ['name' => 'g/dL'],
            ['name' => 'g/L'],
            ['name' => 'mg/L'],
            ['name' => 'µg/mL'],
            ['name' => 'µg/dL'],
            ['name' => 'µg/L'],
            ['name' => 'ng/mL'],
            ['name' => 'ng/dL'],
            ['name' => 'pg/mL'],
            ['name' => 'ng/L'],
            ['name' => 'mmol/L'],
            ['name' => 'µmol/L'],
            ['name' => 'mol/L'],
            ['name' => 'mEq/L'],
            ['name' => 'mOsm/kg'],
            ['name' => 'g/m²'],
            ['name' => 'IU/L'],
            ['name' => 'U/L'],
            ['name' => 'kU/L'],
            ['name' => 'mIU/mL'],
            ['name' => 'µIU/mL'],
            ['name' => 'µkat/L'],
            ['name' => 'cells/µL'],
            ['name' => 'cells/mm³'],
            ['name' => 'cells/mL'],
            ['name' => '×10³/µL'],
            ['name' => '×10⁶/µL'],
            ['name' => '×10⁹/L'],
            ['name' => 'mmHg'],
            ['name' => 'kPa'],
            ['name' => 'vol%'],
            ['name' => 'mL/dL'],
            ['name' => 'mL/L'],
            ['name' => 'mg/24h'],
            ['name' => 'mmol/24h'],
            ['name' => 'mL/min'],
            ['name' => 'CFU/mL'],
            ['name' => 'CFU/g'],
            ['name' => 'copies/mL'],
            ['name' => 'log copies/mL'],
            ['name' => 'TCID50/mL'],
            ['name' => 'sec'],
            ['name' => 'min'],
            ['name' => 'ratio'],
            ['name' => 'INR'],
            ['name' => '%'],
            ['name' => '°C'],
            ['name' => 'pH'],
            ['name' => 'score'],
            ['name' => 'ppm'],
            ['name' => 'ppb'],
            ['name' => 'mg/kg'],
            ['name' => 'µg/g'],
            ['name' => 'S/CO'],
            ['name' => 'Index'],
            ['name' => 'AU/mL'],
            ['name' => 'BAU/mL'],
            ['name' => 'COI'],
            ['name' => 'nmol/L'],
            ['name' => 'pmol/L'],
            ['name' => 'fmol/L'],
            ['name' => 'Ct value'],
            ['name' => 'copies/reaction'],
            ['name' => 'mosmol/kg'],
            ['name' => 'osmol/kg'],
            ['name' => 'µm'],
            ['name' => 'fl'],
            ['name' => 'pg'],
            ['name' => 'g/cm²']
        ];
        

        units::insert($units);
    }
}
