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
                'name' => 'زياره عيادة',
            ],
            [
                'name' => 'كوفيد - 19 ',
            ],
            [
                'name' => 'عروض',
            ],
            [
                'name' => 'صيدليه',
            ],
            [
                'name' => 'الامراض',
            ],
            [
                'name' => 'زياره منزليه',
            ],
        ];

        foreach ($input as $data) {
            ServiceCategory::create($data);
        }
    }
}
