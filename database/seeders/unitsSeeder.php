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
            ['name' => 'mg/dl'],
            ['name' => 'g/dl'],
            ['name' => 'g/l'],
            ['name' => 'mg/l'],
            ['name' => 'µg/ml'],
            ['name' => 'µg/dl'],
            ['name' => 'µg/l'],
            ['name' => 'ng/ml'],
            ['name' => 'ng/dl'],
            ['name' => 'pg/ml'],
            ['name' => 'ng/l'],
            ['name' => 'mmol/l'],
            ['name' => 'µmol/l'],
            ['name' => 'mol/l'],
            ['name' => 'mEq/l'],
            ['name' => 'mOsm/kg'],
            ['name' => 'g/m²'],
            ['name' => 'IU/l'],
            ['name' => 'U/l'],
            ['name' => 'kU/l'],
            ['name' => 'mIU/mL'],
            ['name' => 'µIU/mL'],
            ['name' => 'µkat/l'],
            ['name' => 'cells/µl'],
            ['name' => 'cells/mm³'],
            ['name' => 'cells/mL'],
            ['name' => '×10³/µl'],
            ['name' => '×10⁶/µl'],
            ['name' => '×10⁹/l'],
            ['name' => 'mmHg'],
            ['name' => 'kPa'],
            ['name' => 'vol%'],
            ['name' => 'mL/dl'],
            ['name' => 'mL/l'],
            ['name' => 'mg/24h'],
            ['name' => 'mmol/24h'],
            ['name' => 'mL/min'],
            ['name' => 'CFU/ml'],
            ['name' => 'CFU/g'],
            ['name' => 'copies/ml'],
            ['name' => 'log copies/ml'],
            ['name' => 'TCID50/ml'],
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
            ['name' => 'AU/ml'],
            ['name' => 'BAU/ml'],
            ['name' => 'COI'],
            ['name' => 'nmol/l'],
            ['name' => 'pmol/l'],
            ['name' => 'fmol/l'],
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
