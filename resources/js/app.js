// resources/js/app.js
import Alpine from "alpinejs";

// ── Filter Panel ─────────────────────────────────────────────────────
Alpine.data("filterPanel", () => ({
    loading: false,
    filters: {
        gender: null, price_min: null, price_max: null,
        sort: "rating", brand_ids: [], scent_family_ids: [],
        concentration: [], note_ids: [], longevity_min: null,
        availability: null, verdict: null,
    },

    async applyFilters() {
        this.loading = true;
        try {
            const res = await fetch("/perfume/filter", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    "Accept": "application/json",
                },
                body: JSON.stringify(this.filters),
            });
            if (!res.ok) throw new Error("Filter request failed");
            const data = await res.json();
            document.getElementById("perfume-grid").innerHTML = data.html;
            const count = document.getElementById("result-count");
            if (count) count.textContent = data.total;
            history.pushState({}, "", this.buildUrl());
        } catch (e) {
            console.error("Filter error:", e);
        } finally {
            this.loading = false;
        }
    },

    clearFilters() {
        this.filters = { gender:null,price_min:null,price_max:null,sort:"rating",
                         brand_ids:[],scent_family_ids:[],concentration:[],
                         note_ids:[],longevity_min:null,availability:null,verdict:null };
        this.applyFilters();
    },

    toggleGender(g) {
        this.filters.gender = this.filters.gender === g ? null : g;
    },

    buildUrl() {
        const params = new URLSearchParams();
        Object.entries(this.filters).forEach(([k, v]) => {
            if (v !== null && v !== "" && !(Array.isArray(v) && v.length === 0)) {
                if (Array.isArray(v)) v.forEach(item => params.append(k+"[]", item));
                else params.set(k, v);
            }
        });
        const qs = params.toString();
        return qs ? `/perfume?${qs}` : "/perfume";
    }
}));

// ── Review Form ───────────────────────────────────────────────────────
Alpine.data("reviewForm", (perfumeSlug) => ({
    rating: 0, hover: 0,
    submitted: false, success: false, message: "",
    form: {
        reviewer_name: "", reviewer_email: "", reviewer_city: "",
        reviewer_climate: "hot_outdoor", rating_overall: 0,
        rating_longevity: null, rating_sillage: null, rating_value: null,
        review_title: "", review_body: ""
    },

    setRating(r) { this.form.rating_overall = r; this.rating = r; },

    async submit() {
        this.submitted = true;
        try {
            const res = await fetch(`/perfume/${perfumeSlug}/reviews`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                    "Accept": "application/json",
                },
                body: JSON.stringify(this.form),
            });
            const data = await res.json();
            this.success = data.success;
            this.message = data.message;
        } catch (e) {
            this.success = false;
            this.message = "Something went wrong. Please try again.";
        }
    }
}));

// ── Price Alert Form ──────────────────────────────────────────────────
Alpine.data("priceAlert", (perfumeId) => ({
    email: "", targetPrice: "", submitted: false, message: "",

    async submit() {
        const res = await fetch("/price-alert", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                "Accept": "application/json",
            },
            body: JSON.stringify({ perfume_id: perfumeId, email: this.email, target_price: this.targetPrice }),
        });
        const data = await res.json();
        this.submitted = true;
        this.message = data.message;
    }
}));

window.Alpine = Alpine;
Alpine.start();

//
