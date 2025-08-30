<?php

namespace Database\Seeders\tests;

use App\Models\Test_groups;
use App\Models\Test_values;
use App\Models\Tests;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Haematology extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $test = Tests::create([
            'name' => 'Haematology',
            'rate' => 100,
            'status' => 'Active',
        ]);

        $test_group = Test_groups::create([
            'name' => 'Haematology',
            'test_id' => $test->id,
        ]);

        $test_value = Test_values::create([
            'name' => 'Haemoglobin',
            'test_group_id' => $test_group->id,
            'test_id' => $test->id,
            'unit' => 'g/dl',
            'normal_range' => "Male: 12.1-16.7\nFemale: 12.1-16.7",
            'type' => 'Numeric',
            'options' => null,
        ]);

        $test_value = Test_values::create([
            'name' => 'RBC Count',
            'test_group_id' => $test_group->id,
            'test_id' => $test->id,
            'unit' => 'M/cu mm',
            'normal_range' => "Male: 4.5-6.0\nFemale: 4.0-5.5",
            'type' => 'Numeric',
            'options' => null,
        ]);

        $test_value = Test_values::create([
            'name' => 'WBC Count',
            'test_group_id' => $test_group->id,
            'test_id' => $test->id,
            'unit' => 'cu mm',
            'normal_range' => "4,000 - 10,000",
            'type' => 'Numeric',
            'options' => null,
        ]);

        $test_value = Test_values::create([
            'name' => 'Platelet Count',
            'test_group_id' => $test_group->id,
            'test_id' => $test->id,
            'unit' => 'cu mm',
            'normal_range' => "150,000 - 400,000",
            'type' => 'Numeric',
            'options' => null,
        ]);
        
        $test_group = Test_groups::create([
            'name' => 'Absolute Indices',
            'test_id' => $test->id,
        ]);

        $test_value = Test_values::create([
            'name' => 'PCV (HCT)',
            'test_group_id' => $test_group->id,
            'test_id' => $test->id,
            'unit' => '%',
            'normal_range' => "Male: 40 - 55\nFemale: 37 - 47",
            'type' => 'Numeric',
            'options' => null,
        ]);

        $test_value = Test_values::create([
            'name' => 'MCV',
            'test_group_id' => $test_group->id,
            'test_id' => $test->id,
            'unit' => 'fL',
            'normal_range' => "76-96",
            'type' => 'Numeric',
            'options' => null,
        ]);

        $test_value = Test_values::create([
            'name' => 'MCH',
            'test_group_id' => $test_group->id,
            'test_id' => $test->id,
            'unit' => 'pg',
            'normal_range' => "28-32",
            'type' => 'Numeric',
            'options' => null,
        ]);

        $test_value = Test_values::create([
            'name' => 'MCHC',
            'test_group_id' => $test_group->id,
            'test_id' => $test->id,
            'unit' => 'g/dl',
            'normal_range' => "32-36",
            'type' => 'Numeric',
            'options' => null,
        ]);

        $test_group = Test_groups::create([
            'name' => 'Differential Leucocytes Count',
            'test_id' => $test->id,
        ]);

        $test_value = Test_values::create([
            'name' => 'Neutrophils',
            'test_group_id' => $test_group->id,
            'test_id' => $test->id,
            'unit' => '%',
            'normal_range' => "40 - 75",
            'type' => 'Numeric',
            'options' => null,
        ]);

        $test_value = Test_values::create([
            'name' => 'Lymphocytes',
            'test_group_id' => $test_group->id,
            'test_id' => $test->id,
            'unit' => '%',
            'normal_range' => "20 - 50",
            'type' => 'Numeric',
            'options' => null,
        ]);

        $test_value = Test_values::create([
            'name' => 'Monocytes',
            'test_group_id' => $test_group->id,
            'test_id' => $test->id,
            'unit' => '%',
            'normal_range' => "2 - 10",
            'type' => 'Numeric',
            'options' => null,
        ]);

        $test_value = Test_values::create([
            'name' => 'Eosinophils',
            'test_group_id' => $test_group->id,
            'test_id' => $test->id,
            'unit' => '%',
            'normal_range' => "1 - 6",
            'type' => 'Numeric',
            'options' => null,
        ]);

        $test_value = Test_values::create([
            'name' => 'Basophils',
            'test_group_id' => $test_group->id,
            'test_id' => $test->id,
            'unit' => '%',
            'normal_range' => "0 - 1",
            'type' => 'Numeric',
            'options' => null,
        ]);


        $test_group = Test_groups::create([
            'name' => 'Peripheral Smear Findings',
            'test_id' => $test->id,
        ]);

        $test_value = Test_values::create([
            'name' => 'Immature Cells',
            'test_group_id' => $test_group->id,
            'test_id' => $test->id,
            'unit' => null,
            'normal_range' => null,
            'type' => 'Text',
            'options' => array("No Immature Cells Found", "Immature Cells Present"),
        ]);

        $test_value = Test_values::create([
            'name' => 'RBC Morphology',
            'test_group_id' => $test_group->id,
            'test_id' => $test->id,
            'unit' => null,
            'normal_range' => null,
            'type' => 'Select',
            'options' => array("Anisocytosis","Microcytosis", "Hypochromia", "Polycyosis", "Target Cells", "Eliptical Cells", "Abnormal"),
        ]);

        $test_value = Test_values::create([
            'name' => 'WBC Morphology',
            'test_group_id' => $test_group->id,
            'test_id' => $test->id,
            'unit' => null,
            'normal_range' => null,
            'type' => 'Select',
            'options' => array("Anisocytosis", "Polycyosis", "Target Cells", "Abnormal"),
        ]);

        $test_value = Test_values::create([
            'name' => 'Haemoparasites',
            'test_group_id' => $test_group->id,
            'test_id' => $test->id,
            'unit' => null,
            'normal_range' => null,
            'type' => 'Text',
            'options' => array("No Malaria Parasites Found", "Malaria Parasites Present"),
        ]);

        $test_value = Test_values::create([
            'name' => 'Platelet Estimation',
            'test_group_id' => $test_group->id,
            'test_id' => $test->id,
            'unit' => null,
            'normal_range' => null,
            'type' => 'Text',
            'options' => array("Normal on Smear", "Abnormal on Smear"),
        ]);



    }
}
