{{-- resources/views/legal/cookies.blade.php --}}
@extends('layouts.legal')

@section('breadcrumb', 'Cookie Policy')
@section('heading', 'Cookie Policy')
@section('subheading', 'Last updated: ' . ($lastUpdated ?? '1 June 2025'))

@section('toc')
<a href="#what-are-cookies"  class="block py-0.5 hover:text-gold transition-colors">1. What Are Cookies</a>
<a href="#why-we-use"        class="block py-0.5 hover:text-gold transition-colors">2. Why We Use Them</a>
<a href="#essential"         class="block py-0.5 hover:text-gold transition-colors">3. Essential Cookies</a>
<a href="#analytics"         class="block py-0.5 hover:text-gold transition-colors">4. Analytics Cookies</a>
<a href="#third-party-ck"    class="block py-0.5 hover:text-gold transition-colors">5. Third-Party Cookies</a>
<a href="#manage"            class="block py-0.5 hover:text-gold transition-colors">6. Managing Cookies</a>
<a href="#consent-ck"        class="block py-0.5 hover:text-gold transition-colors">7. Your Consent</a>
<a href="#contact-ck"        class="block py-0.5 hover:text-gold transition-colors">8. Contact</a>
@endsection

@section('legal-content')

<p>
    This Cookie Policy explains how <strong>ScentRef.ng</strong> uses cookies and similar tracking
    technologies when you visit our website. It should be read alongside our
    <a href="{{ route('privacy') }}">Privacy Policy</a>, which provides broader information about how
    we process your personal data.
</p>

<h2 id="what-are-cookies">1. What Are Cookies?</h2>

<p>
    Cookies are small text files that are placed on your device (computer, smartphone, or tablet)
    when you visit a website. They are widely used to make websites work efficiently, remember your
    preferences, and provide information to website owners about how their site is used.
</p>
<p>
    Cookies are set either by the website you are visiting ("first-party cookies") or by third-party
    services running on that website ("third-party cookies"). Cookies can be "session cookies" which
    expire when you close your browser, or "persistent cookies" which remain on your device for a
    set period or until you delete them.
</p>

<h2 id="why-we-use">2. Why We Use Cookies</h2>

<p>ScentRef.ng uses cookies for three primary purposes:</p>
<ul>
    <li><strong>Essential operation</strong> — cookies that are strictly necessary for the site to function (e.g. security tokens, session management)</li>
    <li><strong>Performance and analytics</strong> — cookies that help us understand how visitors use the site so we can improve it</li>
    <li><strong>Preferences</strong> — cookies that remember your choices (e.g. cookie consent preferences)</li>
</ul>
<p>
    We do <strong>not</strong> use cookies for targeted advertising or retargeting. We do not sell
    cookie data or share it with advertising networks.
</p>

<h2 id="essential">3. Essential Cookies</h2>

<p>
    These cookies are strictly necessary for the website to function and cannot be disabled.
    They do not store any personally identifiable information and do not require your consent
    under Nigerian law.
</p>

<div class="not-prose overflow-x-auto">
<table class="w-full text-sm border-collapse min-w-[600px]">
    <thead>
        <tr class="bg-obsidian text-ivory">
            <th class="text-left p-3">Cookie Name</th>
            <th class="text-left p-3">Provider</th>
            <th class="text-left p-3">Purpose</th>
            <th class="text-left p-3">Expiry</th>
        </tr>
    </thead>
    <tbody>
        @foreach([
            ['XSRF-TOKEN',              'ScentRef.ng', 'Cross-site request forgery protection. Ensures form submissions originate from our site.', 'Session'],
            ['scentref_session',        'ScentRef.ng', 'Maintains your session state across page loads (e.g. flash messages after form submission).', 'Session (2 hours)'],
            ['scentref_cookie_consent', 'ScentRef.ng', 'Stores your cookie consent preferences so we do not show the banner on every visit.', '12 months'],
        ] as [$name, $provider, $purpose, $expiry])
        <tr class="border-b border-gray-100">
            <td class="p-3 font-mono text-xs text-ink">{{ $name }}</td>
            <td class="p-3 text-ash text-xs">{{ $provider }}</td>
            <td class="p-3 text-ash text-xs">{{ $purpose }}</td>
            <td class="p-3 text-ash text-xs whitespace-nowrap">{{ $expiry }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

<h2 id="analytics">4. Analytics Cookies</h2>

<p>
    These cookies help us understand how visitors interact with our website by collecting and
    reporting information anonymously. They require your consent and are only activated after
    you accept analytics cookies via our cookie banner.
</p>

<div class="not-prose overflow-x-auto">
<table class="w-full text-sm border-collapse min-w-[600px]">
    <thead>
        <tr class="bg-obsidian text-ivory">
            <th class="text-left p-3">Cookie Name</th>
            <th class="text-left p-3">Provider</th>
            <th class="text-left p-3">Purpose</th>
            <th class="text-left p-3">Expiry</th>
        </tr>
    </thead>
    <tbody>
        @foreach([
            ['_ga',       'Google Analytics', 'Distinguishes unique users. IP anonymisation is enabled — your full IP is never stored.', '2 years'],
            ['_ga_*',     'Google Analytics', 'Stores and counts pageviews for a specific Google Analytics property.', '2 years'],
            ['_gid',      'Google Analytics', 'Distinguishes users across sessions.', '24 hours'],
            ['_gat_gtag', 'Google Analytics', 'Throttles request rate to Google Analytics servers.', '1 minute'],
        ] as [$name, $provider, $purpose, $expiry])
        <tr class="border-b border-gray-100">
            <td class="p-3 font-mono text-xs text-ink">{{ $name }}</td>
            <td class="p-3 text-ash text-xs">{{ $provider }}</td>
            <td class="p-3 text-ash text-xs">{{ $purpose }}</td>
            <td class="p-3 text-ash text-xs whitespace-nowrap">{{ $expiry }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>

<div class="bg-gold/10 border border-gold/30 rounded-xl p-4 not-prose mt-4">
    <p class="text-sm text-ash">
        <strong class="text-ink">Note on Google Analytics:</strong> We use Google Analytics 4 with
        IP anonymisation enabled, meaning your full IP address is never sent to Google. Data is
        processed under Google's data processing terms. You can opt out at any time using
        <a href="https://tools.google.com/dlpage/gaoptout" target="_blank" rel="noopener noreferrer"
           class="text-gold hover:underline">Google's opt-out browser add-on</a>.
    </p>
</div>

<h2 id="third-party-ck">5. Third-Party Cookies</h2>

<p>
    Some content embedded on our site — such as social sharing buttons — may place cookies from
    their respective services. We do not control these cookies and recommend reading the privacy
    policies of the relevant services:
</p>
<ul>
    <li><strong>Cloudflare</strong> — CDN and security. May set <code>__cf_bm</code> (bot management, session). See <a href="https://www.cloudflare.com/privacypolicy/" target="_blank" rel="noopener noreferrer">Cloudflare's Privacy Policy</a>.</li>
</ul>
<p>
    We do not embed YouTube videos, Facebook pixels, Twitter widgets, or advertising networks.
    This minimises your exposure to third-party tracking.
</p>

<h2 id="manage">6. Managing and Disabling Cookies</h2>

<h3>Browser Settings</h3>
<p>
    You can control cookies through your browser settings. Most browsers allow you to:
</p>
<ul>
    <li>View and delete individual cookies</li>
    <li>Block cookies from specific websites</li>
    <li>Block all third-party cookies</li>
    <li>Block all cookies (note: this may break essential site functionality)</li>
</ul>
<p>Instructions for popular browsers:</p>
<ul>
    <li><a href="https://support.google.com/chrome/answer/95647" target="_blank" rel="noopener noreferrer">Google Chrome</a></li>
    <li><a href="https://support.mozilla.org/en-US/kb/cookies-information-websites-store-on-your-computer" target="_blank" rel="noopener noreferrer">Mozilla Firefox</a></li>
    <li><a href="https://support.apple.com/guide/safari/manage-cookies-sfri11471/mac" target="_blank" rel="noopener noreferrer">Apple Safari</a></li>
    <li><a href="https://support.microsoft.com/en-us/microsoft-edge/delete-cookies-in-microsoft-edge-63947406-40ac-c3b8-57b9-2a946a29ae09" target="_blank" rel="noopener noreferrer">Microsoft Edge</a></li>
</ul>

<h3>Our Cookie Preference Centre</h3>
<p>
    You can update your cookie preferences at any time by clicking the "Cookie Settings" link in
    our website footer. This will reopen the cookie consent banner and allow you to change your
    preferences. Note that disabling analytics cookies does not affect your ability to use the site.
</p>

<h2 id="consent-ck">7. Your Consent</h2>

<p>
    When you first visit ScentRef.ng, we display a cookie consent banner. By clicking
    <strong>"Accept All"</strong>, you consent to essential and analytics cookies.
    By clicking <strong>"Essential Only"</strong>, we will only set the cookies strictly necessary
    for the site to function.
</p>
<p>
    Your consent is stored for 12 months in the <code>scentref_cookie_consent</code> cookie.
    You may withdraw your consent at any time by clicking "Cookie Settings" in the footer.
</p>
<p>
    Under the Nigeria Data Protection Act 2023, consent must be freely given, specific, informed,
    and unambiguous. Refusing analytics cookies has no adverse effect on your use of the site.
</p>

<h2 id="contact-ck">8. Contact Us</h2>
<p>
    If you have questions about our use of cookies, please contact:
    <a href="mailto:privacy@scentref.ng">privacy@scentref.ng</a>
</p>

@endsection
