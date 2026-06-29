<?php
// app/Http/Controllers/LegalController.php
namespace App\Http\Controllers;

class LegalController extends Controller
{
    public function terms()
    {
        return view('legal.terms', [
            'title'       => 'Terms & Conditions — ScentRef.ng',
            'description' => 'Terms and conditions governing your use of ScentRef.ng, Nigeria\'s fragrance reference platform.',
            'lastUpdated' => '29 June 2026',
        ]);
    }

    public function privacy()
    {
        return view('legal.privacy', [
            'title'       => 'Privacy Policy — ScentRef.ng',
            'description' => 'How ScentRef.ng collects, uses and protects your personal data under the Nigeria Data Protection Act 2023.',
            'lastUpdated' => '29 June 2026',
        ]);
    }

    public function cookies()
    {
        return view('legal.cookies', [
            'title'       => 'Cookie Policy — ScentRef.ng',
            'description' => 'How ScentRef.ng uses cookies and similar technologies on our website.',
            'lastUpdated' => '29 June 2026',
        ]);
    }

    public function disclaimer()
    {
        return view('legal.disclaimer', [
            'title'       => 'Disclaimer & Affiliate Disclosure — ScentRef.ng',
            'description' => 'Price accuracy disclaimer, affiliate link disclosure, and review independence statement for scentref.com.',
            'lastUpdated' => '29 June 2029',
        ]);
    }

    public function howWeRate()
    {
        return view('guides.how-we-rate', [
            'title'       => 'How We Rate Fragrances — ScentRef Methodology',
            'description' => 'ScentRef\'s rating methodology: how we score longevity in Lagos heat, sillage, value for money, and overall quality for Nigerian buyers.',
        ]);
    }

    public function authenticityGuide()
    {
        return view('guides.authenticity-guide', [
            'title'       => 'How to Spot Fake Perfumes in Nigeria — ScentRef Guide',
            'description' => 'A complete guide to identifying counterfeit fragrances when buying in Nigeria — from Trade Fair to Jumia and local vendors.',
        ]);
    }

    public function advertise()
    {
        return view('legal.advertise', [
            'title'       => 'Advertise on ScentRef.ng — Media Kit',
            'description' => 'Advertising and partnership opportunities on ScentRef.ng — Nigeria\'s leading fragrance reference platform.',
        ]);
    }
}
