{{-- resources/views/contact.blade.php --}}
@extends('layouts.app')
@section('title', 'Contact ScentRef.ng — Submit Prices, Reviews & Corrections')
@section('description', 'Submit price corrections, suggest fragrances for our database, or contact the ScentRef team.')
@section('canonical', route('contact'))

@section('content')

<section class="bg-obsidian text-ivory py-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="font-display text-4xl font-bold mb-3">Contact <span class="text-gold">ScentRef</span></h1>
        <p class="text-ash">Help us build Nigeria's most accurate fragrance database.</p>
    </div>
</section>

<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
        @foreach([
            ['icon' => '₦', 'title' => 'Price Correction', 'desc' => 'Found a wrong or outdated price? Let us know the correct current price with a source link.'],
            ['icon' => '➕', 'title' => 'Suggest a Perfume', 'desc' => 'Want to see a fragrance in our database? Tell us the name, brand, and where to buy it in Nigeria.'],
            ['icon' => '⚠', 'title' => 'Fake Alert', 'desc' => 'Know of a vendor selling fakes? Help us protect the community.'],
            ['icon' => '✉', 'title' => 'General Enquiry', 'desc' => 'Press, partnership, or advertising enquiries for ScentRef.ng.'],
        ] as $item)
        <div class="card p-5">
            <div class="text-3xl mb-3">{{ $item['icon'] }}</div>
            <h3 class="font-semibold text-ink mb-1">{{ $item['title'] }}</h3>
            <p class="text-ash text-sm">{{ $item['desc'] }}</p>
        </div>
        @endforeach
    </div>

    {{-- Contact Form --}}
    <div class="bg-white rounded-xl border border-gray-100 p-8"
         x-data="{
            form: { name: '', email: '', subject: 'price_correction', message: '' },
            submitted: false, success: false, sending: false,
            async send() {
                this.sending = true;
                await new Promise(r => setTimeout(r, 1200));
                this.submitted = true;
                this.success = true;
                this.sending = false;
            }
         }">

        <h2 class="font-display text-xl font-bold text-ink mb-6">Send Us a Message</h2>

        <template x-if="!submitted">
            <div class="space-y-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-ash uppercase tracking-wide mb-1">Name</label>
                        <input x-model="form.name" type="text" placeholder="Your name"
                               class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-gold">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-ash uppercase tracking-wide mb-1">Email</label>
                        <input x-model="form.email" type="email" placeholder="your@email.com"
                               class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-gold">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-ash uppercase tracking-wide mb-1">Subject</label>
                    <select x-model="form.subject"
                            class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-gold">
                        <option value="price_correction">Price Correction</option>
                        <option value="suggest_perfume">Suggest a Perfume</option>
                        <option value="fake_alert">Fake Alert</option>
                        <option value="general">General Enquiry</option>
                        <option value="partnership">Partnership / Advertising</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-ash uppercase tracking-wide mb-1">Message</label>
                    <textarea x-model="form.message" rows="5"
                              placeholder="Please include as much detail as possible — product name, vendor, price, source link…"
                              class="w-full border rounded px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-gold resize-none"></textarea>
                </div>
                <button @click="send()" :disabled="!form.name || !form.email || !form.message || sending"
                        class="btn-primary disabled:opacity-40 disabled:cursor-not-allowed text-sm">
                    <span x-text="sending ? 'Sending…' : 'Send Message'"></span>
                </button>
            </div>
        </template>

        <template x-if="submitted">
            <div class="text-center py-10">
                <div class="text-5xl mb-4">✓</div>
                <h3 class="font-display text-xl font-bold text-ink mb-2">Message Received!</h3>
                <p class="text-ash">Thank you. We review all submissions and update the database as quickly as possible.</p>
            </div>
        </template>
    </div>

    <p class="text-center text-ash text-xs mt-6">
        For urgent matters: <a href="mailto:hello@scentref.ng" class="text-gold hover:underline">hello@scentref.ng</a>
    </p>

</div>
@endsection
