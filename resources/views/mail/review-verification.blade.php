{{-- resources/views/mail/review-verification.blade.php --}}
<x-mail::message>
# Verify Your Review

Hi {{ $review->reviewer_name }},

Thank you for reviewing **{{ $perfumeName }}** by {{ $brandName }} on ScentRef.ng — Nigeria's fragrance reference.

To publish your review, please click the button below to confirm your email address.
Your review will appear on the site after editorial approval (usually within 24 hours).

<x-mail::button :url="$verificationUrl" color="primary">
Verify My Review
</x-mail::button>

**Your review summary:**
- **Perfume:** {{ $perfumeName }} by {{ $brandName }}
- **Your rating:** {{ $review->rating_overall }}/10
@if($review->review_title)
- **Title:** {{ $review->review_title }}
@endif

This link expires in **48 hours**. If you didn't submit a review on ScentRef.ng, you can ignore this email.

Thanks,
**The ScentRef Team**

<x-mail::subcopy>
If the button doesn't work, copy and paste this link into your browser:
{{ $verificationUrl }}
</x-mail::subcopy>
</x-mail::message>
