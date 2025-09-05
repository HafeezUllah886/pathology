<?php

namespace Database\Seeders\tests;

use App\Models\Test_groups;
use App\Models\Test_parameters;
use App\Models\Tests;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Andrology extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $test_group = Test_groups::create([
            'name' => 'Andrology',
        ]);

        $test = Tests::create([
            'name' => 'Seminal Fluid Analysis (SFA)',
            'rate' => 500,
            'test_groups_id' => $test_group->id,
            'report_time' => '1 hour 30 minutes',
        ]);

        Test_parameters::create([
            'title' => 'Days of Abstinence',
            'tests_id' => $test->id,
            'unit' => null,
            'normal_range' => null,
            'type' => 'Text',
            'options' => null,
        ]);

        Test_parameters::create([
            'title' => 'Time Since Ejaculation',
            'tests_id' => $test->id,
            'unit' => null,
            'normal_range' => null,
            'type' => 'Text',
            'options' => null,
        ]);

        Test_parameters::create([
            'title' => 'Volume',
            'tests_id' => $test->id,
            'unit' => 'ml',
            'normal_range' => "2.5 - 6.0",
            'type' => 'Numeric',
            'options' => null,
        ]);

        Test_parameters::create([
            'title' => 'Viscosity',
            'tests_id' => $test->id,
            'unit' => null,
            'normal_range' => "Thick Pours in Drop",
            'type' => 'Text',
            'options' => array("Thick", "Medium", "Thin"),
        ]);

        Test_parameters::create([
            'title' => 'Colour',
            'tests_id' => $test->id,
            'unit' => null,
            'normal_range' => "Greyish or Slight Yellow",
            'type' => 'Text',
            'options' => array("Greyish", "Slight Yellow", "White"),
        ]);

        Test_parameters::create([
            'title' => 'Liquefaction Time',
            'tests_id' => $test->id,
            'unit' => null,
            'normal_range' => "Less than 50 minutes",
            'type' => 'Text',
            'options' => null,
        ]);

        Test_parameters::create([
            'title' => 'Reaction (pH)',
            'tests_id' => $test->id,
            'unit' => null,
            'normal_range' => "Alkaline 7.2 - 8.5",
            'type' => 'Text',
            'options' => null,
        ]);

        Test_parameters::create([
            'title' => 'Sperm Count',
            'tests_id' => $test->id,
            'unit' => 'M/ml',
            'normal_range' => "Greater than 20",
            'type' => 'Numeric',
            'options' => null,
        ]);

        Test_parameters::create([
            'title' => 'Sperm Mortality',
            'tests_id' => $test->id,
            'unit' => null,
            'normal_range' => null,
            'type' => 'Heading',
            'options' => null,
        ]);

        Test_parameters::create([
            'title' => 'Active Sperm',
            'tests_id' => $test->id,
            'unit' => '%',
            'normal_range' => "75 - 85",
            'type' => 'Numeric',
            'options' => null,
        ]);

        Test_parameters::create([
            'title' => 'Sluggish Sperm',
            'tests_id' => $test->id,
            'unit' => '%',
            'normal_range' => "Less than 15",
            'type' => 'Numeric',
            'options' => null,
        ]);

        Test_parameters::create([
            'title' => 'Inactive Sperm',
            'tests_id' => $test->id,
            'unit' => '%',
            'normal_range' => "Less than 25",
            'type' => 'Numeric',
            'options' => null,
        ]);

        Test_parameters::create([
            'title' => 'Sperm Morphology',
            'tests_id' => $test->id,
            'unit' => null,
            'normal_range' => null,
            'type' => 'Heading',
            'options' => null,
        ]);

        Test_parameters::create([
            'title' => 'Normal Forms',
            'tests_id' => $test->id,
            'unit' => '%',
            'normal_range' => "75 - 85",
            'type' => 'Numeric',
            'options' => null,
        ]);

        Test_parameters::create([
            'title' => 'Abnormal Forms',
            'tests_id' => $test->id,
            'unit' => '%',
            'normal_range' => "20-25",
            'type' => 'Numeric',
            'options' => null,
        ]);

        Test_parameters::create([
            'title' => 'Cytology',
            'tests_id' => $test->id,
            'unit' => null,
            'normal_range' => "Leucocytes Gonadal Cells\nEpithelial Cells\nRed Blood Cells",
            'type' => 'Text',
            'options' => null,
        ]);
    }
}
