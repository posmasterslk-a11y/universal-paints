<?php

namespace Database\Seeders;

use App\Models\SalesRepresentative;
use Illuminate\Database\Seeder;

class SalesRepresentativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $representatives = [
            [
                'name' => 'Pradeep Wickramasinghe',
                'designation' => 'Senior Regional Sales Manager - Western Province',
                'phone' => '+94 77 123 4567',
                'whatsapp' => '+94771234567',
                'email' => 'pradeep.w@universalpaints.lk',
                'districts' => ['Colombo', 'Gampaha'],
                'image' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?w=400&auto=format&fit=crop&q=80',
                'is_active' => true,
                'sort_order' => 1,
                'notes' => 'Specialized in Industrial & Architectural Coatings projects.',
            ],
            [
                'name' => 'Kasun Dissanayake',
                'designation' => 'Area Sales Executive - Kalutara & Southern Coast',
                'phone' => '+94 71 987 6543',
                'whatsapp' => '+94719876543',
                'email' => 'kasun.d@universalpaints.lk',
                'districts' => ['Kalutara', 'Galle'],
                'image' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?w=400&auto=format&fit=crop&q=80',
                'is_active' => true,
                'sort_order' => 2,
                'notes' => 'Handles decorative coatings and dealer inquiries.',
            ],
            [
                'name' => 'Nalin Bandara',
                'designation' => 'Regional Sales Executive - Central Province',
                'phone' => '+94 76 555 4321',
                'whatsapp' => '+94765554321',
                'email' => 'nalin.b@universalpaints.lk',
                'districts' => ['Kandy', 'Matale', 'Nuwara Eliya'],
                'image' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&auto=format&fit=crop&q=80',
                'is_active' => true,
                'sort_order' => 3,
                'notes' => 'Wood care and weather-guard exterior solutions expert.',
            ],
            [
                'name' => 'Dinesh Kumara',
                'designation' => 'Senior Area Representative - Southern Province',
                'phone' => '+94 77 444 8899',
                'whatsapp' => '+94774448899',
                'email' => 'dinesh.k@universalpaints.lk',
                'districts' => ['Matara', 'Hambantota'],
                'image' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=400&auto=format&fit=crop&q=80',
                'is_active' => true,
                'sort_order' => 4,
                'notes' => 'Marine & coastal protective coatings support.',
            ],
            [
                'name' => 'Mohamed Rizwan',
                'designation' => 'Area Sales Executive - North Western',
                'phone' => '+94 78 333 2211',
                'whatsapp' => '+94783332211',
                'email' => 'rizwan.m@universalpaints.lk',
                'districts' => ['Kurunegala', 'Puttalam'],
                'image' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400&auto=format&fit=crop&q=80',
                'is_active' => true,
                'sort_order' => 5,
                'notes' => 'Hardware dealers & construction bulk orders.',
            ],
            [
                'name' => 'Suresh Sivakumar',
                'designation' => 'Regional Sales Manager - Northern & Eastern',
                'phone' => '+94 77 666 7788',
                'whatsapp' => '+94776667788',
                'email' => 'suresh.s@universalpaints.lk',
                'districts' => ['Jaffna', 'Kilinochchi', 'Trincomalee', 'Batticaloa', 'Vavuniya'],
                'image' => 'https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=400&auto=format&fit=crop&q=80',
                'is_active' => true,
                'sort_order' => 6,
                'notes' => 'Multi-lingual customer support (Tamil, Sinhala, English).',
            ],
            [
                'name' => 'Chaminda Senanayake',
                'designation' => 'Area Representative - North Central & Uva',
                'phone' => '+94 71 222 3344',
                'whatsapp' => '+94712223344',
                'email' => 'chaminda.s@universalpaints.lk',
                'districts' => ['Anuradhapura', 'Polonnaruwa', 'Badulla', 'Monaragala'],
                'image' => 'https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?w=400&auto=format&fit=crop&q=80',
                'is_active' => true,
                'sort_order' => 7,
                'notes' => 'Agricultural and industrial infrastructure coatings.',
            ],
            [
                'name' => 'Ruwan Jayasinghe',
                'designation' => 'Senior Sales Executive - Sabaragamuwa',
                'phone' => '+94 70 111 2233',
                'whatsapp' => '+94701112233',
                'email' => 'ruwan.j@universalpaints.lk',
                'districts' => ['Ratnapura', 'Kegalle'],
                'image' => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?w=400&auto=format&fit=crop&q=80',
                'is_active' => true,
                'sort_order' => 8,
                'notes' => 'Epoxy floor coatings & residential paints.',
            ],
        ];

        foreach ($representatives as $rep) {
            SalesRepresentative::updateOrCreate(
                ['phone' => $rep['phone']],
                $rep
            );
        }
    }
}

