# BDP Popup API - README

## সংক্ষিপ্ত বিবরণ

BDP Popup প্লাগইন এখন একটি শক্তিশালী REST API এর সাথে আসে যা আপনাকে প্রোগ্রাম্যাটিকভাবে পপআপ সেটিংস পরিচালনা করতে দেয়।

## নতুন ফিচার

### ১. API Access Key Management
- WordPress অ্যাডমিন প্যানেল থেকে সহজেই API কী জেনারেট করুন
- নিরাপদ অথেন্টিকেশন সিস্টেম
- যেকোনো সময় নতুন কী জেনারেট করার সুবিধা

### ২. REST API Endpoints
আপনি তিনটি প্রধান সেকশনের ডেটা পরিচালনা করতে পারবেন:

- **Content & Message**: টাইটেল, মেসেজ, কুপন কোড, ব্রাউজ লিংক ইত্যাদি
- **Settings (Universal)**: দৃশ্যমানতা, বন্ধের তারিখ, হেডার সেটিংস ইত্যাদি
- **Sidebar Coupon Button**: কুপন বাটন টেক্সট, দৃশ্যমানতা, পেজ লিংক ইত্যাদি

### ৩. API Request Logging
- সর্বশেষ ১০০টি API রিকোয়েস্টের লগ দেখুন
- Time, Method, Endpoint, IP Address, Status সহ বিস্তারিত তথ্য
- অ্যাডমিন প্যানেল থেকে সরাসরি মনিটর করুন

### ৪. সম্পূর্ণ বাংলা ডকুমেন্টেশন
- `doc` ফোল্ডারে সম্পূর্ণ বাংলা ডকুমেন্টেশন পাবেন
- দ্রুত শুরু করার গাইড
- বিস্তারিত API রেফারেন্স
- কোড উদাহরণ (PHP, JavaScript, Python)

## কিভাবে শুরু করবেন

### ধাপ ১: API কী জেনারেট করুন
1. WordPress অ্যাডমিনে লগইন করুন
2. **Popup > API** মেনুতে যান
3. **Generate New API Key** বাটনে ক্লিক করুন
4. কী কপি করে সংরক্ষণ করুন

### ধাপ ২: API Endpoint ব্যবহার করুন

**বেস URL:**
```
https://your-site.com/wp-json/bdp-popup/v1
```

**উদাহরণ - কন্টেন্ট আপডেট করা:**
```bash
curl -X POST "https://your-site.com/wp-json/bdp-popup/v1/content" \
  -H "X-API-Key: YOUR_API_KEY" \
  -H "Content-Type: application/json" \
  -d '{
    "title": "বিশেষ অফার!",
    "message": "আজই পান ৩০% ছাড়",
    "coupon": "SAVE30"
  }'
```

## উপলব্ধ Endpoints

| Method | Endpoint | বিবরণ |
|--------|----------|-------|
| GET | `/settings` | সকল সেটিংস দেখা |
| POST | `/settings` | সকল সেটিংস আপডেট |
| GET | `/content` | কন্টেন্ট সেটিংস দেখা |
| POST | `/content` | কন্টেন্ট সেটিংস আপডেট |
| GET | `/universal` | ইউনিভার্সাল সেটিংস দেখা |
| POST | `/universal` | ইউনিভার্সাল সেটিংস আপডেট |
| GET | `/coupon` | কুপন সেটিংস দেখা |
| POST | `/coupon` | কুপন সেটিংস আপডেট |

## ডকুমেন্টেশন

বিস্তারিত ডকুমেন্টেশনের জন্য দেখুন:

1. **Quick Start Guide**: `doc/quick-start-bangla.md`
2. **Full API Documentation**: `doc/api-documentation-bangla.md`
3. **WordPress Admin**: Popup > API Docs

## API ব্যবহারের উদাহরণ

### PHP
```php
<?php
$api_key = 'your_api_key';
$response = wp_remote_post('https://your-site.com/wp-json/bdp-popup/v1/content', [
    'headers' => [
        'X-API-Key' => $api_key,
        'Content-Type' => 'application/json'
    ],
    'body' => json_encode([
        'title' => 'নতুন অফার',
        'coupon' => 'SALE50'
    ])
]);
?>
```

### JavaScript
```javascript
fetch('https://your-site.com/wp-json/bdp-popup/v1/content', {
    method: 'POST',
    headers: {
        'X-API-Key': 'your_api_key',
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({
        title: 'নতুন অফার',
        coupon: 'SALE50'
    })
});
```

## নিরাপত্তা

- সব রিকোয়েস্ট API কী দিয়ে সুরক্ষিত
- HTTPS ব্যবহার করুন
- API কী কখনো পাবলিকলি শেয়ার করবেন না
- নিয়মিত API রিকোয়েস্ট লগ চেক করুন

## পরিবর্তনসমূহ

### পুরাতন API সিস্টেম রিমুভ করা হয়েছে
- `api_site_url` ফিল্ড রিমুভ করা হয়েছে
- `api_access_token` ফিল্ড রিমুভ করা হয়েছে
- রিমোট সাইট থেকে ডেটা পুল করার ফিচার রিমুভ করা হয়েছে

### নতুন API সিস্টেম যুক্ত করা হয়েছে
- নতুন REST API এন্ডপয়েন্টস
- API Access Key ম্যানেজমেন্ট
- API রিকোয়েস্ট লগিং
- সম্পূর্ণ বাংলা ডকুমেন্টেশন

## সাপোর্ট

কোনো সমস্যা বা প্রশ্নের জন্য যোগাযোগ করুন:

- **ইমেইল**: codersaiful@gmail.com
- **ওয়েবসাইট**: https://codeastrology.com

## লাইসেন্স

এই প্লাগইন GPL v2 বা পরবর্তী লাইসেন্সের অধীনে প্রকাশিত।
