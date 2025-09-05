<?php

namespace Database\Seeders\tests;

use App\Models\Test_groups;
use App\Models\Test_parameters;
use App\Models\Tests;
use Illuminate\Database\Seeder;

class Biochemistry extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //Renal Function Test (RFT)
        $test_group = Test_groups::create([
            'name' => 'Biochemistry',
        ]);

        $test = Tests::create([
            'name' => 'Renal Function Test (RFT)',
            'rate' => 700,
            'report_time' => '1 hour 30 minutes',
            'test_groups_id' => $test_group->id,
        ]);

        Test_parameters::create([
            'title' => 'Urea',
            'tests_id' => $test->id,
            'unit' => 'mg/dl',
            'normal_range' => "10 - 50",
            'type' => 'Numeric',
            'options' => null,
        ]);

        Test_parameters::create([
            'title' => 'Creatinine',
            'tests_id' => $test->id,
            'unit' => 'mg/dl',
            'normal_range' => "Male: 0.7-1.3\nFemale: 0.6-0.9\nInfants: 0.2-0.4\nChild: 0.3-0.8",
            'type' => 'Numeric',
            'options' => null,
        ]);

        Test_parameters::create([
            'title' => 'Sodium',
            'tests_id' => $test->id,
            'unit' => 'mmol/l',
            'normal_range' => "136 - 148",
            'type' => 'Numeric',
            'options' => null,
        ]);

        Test_parameters::create([
            'title' => 'Potassium',
            'tests_id' => $test->id,
            'unit' => 'mmol/l',
            'normal_range' => "3.8 - 5.0",
            'type' => 'Numeric',
            'options' => null,
        ]);

        Test_parameters::create([
            'title' => 'Chloride',
            'tests_id' => $test->id,
            'unit' => 'mmol/l',
            'normal_range' => "98 - 107",
            'type' => 'Numeric',
            'options' => null,
        ]);


        //Liver Function Test (LFT)

        $test = Tests::create([
            'name' => 'Liver Function Test (LFT)',
            'rate' => 600,
            'report_time' => '1 hour 30 minutes',
            'test_groups_id' => $test_group->id,
        ]);

        Test_parameters::create([
            'title' => 'Total Bilirubin',
            'tests_id' => $test->id,
            'unit' => 'mg/dl',
            'normal_range' => "Less than 1.0",
            'type' => 'Numeric',
            'options' => null,
        ]);

        Test_parameters::create([
            'title' => 'Direct Bilirubin',
            'tests_id' => $test->id,
            'unit' => 'mg/dl',
            'normal_range' => "Less than 0.3",
            'type' => 'Numeric',
            'options' => null,
        ]);

        Test_parameters::create([
            'title' => 'Indirect Bilirubin',
            'tests_id' => $test->id,
            'unit' => 'mg/dl',
            'normal_range' => "Less than 0.7",
            'type' => 'Numeric',
            'options' => null,
        ]);

        Test_parameters::create([
            'title' => 'ALT (GPT)',
            'tests_id' => $test->id,
            'unit' => 'U/l',
            'normal_range' => "9.4 - 43.3",
            'type' => 'Numeric',
            'options' => null,
        ]);


        Test_parameters::create([
            'title' => 'ALK Phosphatase',
            'tests_id' => $test->id,
            'unit' => 'U/l',
            'normal_range' => "Male: 80-306\nFemale: 65-320\nChild: 90-180",
            'type' => 'Numeric',
            'options' => null,
        ]);

        Test_parameters::create([
            'title' => 'Gamma GT',
            'tests_id' => $test->id,
            'unit' => 'U/l',
            'normal_range' => "Male: Less then 55\nFemale: Less then 38",
            'type' => 'Numeric',
            'options' => null,
        ]);

        Test_parameters::create([
            'title' => 'AST (GOT)',
            'tests_id' => $test->id,
            'unit' => 'U/l',
            'normal_range' => "Male: 10.2-34.0\nFemale: 10.2-30.6",
            'type' => 'Numeric',
            'options' => null,
        ]);

        // Glucose Random

        $test = Tests::create([
            'name' => 'Glucose Random',
            'rate' => 100,
            'report_time' => '1 hour 30 minutes',
            'test_groups_id' => $test_group->id,
        ]);

        Test_parameters::create([
            'title' => 'Random Blood Sugar',
            'tests_id' => $test->id,
            'unit' => 'mg/dl',
            'normal_range' => "70-180",
            'type' => 'Numeric',
            'options' => null,
        ]);

    }
}
