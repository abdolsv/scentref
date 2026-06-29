{{-- resources/views/legal/terms.blade.php --}}
@extends('layouts.legal')

@section('breadcrumb', 'Terms & Conditions')
@section('heading', 'Terms & Conditions')
@section('subheading', 'Last updated: ' . ($lastUpdated ?? '29 June 2026'))

@section('toc')
<a href="#acceptance"        class="block py-0.5 hover:text-gold transition-colors">1. Acceptance</a>
<a href="#service"           class="block py-0.5 hover:text-gold transition-colors">2. Description of Service</a>
<a href="#ugc"               class="block py-0.5 hover:text-gold transition-colors">3. User Contributions</a>
<a href="#ip"                class="block py-0.5 hover:text-gold transition-colors">4. Intellectual Property</a>
<a href="#affiliate"         class="block py-0.5 hover:text-gold transition-colors">5. Affiliate Links</a>
<a href="#price-accuracy"    class="block py-0.5 hover:text-gold transition-colors">6. Price Accuracy</a>
<a href="#prohibited"        class="block py-0.5 hover:text-gold transition-colors">7. Prohibited Uses</a>
<a href="#third-party"       class="block py-0.5 hover:text-gold transition-colors">8. Third-Party Links</a>
<a href="#warranties"        class="block py-0.5 hover:text-gold transition-colors">9. Warranties</a>
<a href="#liability"         class="block py-0.5 hover:text-gold transition-colors">10. Liability</a>
<a href="#indemnification"   class="block py-0.5 hover:text-gold transition-colors">11. Indemnification</a>
<a href="#termination"       class="block py-0.5 hover:text-gold transition-colors">12. Termination</a>
<a href="#governing-law"     class="block py-0.5 hover:text-gold transition-colors">13. Governing Law</a>
<a href="#changes"           class="block py-0.5 hover:text-gold transition-colors">14. Changes</a>
<a href="#contact-legal"     class="block py-0.5 hover:text-gold transition-colors">15. Contact</a>
@endsection

@section('legal-content')

<p>
    Please read these Terms and Conditions ("Terms") carefully before using <strong>ScentRef.ng</strong>
    (the "Service"), operated by ScentRef ("we", "us", or "our"). By accessing or using the Service,
    you agree to be bound by these Terms. If you disagree with any part of these Terms, you may not
    access the Service.
</p>

<h2 id="acceptance">1. Acceptance of Terms</h2>

<p>
    By accessing ScentRef.com, you confirm that you are at least 13 years of age and are legally capable
    of entering into a binding agreement under the laws of the Federal Republic of Nigeria. If you are
    accessing the Service on behalf of an organisation, you represent that you have authority to bind
    that organisation to these Terms.
</p>

<h2 id="service">2. Description of Service</h2>

<p>
    ScentRef.ng is an independent fragrance reference and price-comparison platform for the Nigerian
    market. Our Service includes:
</p>
<ul>
    <li>A searchable database of fragrances with descriptions, ingredient notes, and editorial ratings</li>
    <li>Current and historical price data for fragrances available in Nigeria, sourced from third-party vendors</li>
    <li>Community-submitted buyer reviews from Nigerian fragrance enthusiasts</li>
    <li>Fragrance guides, authenticity tips, and editorial content</li>
    <li>Price alert notifications delivered by email</li>
    <li>A public read-only API at <code>scentref.ng/api/v1/</code></li>
</ul>

<p>
    We are a <strong>reference and comparison platform only</strong>. ScentRef.ng does not sell, supply,
    or distribute any fragrance products. All purchases are made directly with third-party vendors, and
    ScentRef.com is not a party to any transaction between you and a vendor.
</p>

<h2 id="ugc">3. User-Generated Content (Reviews)</h2>

<h3>3.1 Submission</h3>
<p>
    When you submit a review on ScentRef.ng, you grant us a non-exclusive, royalty-free, worldwide,
    perpetual licence to display, reproduce, edit, translate, and distribute your review on the Service
    and in marketing materials, subject to our <a href="{{ route('privacy') }}">Privacy Policy</a>.
</p>

<h3>3.2 Review Standards</h3>
<p>You agree that reviews you submit will:</p>
<ul>
    <li>Reflect your genuine, first-hand experience with the product</li>
    <li>Not contain false statements of fact, defamatory content, or personal attacks</li>
    <li>Not contain promotional content for competing services</li>
    <li>Not impersonate any person, brand, or organisation</li>
    <li>Not contain personally identifiable information about third parties</li>
    <li>Be in English or any Nigerian language</li>
</ul>

<h3>3.3 Moderation</h3>
<p>
    We reserve the right to refuse, edit, or remove any review at our sole discretion, including
    reviews that we determine violate these standards or our editorial integrity. We are not obligated
    to provide reasons for removal.
</p>

<h3>3.4 Verification</h3>
<p>
    All reviews require email verification before publication. We may display a "Verified Purchase"
    badge where a reviewer provides credible evidence of purchase. We cannot guarantee the accuracy of
    purchase claims and bear no liability for unverified buyer claims.
</p>

<h2 id="ip">4. Intellectual Property</h2>

<h3>4.1 Our Content</h3>
<p>
    All editorial content on ScentRef.com — including fragrance descriptions, ratings, scoring
    methodologies, guides, photographs, and database structure — is the intellectual property of
    ScentRef and is protected under the Copyright Act of Nigeria (Cap C28 LFN 2004) and applicable
    international copyright law. You may not reproduce, republish, scrape, or commercially exploit
    our content without prior written permission.
</p>

<h3>4.2 Third-Party Content</h3>
<p>
    Fragrance brand names, product names, and bottle imagery are the intellectual property of their
    respective owners. ScentRef.ng uses these under fair use / nominative use for reference and
    informational purposes only. We do not claim ownership of any brand or product intellectual property.
</p>

<h3>4.3 API Usage</h3>
<p>
    Our public API is provided for personal and non-commercial use only. Commercial use of our API —
    including use to populate a competing database — requires a written commercial licence. We reserve
    the right to revoke API access without notice.
</p>

<h2 id="affiliate">5. Affiliate Links & Commercial Relationships</h2>

<p>
    ScentRef.ng participates in affiliate programmes operated by Nigerian e-commerce platforms
    including but not limited to Jumia and Konga. When you click a vendor link on our site and
    subsequently make a purchase, we may receive a commission at no additional cost to you.
</p>
<p>
    <strong>Our editorial independence is not compromised by affiliate relationships.</strong> Affiliate
    status does not influence our ratings, reviews, or editorial verdicts. We publish honest assessments
    regardless of whether a product or vendor has a commercial relationship with us. You can identify
    affiliate links because they include tracking parameters — we do not conceal this.
</p>
<p>
    See our full <a href="{{ route('disclaimer') }}">Disclaimer & Affiliate Disclosure</a> for details.
</p>

<h2 id="price-accuracy">6. Price Accuracy & Data Disclaimer</h2>

<p>
    Price data displayed on ScentRef.ng is sourced from publicly available vendor listings and is
    updated periodically. Prices are indicative only and may not reflect the current price at the
    time of your visit. ScentRef.ng makes no warranty as to the accuracy, completeness, or timeliness
    of any price information.
</p>
<p>
    You should always verify the current price directly on the vendor's platform before making any
    purchase decision. ScentRef.ng accepts no liability for losses arising from reliance on price
    data displayed on this site.
</p>

<h2 id="prohibited">7. Prohibited Uses</h2>

<p>You agree not to use the Service to:</p>
<ul>
    <li>Scrape, crawl, or systematically extract data from the site without written permission</li>
    <li>Submit false, misleading, or fraudulent reviews</li>
    <li>Attempt to manipulate our ratings or ranking systems</li>
    <li>Introduce malware, viruses, or any malicious code</li>
    <li>Engage in any activity that disrupts or impairs the Service</li>
    <li>Use our data to build or populate a competing fragrance database</li>
    <li>Misrepresent your identity or affiliation when submitting content</li>
    <li>Use the Service in any way that violates Nigerian law or the laws of your jurisdiction</li>
</ul>

<h2 id="third-party">8. Third-Party Links & Vendor Websites</h2>

<p>
    The Service contains links to third-party websites, including vendor product listings. These links
    are provided for convenience and do not constitute an endorsement of the linked website or its
    operator. We have no control over the content, privacy practices, or availability of third-party
    websites and accept no responsibility for them.
</p>
<p>
    ScentRef.ng is not responsible for the availability or accuracy of vendor listings, out-of-stock
    items, delivery failures, counterfeit products, or any other issue arising from a purchase made
    through a third-party vendor. All disputes regarding purchases must be resolved directly with
    the relevant vendor.
</p>

<h2 id="warranties">9. Disclaimer of Warranties</h2>

<p>
    The Service is provided on an <strong>"as is" and "as available"</strong> basis without warranties
    of any kind, either express or implied, including but not limited to implied warranties of
    merchantability, fitness for a particular purpose, and non-infringement.
</p>
<p>
    We do not warrant that the Service will be uninterrupted, error-free, or free of viruses or other
    harmful components. We do not warrant the accuracy, completeness, or usefulness of any information
    on the Service.
</p>

<h2 id="liability">10. Limitation of Liability</h2>

<p>
    To the fullest extent permitted by applicable law, ScentRef.ng, its directors, employees,
    partners, agents, suppliers, and affiliates shall not be liable for any indirect, incidental,
    special, consequential, or punitive damages, including without limitation lost profits, lost
    data, loss of goodwill, or business interruption, arising out of:
</p>
<ul>
    <li>Your access to or use of, or inability to access or use, the Service</li>
    <li>Any conduct or content of any third party on the Service</li>
    <li>Any content obtained from the Service</li>
    <li>Purchases made through vendor links on the Service</li>
    <li>Unauthorised access, use, or alteration of your transmissions or content</li>
</ul>
<p>
    Our total aggregate liability to you for any claims arising under these Terms shall not exceed the
    greater of ₦10,000 (Ten Thousand Naira) or the amount you paid us in the preceding 12 months.
</p>

<h2 id="indemnification">11. Indemnification</h2>

<p>
    You agree to defend, indemnify, and hold harmless ScentRef.ng and its affiliates, directors,
    employees, and agents from and against any claims, liabilities, damages, judgements, awards, losses,
    costs, expenses, or fees (including reasonable legal fees) arising out of or relating to your
    violation of these Terms or your use of the Service, including any content you submit.
</p>

<h2 id="termination">12. Termination</h2>

<p>
    We may suspend or terminate your access to the Service at any time, without notice or liability,
    for any reason, including if you breach these Terms. Upon termination, your right to use the Service
    will cease immediately. All provisions of these Terms that by their nature should survive termination
    shall survive, including intellectual property provisions, warranty disclaimers, and limitations
    of liability.
</p>

<h2 id="governing-law">13. Governing Law & Dispute Resolution</h2>

<h3>13.1 Governing Law</h3>
<p>
    These Terms shall be governed by and construed in accordance with the laws of the
    <strong>Federal Republic of Nigeria</strong>, without regard to its conflict of law provisions.
</p>

<h3>13.2 Disputes</h3>
<p>
    Any dispute arising out of or relating to these Terms or the Service shall first be referred to
    good-faith negotiation between the parties. If the dispute is not resolved within 30 days, it
    shall be submitted to the exclusive jurisdiction of the courts of Lagos State, Nigeria.
</p>

<h3>13.3 Class Action Waiver</h3>
<p>
    Any proceedings to resolve disputes will be conducted on an individual basis only. You waive any
    right to bring or participate in a class action, collective action, or representative proceeding.
</p>

<h2 id="changes">14. Changes to These Terms</h2>

<p>
    We reserve the right to modify these Terms at any time. When we make material changes, we will
    update the "Last updated" date at the top of this page. Continued use of the Service after changes
    take effect constitutes your acceptance of the revised Terms. We encourage you to review these
    Terms periodically.
</p>

<h2 id="contact-legal">15. Contact Us</h2>

<p>
    If you have any questions about these Terms, please contact us:
</p>
<ul>
    <li>Email: <a href="mailto:legal@scentref.ng">legal@scentref.ng</a></li>
    <li>Website: <a href="{{ route('contact') }}">scentref.ng/contact</a></li>
</ul>

@endsection
