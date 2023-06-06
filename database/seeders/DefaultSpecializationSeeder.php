<?php

namespace Database\Seeders;

use App\Models\Specialization;
use Illuminate\Database\Seeder;

class DefaultSpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $input = [
            [
                'name' => 'الطب العام.',
            ],
            [
                'name' => 'طب الأطفال.',
            ],
            [
                'name' => 'طب الأسنان.',
            ],
            [
                'name' => 'جراحة القلب.',
            ],
            [
                'name' => 'الطب النفسي.',
            ],
            [
                'name' => 'أمراض الكلى',
            ],
            [
                'name' => 'أمراض الغدد',
            ],
            [
                'name' => 'طب الطوارئ.',
            ],
            [
                'name' => 'التحاليل الطبية.',
            ],
            [
                'name' => 'أمراض النخاع.',
            ],
            [
                'name' => 'الأمراض الجلدية.',
            ],
            [
                'name' => 'طب النسائية والتوليد.',
            ],
        ];

        foreach ($input as $data) {
            Specialization::create($data);
        }
    }
}
