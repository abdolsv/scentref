{{-- resources/views/legal/privacy.blade.php --}}
@extends('layouts.legal')

@section('breadcrumb', 'Privacy Policy')
@section('heading', 'Privacy Policy')
@section('subheading', 'Last updated: ' . ($lastUpdated ?? '1 June 2025') . ' · Compliant with the Nigeria Data Protection Act 2023')

@section('toc')
<a href="#controller"       class="block py-0.5 hover:text-gold transition-colors">1. Data Controller</a>
<a href="#what-we-collect"  class="block py-0.5 hover:text-gold transition-colors">2. Data We Collect</a>
<a href="#legal-basis"      class="block py-0.5 hover:text-gold transition-colors">3. Legal Basis (NDPA)</a>
<a href="#how-we-use"       class="block py-0.5 hover:text-gold transition-colors">4. How We Use Data</a>
<a href="#sharing"          class="block py-0.5 hover:text-gold transition-colors">5. Data Sharing</a>
<a href="#retention"        class="block py-0.5 hover:text-gold transition-colors">6. Retention</a>
<a href="#your-rights"      class="block py-0.5 hover:text-gold transition-colors">7. Your Rights</a>
<a href="#transfers"        class="block py-0.5 hover:text-gold transition-colors">8. International Transfers</a>
<a href="#security"         class="block py-0.5 hover:text-gold transition-colors">9. Security</a>
<a href="#minors"           class="block py-0.5 hover:text-gold transition-colors">10. Children</a>
<a href="#cookies-ref"      class="block py-0.5 hover:text-gold transition-colors">11. Cookies</a>
<a href="#changes-privacy"  class="block py-0.5 hover:text-gold transition-colors">12. Changes</a>
<a href="#contact-privacy"  class="block py-0.5 hover:text-gold transition-colors">13. Contact / DPO</a>
@endsection

@section('legal-content')

<p>
    This Privacy Policy explains how <strong>ScentRef.ng</strong> ("we", "us", "our") collects, uses,
    and protects your personal data when you use our website and services. We are committed to
    protecting your privacy in compliance with the <strong>Nigeria Data Protection Act 2023 (NDPA)</strong>
    and the Nigeria Data Protection Regulation (NDPR 2019).
</p>

<div class="bg-gold/10 border border-gold/30 rounded-xl p-5 not-prose my-6">
    <p class="text-xs font-semibold text-gold uppercase tracking-wide mb-2">Quick Summary</p>
    <ul class="text-sm text-ash space-y-1">
        <li>✓ We only collect data that is necessary to operate the Service</li>
        <li>✓ We never sell your personal data to third parties</li>
        <li>✓ Price alert emails are opt-in and you can unsubscribe at any time</li>
        <li>✓ You have rights to access, correct, and delete your data</li>
        <li>✓ We use cookies — see our <a href="{{ route('cookies') }}" class="text-gold hover:underline">Cookie Policy</a></li>
    </ul>
</div>

<h2 id="controller">1. Data Controller</h2>

<p>
    ScentRef.ng is the data controller for personal data processed through this website.
</p>
<ul>
    <li><strong>Entity:</strong> ScentRef</li>
    <li><strong>Country:</strong> Federal Republic of Nigeria</li>
    <li><strong>Email:</strong> <a href="mailto:privacy@scentref.ng">privacy@scentref.ng</a></li>
    <li><strong>Data Protection Officer:</strong> Available at <a href="mailto:dpo@scentref.ng">dpo@scentref.ng</a></li>
</ul>

<h2 id="what-we-collect">2. Data We Collect</h2>

<h3>2.1 Data You Provide Directly</h3>
<table class="w-full text-sm border-collapse not-prose mb-4">
    <thead>
        <tr class="bg-obsidian text-ivory">
            <th class="text-left p-3 rounded-tl">Data</th>
            <th class="text-left p-3">When Collected</th>
            <th class="text-left p-3 rounded-tr">Purpose</th>
        </tr>
    </thead>
    <tbody>
        @foreach([
            ['Name, email address', 'Review submission', 'Verify review authenticity; display reviewer name'],
            ['Your city / state', 'Review submission (optional)', 'Provide geographic context for other readers'],
            ['Purchase price paid', 'Review submission (optional)', 'Enrich price data for Nigerian buyers'],
            ['Email address', 'Price alert signup', 'Send price drop notifications'],
            ['Name, email, message', 'Contact form', 'Respond to your enquiry'],
        ] as [$data, $when, $purpose])
        <tr class="border-b border-gray-100">
            <td class="p-3 text-ink font-medium text-sm">{{ $data }}</td>
            <td class="p-3 text-ash text-sm">{{ $when }}</td>
            <td class="p-3 text-ash text-sm">{{ $purpose }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h3>2.2 Data Collected Automatically</h3>
<ul>
    <li><strong>IP address</strong> — for security, fraud prevention, and rate limiting</li>
    <li><strong>Browser type and version</strong> — for compatibility diagnostics</li>
    <li><strong>Pages visited and time spent</strong> — via Google Analytics (anonymised)</li>
    <li><strong>Referring URL</strong> — to understand how users find us</li>
    <li><strong>Device type</strong> — to optimise mobile experience</li>
</ul>
<p>We do not use fingerprinting, cross-site tracking, or behavioural advertising technologies.</p>

<h3>2.3 Data We Do Not Collect</h3>
<ul>
    <li>We do not collect payment card details (we have no checkout)</li>
    <li>We do not collect government ID or BVN</li>
    <li>We do not collect precise geolocation</li>
    <li>We do not build advertising profiles</li>
</ul>

<h2 id="legal-basis">3. Legal Basis for Processing (NDPA 2023)</h2>

<p>Under the Nigeria Data Protection Act 2023, we process your data on the following lawful bases:</p>

<table class="w-full text-sm border-collapse not-prose mb-4">
    <thead>
        <tr class="bg-obsidian text-ivory">
            <th class="text-left p-3 rounded-tl">Processing Activity</th>
            <th class="text-left p-3 rounded-tr">Lawful Basis (NDPA s.25)</th>
        </tr>
    </thead>
    <tbody>
        @foreach([
            ['Publishing your review', 'Consent (you opted in by submitting)'],
            ['Sending price alert emails', 'Consent (you opted in at signup)'],
            ['Responding to contact enquiries', 'Legitimate interest (responding to unsolicited enquiries)'],
            ['Analytics (anonymised)', 'Legitimate interest (improving Service)'],
            ['Rate limiting & security', 'Legitimate interest (protecting Service integrity)'],
            ['Legal compliance', 'Legal obligation'],
        ] as [$activity, $basis])
        <tr class="border-b border-gray-100">
            <td class="p-3 text-ink text-sm">{{ $activity }}</td>
            <td class="p-3 text-ash text-sm">{{ $basis }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h2 id="how-we-use">4. How We Use Your Data</h2>
<ul>
    <li><strong>Reviews:</strong> Your name, city, and review text will be publicly displayed on the perfume listing page. Your email is never displayed publicly and is used only for verification.</li>
    <li><strong>Price alerts:</strong> Your email is used exclusively to send you price drop notifications for fragrances you have subscribed to. We do not use it for any other marketing.</li>
    <li><strong>Contact form:</strong> Your message and contact details are used only to respond to your specific enquiry. We do not add you to any mailing list.</li>
    <li><strong>Analytics:</strong> Aggregated, anonymised usage data is used to understand how users navigate the site and to improve content and functionality.</li>
    <li><strong>Security:</strong> IP addresses are processed to detect and prevent abuse, spam, and fraudulent review submissions.</li>
</ul>

<h2 id="sharing">5. Data Sharing & Third Parties</h2>

<p>We do not sell, rent, or trade your personal data. We share data only in the following circumstances:</p>

<h3>5.1 Service Providers</h3>
<ul>
    <li><strong>Mailgun / Brevo</strong> — transactional email delivery (verification, price alerts)</li>
    <li><strong>Google Analytics</strong> — anonymised site analytics (IP anonymisation enabled)</li>
    <li><strong>Amazon Web Services (S3)</strong> — media storage (no personal data stored)</li>
    <li><strong>DigitalOcean / VPS provider</strong> — server hosting</li>
    <li><strong>Cloudflare</strong> — CDN and DDoS protection (processes IP addresses)</li>
</ul>
<p>All processors are bound by data processing agreements and are prohibited from using your data for any purpose beyond service delivery.</p>

<h3>5.2 Legal Disclosure</h3>
<p>We may disclose your data if required to do so by Nigerian law, court order, or a lawful request by a competent authority.</p>

<h3>5.3 Business Transfer</h3>
<p>If ScentRef.ng is acquired or merges with another entity, your data may be transferred as part of that transaction. We will notify you via a prominent notice on the site before your data is transferred and becomes subject to a different privacy policy.</p>

<h2 id="retention">6. Data Retention</h2>

<table class="w-full text-sm border-collapse not-prose mb-4">
    <thead>
        <tr class="bg-obsidian text-ivory">
            <th class="text-left p-3 rounded-tl">Data Type</th>
            <th class="text-left p-3 rounded-tr">Retention Period</th>
        </tr>
    </thead>
    <tbody>
        @foreach([
            ['Published reviews', 'Indefinitely (forms part of public record; deleted on verified request)'],
            ['Unverified / rejected reviews', '30 days, then permanently deleted'],
            ['Price alert subscriptions', 'Until you unsubscribe or 24 months of inactivity'],
            ['Contact form submissions', '12 months, then permanently deleted'],
            ['Server logs (including IPs)', '90 days'],
            ['Analytics data', '26 months (Google Analytics default)'],
        ] as [$type, $period])
        <tr class="border-b border-gray-100">
            <td class="p-3 text-ink text-sm">{{ $type }}</td>
            <td class="p-3 text-ash text-sm">{{ $period }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h2 id="your-rights">7. Your Rights Under NDPA 2023</h2>

<p>The Nigeria Data Protection Act 2023 grants you the following rights:</p>

<ul>
    <li><strong>Right of access (s.34):</strong> Request a copy of the personal data we hold about you.</li>
    <li><strong>Right to rectification (s.35):</strong> Request correction of inaccurate or incomplete data.</li>
    <li><strong>Right to erasure (s.36):</strong> Request deletion of your data where we have no overriding lawful basis to retain it.</li>
    <li><strong>Right to restriction (s.37):</strong> Request that we restrict processing of your data in certain circumstances.</li>
    <li><strong>Right to data portability (s.38):</strong> Receive your data in a structured, machine-readable format.</li>
    <li><strong>Right to object (s.39):</strong> Object to processing based on legitimate interests.</li>
    <li><strong>Right to withdraw consent:</strong> Where processing is based on consent, you may withdraw at any time without affecting the lawfulness of prior processing.</li>
</ul>

<p>
    To exercise any of these rights, email <a href="mailto:privacy@scentref.ng">privacy@scentref.ng</a>
    with the subject line "Data Subject Request". We will respond within <strong>30 days</strong> as
    required by NDPA 2023, s.40. We may ask you to verify your identity before processing your request.
</p>

<h3>Filing a Complaint with the NDPC</h3>
<p>
    If you are not satisfied with our response, you have the right to lodge a complaint with the
    <strong>Nigeria Data Protection Commission (NDPC)</strong>:
</p>
<ul>
    <li>Website: <a href="https://ndpc.gov.ng" target="_blank" rel="noopener noreferrer">ndpc.gov.ng</a></li>
    <li>Email: info@ndpc.gov.ng</li>
</ul>

<h2 id="transfers">8. International Data Transfers</h2>

<p>
    Our servers are located in data centres that may be outside Nigeria (including the United States
    and European Union). Where we transfer data internationally, we ensure appropriate safeguards are
    in place in accordance with NDPA 2023, s.43, including:
</p>
<ul>
    <li>Standard contractual clauses with service providers</li>
    <li>Use of processors in jurisdictions with adequate data protection laws</li>
</ul>

<h2 id="security">9. Security Measures</h2>
<ul>
    <li>All data in transit is encrypted using TLS 1.3</li>
    <li>Database access is restricted to application servers only (no public access)</li>
    <li>Passwords are hashed using bcrypt; we never store plaintext credentials</li>
    <li>Admin access requires two-factor authentication</li>
    <li>We conduct periodic security reviews and vulnerability assessments</li>
    <li>Email addresses in reviews are stored hashed for display (we show only initials)</li>
</ul>
<p>
    No method of transmission over the internet is 100% secure. While we apply industry-standard
    protections, we cannot guarantee absolute security and accept no liability for breaches beyond
    our reasonable control.
</p>

<h2 id="minors">10. Children's Privacy</h2>
<p>
    ScentRef.ng is not directed to children under 13 years of age. We do not knowingly collect
    personal data from children. If you believe we have inadvertently collected data from a child,
    please contact us at <a href="mailto:privacy@scentref.ng">privacy@scentref.ng</a> and we will
    delete it promptly.
</p>

<h2 id="cookies-ref">11. Cookies</h2>
<p>
    We use cookies and similar technologies to improve your experience. For full details, please
    read our <a href="{{ route('cookies') }}">Cookie Policy</a>.
</p>

<h2 id="changes-privacy">12. Changes to This Policy</h2>
<p>
    We may update this Privacy Policy from time to time. Material changes will be announced via a
    prominent notice on the homepage for at least 30 days. The "Last updated" date at the top of
    this page will always reflect the most recent revision. Continued use of the Service after
    changes constitutes acceptance.
</p>

<h2 id="contact-privacy">13. Contact & Data Protection Officer</h2>
<ul>
    <li><strong>General privacy enquiries:</strong> <a href="mailto:privacy@scentref.ng">privacy@scentref.ng</a></li>
    <li><strong>Data Subject Access Requests:</strong> <a href="mailto:privacy@scentref.ng">privacy@scentref.ng</a> (subject: "Data Subject Request")</li>
    <li><strong>Data Protection Officer:</strong> <a href="mailto:dpo@scentref.ng">dpo@scentref.ng</a></li>
</ul>

@endsection
