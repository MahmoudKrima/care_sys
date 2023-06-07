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
                'name_ar' => 'الطب العام',
                'name_en' => 'General Medicine',
            ],
            [
                'name_ar' => 'طب الأطفال',
                'name_en' => 'Pediatrics',
            ],
            [
                'name_ar' => 'طب الأسنان',
                'name_en' => 'Dentist',
            ],
            [
                'name_ar' => 'جراحة القلب',
                'name_en' => 'Heart Surgery',
            ],
            [
                'name_ar' => 'الطب النفسي',
                'name_en' => 'Psychiatry',
            ],
            [
                'name_ar' => 'أمراض الكلى',
                'name_en' => 'Kidney disease',
            ],
            [
                'name_ar' => 'أمراض الغدد',
                'name_en' => 'Diseases of the glands',
            ],
            [
                'name_ar' => 'طب الطوارئ',
                'name_en' => 'Emergency Medicine',
            ],
            [
                'name_ar' => 'التحاليل الطبية',
                'name_en' => 'Medical tests',
            ],
            [
                'name_ar' => 'أمراض النخاع',
                'name_en' => 'Diseases of the bone marrow',
            ],
            [
                'name_ar' => 'الأمراض الجلدية',
                'name_en' => 'Skin diseases',
            ],
            [
                'name_ar' => 'طب النسائية والتوليد',
                'name_en' => 'Obstetrics and gynecology',
            ],
        ];

        foreach ($input as $data) {
            Specialization::create($data);
        }
    }
}
