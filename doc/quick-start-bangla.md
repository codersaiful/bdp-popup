# দ্রুত শুরু করার গাইড - BDP Popup API

## ভূমিকা

এই গাইড আপনাকে দেখাবে কিভাবে দ্রুত BDP Popup API ব্যবহার শুরু করবেন।

## ধাপ ১: API কী জেনারেট করুন

১. WordPress অ্যাডমিন প্যানেলে লগইন করুন
২. বাম পাশের মেনু থেকে **Popup** এ ক্লিক করুন
৩. **API** সাবমেনুতে ক্লিক করুন
৪. **Generate New API Key** বাটনে ক্লিক করুন
৫. আপনার API কী কপি করুন এবং নিরাপদ স্থানে সংরক্ষণ করুন

**গুরুত্বপূর্ণ:** এই কী অন্য কারো সাথে শেয়ার করবেন না।

## ধাপ ২: API বেস URL খুঁজে বের করুন

আপনার API বেস URL হবে:

```
https://your-domain.com/wp-json/bdp-popup/v1
```

`your-domain.com` এর জায়গায় আপনার ওয়েবসাইটের ডোমেইন বসান।

## ধাপ ৩: প্রথম API কল করুন

### উদাহরণ ১: সব সেটিংস দেখা (GET)

**cURL ব্যবহার করে:**

```bash
curl -X GET "https://your-domain.com/wp-json/bdp-popup/v1/settings" \
  -H "X-API-Key: YOUR_API_KEY_HERE"
```

**Postman ব্যবহার করে:**

১. নতুন একটি GET রিকোয়েস্ট তৈরি করুন
২. URL: `https://your-domain.com/wp-json/bdp-popup/v1/settings`
৩. Headers সেকশনে যান
৪. নতুন হেডার যোগ করুন: `X-API-Key` = `আপনার_API_কী`
৫. Send বাটনে ক্লিক করুন

### উদাহরণ ২: কন্টেন্ট আপডেট করা (POST)

**cURL ব্যবহার করে:**

```bash
curl -X POST "https://your-domain.com/wp-json/bdp-popup/v1/content" \
  -H "X-API-Key: YOUR_API_KEY_HERE" \
  -H "Content-Type: application/json" \
  -d '{
    "title": "বিশেষ অফার!",
    "message": "আজই পান ৩০% ছাড়",
    "coupon": "SAVE30"
  }'
```

**Postman ব্যবহার করে:**

১. নতুন একটি POST রিকোয়েস্ট তৈরি করুন
২. URL: `https://your-domain.com/wp-json/bdp-popup/v1/content`
৩. Headers সেকশনে:
   - `X-API-Key` = `আপনার_API_কী`
   - `Content-Type` = `application/json`
৪. Body সেকশনে যান এবং "raw" সিলেক্ট করুন
৫. JSON ডেটা লিখুন:
   ```json
   {
     "title": "বিশেষ অফার!",
     "message": "আজই পান ৩০% ছাড়",
     "coupon": "SAVE30"
   }
   ```
৬. Send বাটনে ক্লিক করুন

## ধাপ ৪: রেসপন্স চেক করুন

সফল রিকোয়েস্টের জন্য আপনি পাবেন:

```json
{
  "success": true,
  "message": "Content settings updated successfully",
  "data": {
    "title": "বিশেষ অফার!",
    "message": "আজই পান ৩০% ছাড়",
    "coupon": "SAVE30"
  }
}
```

## সাধারণ ব্যবহার কেস

### কেস ১: পপআপ টাইটেল পরিবর্তন করা

```bash
curl -X POST "https://your-domain.com/wp-json/bdp-popup/v1/content" \
  -H "X-API-Key: YOUR_API_KEY_HERE" \
  -H "Content-Type: application/json" \
  -d '{"title": "নতুন টাইটেল"}'
```

### কেস ২: কুপন কোড আপডেট করা

```bash
curl -X POST "https://your-domain.com/wp-json/bdp-popup/v1/content" \
  -H "X-API-Key: YOUR_API_KEY_HERE" \
  -H "Content-Type: application/json" \
  -d '{"coupon": "NEWYEAR2024"}'
```

### কেস ৩: পপআপ চালু/বন্ধ করা

```bash
curl -X POST "https://your-domain.com/wp-json/bdp-popup/v1/universal" \
  -H "X-API-Key: YOUR_API_KEY_HERE" \
  -H "Content-Type: application/json" \
  -d '{"visibility_all": "on"}'
```

চালু করতে: `"visibility_all": "on"`  
বন্ধ করতে: `"visibility_all": "off"`

### কেস ৪: হেডার পজিশন পরিবর্তন করা

```bash
curl -X POST "https://your-domain.com/wp-json/bdp-popup/v1/universal" \
  -H "X-API-Key: YOUR_API_KEY_HERE" \
  -H "Content-Type: application/json" \
  -d '{"topbar_position": "bottom"}'
```

উপরে: `"topbar_position": "top"`  
নিচে: `"topbar_position": "bottom"`

## এরর ট্রাবলশুটিং

### এরর: "Invalid API key"

**সমস্যা:** আপনার API কী ভুল অথবা এক্সপায়ার হয়ে গেছে।

**সমাধান:**
১. WordPress অ্যাডমিনে যান
২. Popup > API পেজে যান
৩. নতুন API কী জেনারেট করুন
৪. নতুন কী দিয়ে আবার চেষ্টা করুন

### এরর: "No data provided"

**সমস্যা:** POST রিকোয়েস্টে কোন ডেটা পাঠানো হয়নি।

**সমাধান:**
১. নিশ্চিত করুন যে আপনি JSON ফরম্যাটে ডেটা পাঠাচ্ছেন
২. `Content-Type: application/json` হেডার যোগ করুন
৩. Body তে সঠিক JSON ডেটা আছে কিনা চেক করুন

### এরর: "404 Not Found"

**সমস্যা:** ভুল URL বা এন্ডপয়েন্ট।

**সমাধান:**
১. URL সঠিক আছে কিনা চেক করুন
২. নিশ্চিত করুন যে WordPress এর permalink সেটিংস সঠিক আছে

## PHP দিয়ে ব্যবহার

যদি আপনি WordPress প্লাগইন বা থিম থেকে API ব্যবহার করতে চান:

```php
<?php
function bdp_update_popup_content() {
    $api_key = 'আপনার_API_কী';
    $api_url = get_site_url() . '/wp-json/bdp-popup/v1/content';
    
    $data = array(
        'title' => 'নতুন অফার!',
        'message' => 'এখনই অর্ডার করুন',
        'coupon' => 'FLASH50'
    );
    
    $response = wp_remote_post($api_url, array(
        'headers' => array(
            'X-API-Key' => $api_key,
            'Content-Type' => 'application/json'
        ),
        'body' => json_encode($data)
    ));
    
    if (!is_wp_error($response)) {
        $body = wp_remote_retrieve_body($response);
        $result = json_decode($body, true);
        
        if ($result['success']) {
            echo 'আপডেট সফল!';
        }
    }
}
?>
```

## পরবর্তী ধাপ

১. [সম্পূর্ণ API ডকুমেন্টেশন](api-documentation-bangla.md) পড়ুন
২. সব উপলব্ধ এন্ডপয়েন্ট এবং প্যারামিটার সম্পর্কে জানুন
৩. WordPress অ্যাডমিন প্যানেলের **Popup > API Docs** পেজ দেখুন

## সাপোর্ট

সাহায্যের জন্য যোগাযোগ করুন:
- ইমেইল: codersaiful@gmail.com
- ওয়েবসাইট: https://codeastrology.com
