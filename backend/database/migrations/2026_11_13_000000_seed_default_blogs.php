<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $existing = DB::table('blogs')->count();
        if ($existing === 0) {
            DB::table('blogs')->insert([
                [
                    'title' => 'Universal Paints Launches Advanced Hybrid Aquamax Waterproofing Technology',
                    'slug' => 'universal-paints-launches-advanced-hybrid-aquamax-waterproofing-technology',
                    'content' => '<p>Universal Paints is proud to unveil its latest breakthrough in architectural protection: <strong>Hybrid Aquamax Waterproofing Paint</strong>. Formulated using advanced water-based polymer cross-linking technology, Hybrid Aquamax offers an all-in-one protective barrier engineered specifically for Sri Lanka’s demanding tropical weather conditions.</p><h3>Unmatched 8-in-1 Surface Defense</h3><p>Unlike traditional solvent-based sealants, Hybrid Aquamax combines flexible crack-bridging elasticity with high hydrostatic pressure resistance. It seals hairline cracks up to 1.5mm, prevents efflorescence, resists fungal and algae growth, and acts as its own primer, significantly cutting labour and application costs for both residential builders and commercial developers.</p><h3>Engineered for Sri Lankan Climates</h3><p>With seasonal monsoons and high humidity across coastal and highland regions, concrete surfaces are constantly vulnerable to moisture ingress. Universal Paints technical research lab spent over 18 months formulating and field-testing Hybrid Aquamax on concrete slabs, exterior masonry, parapet walls, and asbestos sheets to guarantee long-lasting durability.</p><p>Hybrid Aquamax is now available in 1L, 4L, 10L, and 20L packs through Universal Paints authorized dealers and sales representatives nationwide.</p>',
                    'image' => '/images/about-us-page/lab-test.webp',
                    'status' => 'published',
                    'published_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'title' => 'Color Trends & Architectural Finishes: Elevating Modern Sri Lankan Spaces',
                    'slug' => 'color-trends-and-architectural-finishes-elevating-modern-sri-lankan-spaces',
                    'content' => '<p>Modern architecture in Sri Lanka is undergoing an exciting renaissance—blending open-concept tropical minimalism with warm earthy undertones and vibrant accents. Universal Paints has curated an inspiring guide on how to choose colors and finishes that enhance natural daylight while standing up to high humidity and intense UV exposure.</p><h3>The Rise of Calming Earth Tones & Crisp Neutrals</h3><p>Interior spaces are embracing warm whites, subtle stone greys, and muted terracotta shades. Our flagship <em>Sudu Sudu Premium Emulsion</em> has become the top choice for contemporary living areas, offering a bright, light-reflective matte finish that creates an illusion of expansive space.</p><h3>Long-Lasting Exterior Aesthetics</h3><p>When painting exterior facades, color retention is just as vital as aesthetics. Universal Paints utilizes UV-resistant micronized pigments that prevent fading and chalking even after prolonged exposure to tropical sunlight. Combine light-reflective neutrals on main facades with bold feature walls in rainforest green or coastal blue to create memorable curb appeal.</p><p>Visit our showroom or connect with our dealer network to explore our extensive color palettes and sample cards.</p>',
                    'image' => '/images/about-us-page/production-line.webp',
                    'status' => 'published',
                    'published_at' => now()->subDays(5),
                    'created_at' => now()->subDays(5),
                    'updated_at' => now()->subDays(5),
                ],
                [
                    'title' => 'Expanding Nationwide: Universal Paints Deepens Distribution Across 25 Districts',
                    'slug' => 'expanding-nationwide-universal-paints-deepens-distribution-across-25-districts',
                    'content' => '<p>In line with our commitment to accessible quality and dependable service, Universal Paints has announced the significant expansion of our islandwide logistics fleet and dedicated district sales network across all 25 administrative districts in Sri Lanka.</p><h3>Next-Day Dealer Replenishment</h3><p>Hardware retailers and paint distributors can now benefit from streamlined central ordering and guaranteed prompt replenishment. Our regional logistics hubs in Western, Central, Southern, North Western, and Eastern provinces ensure that stock-outs are eliminated, even during peak festive and construction seasons.</p><h3>Direct Technical Site Support</h3><p>Alongside expanded distribution, Universal Paints has deployed specialized technical advisors to assist contractors, architects, and homeowners on-site with substrate preparation diagnostics, moisture measurements, and custom tinting solutions.</p><p>Find your nearest distributor or district sales representative on our dedicated Network page today.</p>',
                    'image' => '/images/about-us-page/truck.webp',
                    'status' => 'published',
                    'published_at' => now()->subDays(12),
                    'created_at' => now()->subDays(12),
                    'updated_at' => now()->subDays(12),
                ]
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('blogs')->whereIn('slug', [
            'universal-paints-launches-advanced-hybrid-aquamax-waterproofing-technology',
            'color-trends-and-architectural-finishes-elevating-modern-sri-lankan-spaces',
            'expanding-nationwide-universal-paints-deepens-distribution-across-25-districts'
        ])->delete();
    }
};

