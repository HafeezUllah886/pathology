<?php

namespace Database\Seeders\tests;

use App\Models\Test_groups;
use App\Models\Test_parameters;
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
        $test_group = Test_groups::create([
            'name' => 'Haematology',
        ]);

        //CBC

        $test = Tests::create([
            'name' => 'CBC',
            'rate' => 300,
            'report_time' => '1 hour 30 minutes',
            'test_groups_id' => $test_group->id,
        ]);

        Test_parameters::create([
            'title' => 'Haemoglobin',
            'tests_id' => $test->id,
            'unit' => 'g/dl',
            'normal_range' => "Male: 12.1-16.7\nFemale: 12.1-16.7",
            'type' => 'Numeric',
            'options' => null,
        ]);


        Test_parameters::create([
            'title' => 'RBC Count',
            'tests_id' => $test->id,
            'unit' => '×10⁶/µl',
            'normal_range' => "Male: 4.5-6.0\nFemale: 4.0-5.5",
            'type' => 'Numeric',
            'options' => null,
        ]);

        Test_parameters::create([
            'title' => 'WBC Count',
            'tests_id' => $test->id,
            'unit' => '×10³/µl',
            'normal_range' => "4.0 - 10.0",
            'type' => 'Numeric',
            'options' => null,
        ]);

        Test_parameters::create([
            'title' => 'Platelet Count',
            'tests_id' => $test->id,
            'unit' => '×10³/µl',
            'normal_range' => "150 - 400",
            'type' => 'Numeric',
            'options' => null,
        ]);

        Test_parameters::create([
            'title' => 'Reticulocyte Count',
            'tests_id' => $test->id,
            'unit' => '%',
            'normal_range' => "0.5 - 2.0",
            'type' => 'Numeric',
            'options' => null,
        ]);


        Test_parameters::create([
            'title' => 'Absolute Indices',
            'tests_id' => $test->id,
            'unit' => null,
            'normal_range' => null,
            'type' => 'Heading',
            'options' => null,
        ]);

        Test_parameters::create([
            'title' => 'PCV (HCT)',
            'tests_id' => $test->id,
            'unit' => '%',
            'normal_range' => "Male: 40 - 55\nFemale: 37 - 47",
            'type' => 'Numeric',
            'options' => null,
        ]);

        Test_parameters::create([
            'title' => 'MCV',
            'tests_id' => $test->id,
            'unit' => 'fl',
            'normal_range' => "76-96",
            'type' => 'Numeric',
            'options' => null,
        ]);

        Test_parameters::create([
            'title' => 'MCH',
            'tests_id' => $test->id,
            'unit' => 'pg',
            'normal_range' => "28-32",
            'type' => 'Numeric',
            'options' => null,
        ]);

        Test_parameters::create([
            'title' => 'MCHC',
            'tests_id' => $test->id,
            'unit' => 'g/dl',
            'normal_range' => "32-36",
            'type' => 'Numeric',
            'options' => null,
        ]);

        Test_parameters::create([
            'title' => 'Differential Leukocytes Count',
            'tests_id' => $test->id,
            'unit' => null,
            'normal_range' => null,
            'type' => 'Heading',
            'options' => null,
        ]);

        Test_parameters::create([
            'title' => 'Neutrophils',
            'tests_id' => $test->id,
            'unit' => '%',
            'normal_range' => "40 - 75",
            'type' => 'Numeric',
            'options' => null,
        ]);

        Test_parameters::create([
            'title' => 'Lymphocytes',
            'tests_id' => $test->id,
            'unit' => '%',
            'normal_range' => "20 - 50",
            'type' => 'Numeric',
            'options' => null,
        ]);

        Test_parameters::create([
            'title' => 'Monocytes',
            'tests_id' => $test->id,
            'unit' => '%',
            'normal_range' => "2 - 10",
            'type' => 'Numeric',
            'options' => null,
        ]);

        Test_parameters::create([
            'title' => 'Eosinophils',
            'tests_id' => $test->id,
            'unit' => '%',
            'normal_range' => "1 - 6",
            'type' => 'Numeric',
            'options' => null,
        ]);

        Test_parameters::create([
            'title' => 'Basophils',
            'tests_id' => $test->id,
            'unit' => '%',
            'normal_range' => "0 - 1",
            'type' => 'Numeric',
            'options' => null,
        ]);

        //Peripheral Blood Smear (PBS)

        $test = Tests::create([
            'name' => 'Peripheral Blood Smear (PBS)',
            'rate' => 300,
            'report_time' => '1 hour 30 minutes',
            'test_groups_id' => $test_group->id,
        ]);

        Test_parameters::create([
            'title' => 'Immature Cells',
            'tests_id' => $test->id,
            'unit' => null,
            'normal_range' => null,
            'type' => 'Text',
            'options' => array("No Immature Cells Found", "Immature Cells Present"),
        ]);

        Test_parameters::create([
            'title' => 'RBC Morphology',
            'tests_id' => $test->id,
            'unit' => null,
            'normal_range' => null,
            'type' => 'Select',
            'options' => array("Anisocytosis","Microcytosis", "Hypochromia", "Polycyosis", "Target Cells", "Eliptical Cells", "Abnormal"),
        ]);

        Test_parameters::create([
            'title' => 'Haemoparasites',
            'tests_id' => $test->id,
            'unit' => null,
            'normal_range' => null,
            'type' => 'Text',
            'options' => array("No Malaria Parasites Found", "Malaria Parasites Present"),
        ]);

        Test_parameters::create([
            'title' => 'Platelet Estimation',
            'tests_id' => $test->id,
            'unit' => null,
            'normal_range' => null,
            'type' => 'Text',
            'options' => array("Normal on Smear", "Abnormal on Smear"),
        ]); 
    }
}
