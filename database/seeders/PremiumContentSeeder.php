<?php

namespace Database\Seeders;

use App\Models\ContentItem;
use Illuminate\Database\Seeder;

class PremiumContentSeeder extends Seeder
{
    public function run(): void
    {
        // Services
        ContentItem::firstOrCreate(
            ['type' => 'service', 'title' => 'Airport Transfers'],
            ['subtitle' => 'On-time pickup, premium comfort.', 'body' => 'Executive-grade transfers with clean cars and professional drivers.', 'sort_order' => 10]
        );
        ContentItem::firstOrCreate(
            ['type' => 'service', 'title' => 'City Rides'],
            ['subtitle' => 'Fast booking, smooth experience.', 'body' => 'Modern UI, quick confirmation, and trusted service for daily travel.', 'sort_order' => 20]
        );
        ContentItem::firstOrCreate(
            ['type' => 'service', 'title' => 'Outstation Trips'],
            ['subtitle' => 'Reliable & comfortable.', 'body' => 'Clear pricing and conflict-free scheduling for long trips.', 'sort_order' => 30]
        );

        // Projects/Portfolio
        ContentItem::firstOrCreate(
            ['type' => 'project', 'title' => 'Premium Booking Flow'],
            ['subtitle' => 'No double-booking protection', 'body' => 'Availability checks + unit allocation to prevent overbooking.', 'sort_order' => 10]
        );
        ContentItem::firstOrCreate(
            ['type' => 'project', 'title' => '3D Interactive Hero'],
            ['subtitle' => 'Three.js + smooth camera motion', 'body' => 'Particles, lighting, reflections, and hover motion.', 'sort_order' => 20]
        );

        // Testimonials
        ContentItem::firstOrCreate(
            ['type' => 'testimonial', 'title' => 'Anita'],
            ['subtitle' => 'Verified customer', 'body' => 'Premium feel and super easy booking. Loved the smooth UI.', 'sort_order' => 10]
        );
        ContentItem::firstOrCreate(
            ['type' => 'testimonial', 'title' => 'Rahul'],
            ['subtitle' => 'Verified customer', 'body' => 'Live availability made everything clear. No confusion.', 'sort_order' => 20]
        );
        ContentItem::firstOrCreate(
            ['type' => 'testimonial', 'title' => 'Mihir'],
            ['subtitle' => 'Verified customer', 'body' => 'Fast service, clean car, and professional driver.', 'sort_order' => 30]
        );

        // Plans (title=plan name, subtitle=price)
        ContentItem::firstOrCreate(
            ['type' => 'plan', 'title' => 'Essential'],
            ['subtitle' => '₹2,999', 'body' => 'City rides · Standard support · Transparent pricing', 'sort_order' => 10]
        );
        ContentItem::firstOrCreate(
            ['type' => 'plan', 'title' => 'Premium'],
            ['subtitle' => '₹4,999', 'body' => 'Priority support · Luxury-first fleet · Flexible slots', 'sort_order' => 20]
        );
        ContentItem::firstOrCreate(
            ['type' => 'plan', 'title' => 'Executive'],
            ['subtitle' => '₹7,999', 'body' => 'Dedicated driver · Top fleet · White-glove service', 'sort_order' => 30]
        );

        // FAQ
        ContentItem::firstOrCreate(
            ['type' => 'faq', 'title' => 'Can I book when all cars are busy?'],
            ['body' => 'No. Availability is checked live for your time slot, preventing overbooking.', 'sort_order' => 10]
        );
        ContentItem::firstOrCreate(
            ['type' => 'faq', 'title' => 'Is this mobile friendly?'],
            ['body' => 'Yes. 3D effects reduce on mobile devices for high-FPS performance.', 'sort_order' => 20]
        );

        // Blog
        ContentItem::firstOrCreate(
            ['type' => 'post', 'title' => 'Introducing the Premium 3D Experience'],
            ['subtitle' => 'Design like Apple · Motion like Tesla', 'body' => 'This site is built with Blade + Vite + Three.js + GSAP to achieve a premium product feel with fast loading and clean UX.', 'sort_order' => 10]
        );
    }
}

