<?php

namespace Database\Seeders;

use App\Models\ServiceCategory;
use Illuminate\Database\Seeder;

class DefaultServiceCategorySeeder extends Seeder
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
                'name_ar' => 'زياره عيادة',
                'name_en' => 'Clinic Visit',
            ],
            [
                'name_ar' => 'كوفيد - 19 ',
                'name_en' => 'Covid-19',
            ],
            [
                'name_ar' => 'عروض',
                'name_en' => 'Offers',
            ],
            [
                'name_ar' => 'صيدليه',
                'name_en' => 'Pharmacy',
            ],
            [
                'name_ar' => 'الامراض',
                'name_en' => 'Diseasses',
            ],
            [
                'name_ar' => 'زياره منزليه',
                'name_en' => 'Home Visit',
            ],
        ];

        foreach ($input as $data) {
            ServiceCategory::create($data);
        }
    }
}
