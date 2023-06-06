<?php

namespace Database\Seeders;

use App\Models\Doctor;
use App\Models\Service;
use Illuminate\Database\Seeder;

class DefaultServicesSeeder extends Seeder
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
                'category_id' => '1',
                'specialization_id' => 1,
                'name' => 'الطب العام.',
                'charges' => '500',
                'status' => Service::ACTIVE,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
                'icon' => asset('assets/front/images/services_images/Diagnostics.png'),
            ],
            [
                'category_id' => '1',
                'specialization_id' => 2,
                'name' => 'طب الأطفال.',
                'charges' => '500',
                'status' => Service::ACTIVE,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
                'icon' => asset('assets/front/images/services_images/Treatment.png'),
            ],
            [
                'category_id' => '1',
                'specialization_id' => 3,
                'name' => 'طب الأسنان.',
                'charges' => '500',
                'status' => Service::ACTIVE,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
                'icon' => asset('assets/front/images/services_images/Surgery.png'),
            ],
            [
                'category_id' => '1',
                'specialization_id' => 4,
                'name' => 'جراحة القلب.',
                'charges' => '500',
                'status' => Service::ACTIVE,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
                'icon' => asset('assets/front/images/services_images/Emergency.png'),
            ],
            [
                'category_id' => '1',
                'specialization_id' => 5,
                'name' => 'الطب النفسي.',
                'charges' => '500',
                'status' => Service::ACTIVE,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
                'icon' => asset('assets/front/images/services_images/Vaccine.png'),
            ],
            [
                'category_id' => '1',
                'specialization_id' => 6,
                'name' => 'أمراض الكلى',
                'charges' => '500',
                'status' => Service::ACTIVE,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
                'icon' => asset('assets/front/images/services_images/qualified_doctors.png'),
            ],
            [
                'category_id' => '1',
                'specialization_id' => 7,
                'name' => 'أمراض الغدد',
                'charges' => '500',
                'status' => Service::ACTIVE,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
                'icon' => asset('assets/front/images/services_images/qualified_doctors.png'),
            ],
            [
                'category_id' => '1',
                'specialization_id' => 8,
                'name' => 'طب الطوارئ.',
                'charges' => '500',
                'status' => Service::ACTIVE,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
                'icon' => asset('assets/front/images/services_images/qualified_doctors.png'),
            ],
            [
                'category_id' => '1',
                'specialization_id' => 9,
                'name' => 'التحاليل الطبية.',
                'charges' => '500',
                'status' => Service::ACTIVE,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
                'icon' => asset('assets/front/images/services_images/qualified_doctors.png'),
            ],
        ];

        $doctor = Doctor::firstOrfail();

        foreach ($input as $data) {
            $image = $data['icon'];
            unset($data['icon']);
            $service = Service::create($data);
            $service->serviceDoctors()->sync($doctor->id);
        }
    }
}
