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
                'name_ar' => 'الطب العام.',
                'name_en' => 'General Medicine',
                'charges' => '500',
                'status' => Service::ACTIVE,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
                'icon' => asset('assets/front/images/services_images/Diagnostics.png'),
            ],
            [
                'category_id' => '1',
                'specialization_id' => 2,
                'name_ar' => 'طب الأطفال.',
                'name_en' => 'Pediatrics',
                'charges' => '500',
                'status' => Service::ACTIVE,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
                'icon' => asset('assets/front/images/services_images/Treatment.png'),
            ],
            [
                'category_id' => '1',
                'specialization_id' => 3,
                'name_ar' => 'طب الأسنان.',
                'name_en' => 'Dentist',
                'charges' => '500',
                'status' => Service::ACTIVE,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
                'icon' => asset('assets/front/images/services_images/Surgery.png'),
            ],
            [
                'category_id' => '1',
                'specialization_id' => 4,
                'name_ar' => 'جراحة القلب.',
                'name_en' => 'Heart Surgery',
                'charges' => '500',
                'status' => Service::ACTIVE,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
                'icon' => asset('assets/front/images/services_images/Emergency.png'),
            ],
            [
                'category_id' => '1',
                'specialization_id' => 5,
                'name_ar' => 'الطب النفسي.',
                'name_en' => 'Psychiatry',
                'charges' => '500',
                'status' => Service::ACTIVE,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
                'icon' => asset('assets/front/images/services_images/Vaccine.png'),
            ],
            [
                'category_id' => '1',
                'specialization_id' => 6,
                'name_ar' => 'أمراض الكلى',
                'name_en' => 'Kidney disease',
                'charges' => '500',
                'status' => Service::ACTIVE,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
                'icon' => asset('assets/front/images/services_images/qualified_doctors.png'),
            ],
            [
                'category_id' => '1',
                'specialization_id' => 7,
                'name_ar' => 'أمراض الغدد',
                'name_en' => 'Diseases of the glands',
                'charges' => '500',
                'status' => Service::ACTIVE,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
                'icon' => asset('assets/front/images/services_images/qualified_doctors.png'),
            ],
            [
                'category_id' => '1',
                'specialization_id' => 8,
                'name_ar' => 'طب الطوارئ.',
                'name_en' => 'Emergency Medicine',
                'charges' => '500',
                'status' => Service::ACTIVE,
                'short_description' => 'Phasellus venenatis porta rhoncus. Integer et viverra felis.',
                'icon' => asset('assets/front/images/services_images/qualified_doctors.png'),
            ],
            [
                'category_id' => '1',
                'specialization_id' => 9,
                'name_ar' => 'التحاليل الطبية.',
                'name_en' => 'Medical tests',
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
