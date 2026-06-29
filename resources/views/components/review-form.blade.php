@props(["perfume"])
<section class="bg-white rounded-xl border border-gray-100 p-6" x-data="reviewForm('{{ $perfume->slug }}')">
    <h2 class="font-display text-2xl font-bold text-ink mb-6">Write a Review</h2>
    <template x-if="!submitted">
        <div class="space-y-4">
            {{-- Star Rating --}}
            <div>
                <label class="text-sm font-semibold text-ink mb-2 block">Your Rating (1-10) *</label>
                <div class="flex gap-1">
                    <template x-for="i in 10">
                        <button @click="setRating(i)" @mouseenter="hover=i" @mouseleave="hover=0"
                                :class="i <= (hover || rating) ? 'text-gold' : 'text-gray-300'"
                                class="text-2xl leading-none focus:outline-none transition-colors"
                                x-text="'★'"></button>
                    </template>
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <input x-model="form.reviewer_name" type="text" placeholder="Your name *"
                       class="border rounded px-3 py-2 text-sm w-full focus:outline-none focus:ring-1 focus:ring-gold">
                <input x-model="form.reviewer_email" type="email" placeholder="Email (optional)"
                       class="border rounded px-3 py-2 text-sm w-full focus:outline-none focus:ring-1 focus:ring-gold">
                <input x-model="form.reviewer_city" type="text" placeholder="Your city"
                       class="border rounded px-3 py-2 text-sm w-full focus:outline-none focus:ring-1 focus:ring-gold">
                <select x-model="form.reviewer_climate"
                        class="border rounded px-3 py-2 text-sm w-full focus:outline-none focus:ring-1 focus:ring-gold">
                    <option value="hot_outdoor">Hot Outdoor (Lagos/PH)</option>
                    <option value="ac_office">AC Office</option>
                    <option value="cool_evening">Cool Evening</option>
                    <option value="harmattan">Harmattan Season</option>
                </select>
            </div>
            <input x-model="form.review_title" type="text" placeholder="Review title (optional)"
                   class="border rounded px-3 py-2 text-sm w-full focus:outline-none focus:ring-1 focus:ring-gold">
            <textarea x-model="form.review_body" rows="5" placeholder="Share your experience (min 50 characters) *"
                      class="border rounded px-3 py-2 text-sm w-full focus:outline-none focus:ring-1 focus:ring-gold resize-none"></textarea>
            <button @click="submit()" :disabled="!form.rating_overall || !form.reviewer_name || form.review_body.length < 50"
                    class="btn-primary disabled:opacity-40 disabled:cursor-not-allowed text-sm">
                Submit Review
            </button>
        </div>
    </template>
    <template x-if="submitted">
        <div class="text-center py-8">
            <p :class="success ? 'text-green-600' : 'text-red-600'" class="font-semibold" x-text="message"></p>
        </div>
    </template>
</section>
