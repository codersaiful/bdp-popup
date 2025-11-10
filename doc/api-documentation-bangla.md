# BDP Popup API ডকুমেন্টেশন

## ওভারভিউ

BDP Popup প্লাগইনের জন্য REST API ডকুমেন্টেশনে আপনাকে স্বাগতম। এই API এর মাধ্যমে আপনি প্রোগ্রাম্যাটিকভাবে আপনার পপআপ সেটিংস ম্যানেজ করতে পারবেন।

## বেস URL

```
https://your-site.com/wp-json/bdp-popup/v1
```

## অথেন্টিকেশন (Authentication)

সব API রিকোয়েস্টের জন্য API কী প্রয়োজন। আপনি দুইভাবে API কী পাঠাতে পারেন:

### অপশন ১: হেডার অথেন্টিকেশন (সুপারিশকৃত)

```bash
curl -X GET "https://your-site.com/wp-json/bdp-popup/v1/settings" \
  -H "X-API-Key: আপনার_API_কী"
```

### অপশন ২: কুয়েরি প্যারামিটার

```bash
curl -X GET "https://your-site.com/wp-json/bdp-popup/v1/settings?api_key=আপনার_API_কী"
```

## API কী জেনারেট করা

১. WordPress অ্যাডমিন প্যানেলে লগইন করুন
২. **Popup > API** মেনুতে যান
৩. **Generate New API Key** বাটনে ক্লিক করুন
৪. আপনার API কী কপি করুন এবং নিরাপদ স্থানে সংরক্ষণ করুন

**সতর্কতা:** নতুন কী জেনারেট করলে পুরাতন কী আর কাজ করবে না।

## এন্ডপয়েন্টস (Endpoints)

### ১. সকল সেটিংস দেখা

সকল প্লাগইন সেটিংস পেতে এই এন্ডপয়েন্ট ব্যবহার করুন।

**এন্ডপয়েন্ট:** `GET /settings`

**উদাহরণ রিকোয়েস্ট:**

```bash
curl -X GET "https://your-site.com/wp-json/bdp-popup/v1/settings" \
  -H "X-API-Key: আপনার_API_কী"
```

**সফল রেসপন্স (২০০ OK):**

```json
{
  "success": true,
  "data": {
    "title": "আপনার পপআপ টাইটেল",
    "message": "আপনার মেসেজ",
    "coupon": "DISCOUNT10",
    "browse_text": "ব্রাউজ করুন",
    "browse_link": "https://example.com",
    "visibility_all": "on",
    "popup_as_header": "on",
    "coupon_text": "কুপন",
    "coupon_visibility": "on"
  }
}
```

### ২. সকল সেটিংস আপডেট করা

সকল সেটিংস একসাথে আপডেট করতে এই এন্ডপয়েন্ট ব্যবহার করুন।

**এন্ডপয়েন্ট:** `POST /settings`

**উদাহরণ রিকোয়েস্ট:**

```bash
curl -X POST "https://your-site.com/wp-json/bdp-popup/v1/settings" \
  -H "X-API-Key: আপনার_API_কী" \
  -H "Content-Type: application/json" \
  -d '{
    "title": "নতুন পপআপ টাইটেল",
    "message": "নতুন মেসেজ",
    "coupon": "SAVE20"
  }'
```

**সফল রেসপন্স (২০০ OK):**

```json
{
  "success": true,
  "message": "Settings updated successfully",
  "data": {
    "title": "নতুন পপআপ টাইটেল",
    "message": "নতুন মেসেজ",
    "coupon": "SAVE20"
  }
}
```

### ৩. কন্টেন্ট সেটিংস দেখা

শুধুমাত্র কন্টেন্ট সেটিংস (টাইটেল, মেসেজ, কুপন ইত্যাদি) পেতে এই এন্ডপয়েন্ট ব্যবহার করুন।

**এন্ডপয়েন্ট:** `GET /content`

**উদাহরণ রিকোয়েস্ট:**

```bash
curl -X GET "https://your-site.com/wp-json/bdp-popup/v1/content" \
  -H "X-API-Key: আপনার_API_কী"
```

**সফল রেসপন্স (২০০ OK):**

```json
{
  "success": true,
  "data": {
    "title": "আপনার পপআপ টাইটেল",
    "message": "আপনার মেসেজ",
    "coupon": "DISCOUNT10",
    "browse_text": "ব্রাউজ করুন",
    "browse_link": "https://example.com",
    "popup_image": "https://example.com/image.png"
  }
}
```

### ৪. কন্টেন্ট সেটিংস আপডেট করা

কন্টেন্ট সেটিংস আপডেট করতে এই এন্ডপয়েন্ট ব্যবহার করুন।

**এন্ডপয়েন্ট:** `POST /content`

**ফিল্ডস:**
- `title` - পপআপ টাইটেল
- `message` - পপআপ মেসেজ
- `coupon` - কুপন কোড
- `browse_text` - ব্রাউজ বাটনের টেক্সট
- `browse_link` - ব্রাউজ লিংক URL
- `popup_image` - পপআপ ইমেজ URL

**উদাহরণ রিকোয়েস্ট:**

```bash
curl -X POST "https://your-site.com/wp-json/bdp-popup/v1/content" \
  -H "X-API-Key: আপনার_API_কী" \
  -H "Content-Type: application/json" \
  -d '{
    "title": "বিশেষ অফার!",
    "message": "আজই পান ২০% ছাড়",
    "coupon": "SAVE20",
    "browse_text": "এখনই কিনুন",
    "browse_link": "https://example.com/shop"
  }'
```

**সফল রেসপন্স (২০০ OK):**

```json
{
  "success": true,
  "message": "Content settings updated successfully",
  "data": {
    "title": "বিশেষ অফার!",
    "message": "আজই পান ২০% ছাড়",
    "coupon": "SAVE20",
    "browse_text": "এখনই কিনুন",
    "browse_link": "https://example.com/shop"
  }
}
```

### ৫. ইউনিভার্সাল সেটিংস দেখা

ইউনিভার্সাল সেটিংস (দৃশ্যমানতা, বন্ধের তারিখ ইত্যাদি) পেতে এই এন্ডপয়েন্ট ব্যবহার করুন।

**এন্ডপয়েন্ট:** `GET /universal`

**উদাহরণ রিকোয়েস্ট:**

```bash
curl -X GET "https://your-site.com/wp-json/bdp-popup/v1/universal" \
  -H "X-API-Key: আপনার_API_কী"
```

**সফল রেসপন্স (২০০ OK):**

```json
{
  "success": true,
  "data": {
    "visibility_all": "on",
    "closed_date": "2024-12-31",
    "cookie_expire_time": "600",
    "popup_as_header": "on",
    "popup_page_id": "7",
    "topbar_position": "top"
  }
}
```

### ৬. ইউনিভার্সাল সেটিংস আপডেট করা

ইউনিভার্সাল সেটিংস আপডেট করতে এই এন্ডপয়েন্ট ব্যবহার করুন।

**এন্ডপয়েন্ট:** `POST /universal`

**ফিল্ডস:**
- `visibility_all` - পপআপ ও হেডার দেখানো/লুকানো (`on` বা `off`)
- `closed_date` - পপআপ বন্ধের তারিখ (YYYY-MM-DD ফরম্যাটে)
- `cookie_expire_time` - কুকি এক্সপায়ার টাইম (সেকেন্ডে)
- `popup_as_header` - হেডার টপবার চালু/বন্ধ (`on` বা `off`)
- `popup_page_id` - নির্দিষ্ট পেজ আইডি
- `topbar_position` - হেডার পজিশন (`top` বা `bottom`)

**উদাহরণ রিকোয়েস্ট:**

```bash
curl -X POST "https://your-site.com/wp-json/bdp-popup/v1/universal" \
  -H "X-API-Key: আপনার_API_কী" \
  -H "Content-Type: application/json" \
  -d '{
    "visibility_all": "on",
    "popup_as_header": "on",
    "topbar_position": "top",
    "closed_date": "2024-12-31"
  }'
```

**সফল রেসপন্স (২০০ OK):**

```json
{
  "success": true,
  "message": "Universal settings updated successfully",
  "data": {
    "visibility_all": "on",
    "popup_as_header": "on",
    "topbar_position": "top",
    "closed_date": "2024-12-31"
  }
}
```

### ৭. কুপন সেটিংস দেখা

সাইডবার কুপন বাটনের সেটিংস পেতে এই এন্ডপয়েন্ট ব্যবহার করুন।

**এন্ডপয়েন্ট:** `GET /coupon`

**উদাহরণ রিকোয়েস্ট:**

```bash
curl -X GET "https://your-site.com/wp-json/bdp-popup/v1/coupon" \
  -H "X-API-Key: আপনার_API_কী"
```

**সফল রেসপন্স (২০০ OK):**

```json
{
  "success": true,
  "data": {
    "coupon_text": "কুপন",
    "coupon_visibility": "on",
    "coupon_page_link": "https://example.com/coupons"
  }
}
```

### ৮. কুপন সেটিংস আপডেট করা

সাইডবার কুপন বাটনের সেটিংস আপডেট করতে এই এন্ডপয়েন্ট ব্যবহার করুন।

**এন্ডপয়েন্ট:** `POST /coupon`

**ফিল্ডস:**
- `coupon_text` - কুপন বাটনের টেক্সট
- `coupon_visibility` - কুপন বাটন দেখানো/লুকানো (`on` বা `off`)
- `coupon_page_link` - কুপন পেজের লিংক

**উদাহরণ রিকোয়েস্ট:**

```bash
curl -X POST "https://your-site.com/wp-json/bdp-popup/v1/coupon" \
  -H "X-API-Key: আপনার_API_কী" \
  -H "Content-Type: application/json" \
  -d '{
    "coupon_text": "অফার পান",
    "coupon_visibility": "on",
    "coupon_page_link": "https://example.com/offers"
  }'
```

**সফল রেসপন্স (২০০ OK):**

```json
{
  "success": true,
  "message": "Coupon settings updated successfully",
  "data": {
    "coupon_text": "অফার পান",
    "coupon_visibility": "on",
    "coupon_page_link": "https://example.com/offers"
  }
}
```

## এরর রেসপন্স

### ৪০১ Unauthorized - API কী কনফিগার করা নেই

```json
{
  "code": "no_api_key",
  "message": "API key not configured",
  "data": {
    "status": 401
  }
}
```

### ৪০৩ Forbidden - ভুল API কী

```json
{
  "code": "invalid_api_key",
  "message": "Invalid API key",
  "data": {
    "status": 403
  }
}
```

### ৪০০ Bad Request - কোন ডেটা পাঠানো হয়নি

```json
{
  "code": "no_data",
  "message": "No data provided",
  "data": {
    "status": 400
  }
}
```

## প্রোগ্রামিং ল্যাঙ্গুয়েজ উদাহরণ

### PHP উদাহরণ

```php
<?php
$api_key = 'আপনার_API_কী';
$api_url = 'https://your-site.com/wp-json/bdp-popup/v1/content';

$data = array(
    'title' => 'নতুন টাইটেল',
    'message' => 'নতুন মেসেজ',
    'coupon' => 'SAVE20'
);

$args = array(
    'headers' => array(
        'X-API-Key' => $api_key,
        'Content-Type' => 'application/json',
    ),
    'body' => json_encode($data),
    'method' => 'POST'
);

$response = wp_remote_post($api_url, $args);

if (!is_wp_error($response)) {
    $body = wp_remote_retrieve_body($response);
    $result = json_decode($body, true);
    print_r($result);
}
?>
```

### JavaScript উদাহরণ

```javascript
const apiKey = 'আপনার_API_কী';
const apiUrl = 'https://your-site.com/wp-json/bdp-popup/v1/content';

const data = {
    title: 'নতুন টাইটেল',
    message: 'নতুন মেসেজ',
    coupon: 'SAVE20'
};

fetch(apiUrl, {
    method: 'POST',
    headers: {
        'X-API-Key': apiKey,
        'Content-Type': 'application/json'
    },
    body: JSON.stringify(data)
})
.then(response => response.json())
.then(result => console.log(result))
.catch(error => console.error('Error:', error));
```

### Python উদাহরণ

```python
import requests
import json

api_key = 'আপনার_API_কী'
api_url = 'https://your-site.com/wp-json/bdp-popup/v1/content'

headers = {
    'X-API-Key': api_key,
    'Content-Type': 'application/json'
}

data = {
    'title': 'নতুন টাইটেল',
    'message': 'নতুন মেসেজ',
    'coupon': 'SAVE20'
}

response = requests.post(api_url, headers=headers, data=json.dumps(data))
result = response.json()
print(result)
```

## সিকিউরিটি বেস্ট প্র্যাক্টিস

১. **API কী গোপন রাখুন:** আপনার API কী কখনো পাবলিক রিপোজিটরি বা ক্লায়েন্ট-সাইড কোডে শেয়ার করবেন না।

২. **HTTPS ব্যবহার করুন:** সব API রিকোয়েস্ট HTTPS এর মাধ্যমে পাঠান।

৩. **নিয়মিত কী পরিবর্তন করুন:** নিরাপত্তার জন্য নিয়মিত আপনার API কী পরিবর্তন করুন।

৪. **API লগ মনিটর করুন:** নিয়মিত API রিকোয়েস্ট লগ চেক করুন অস্বাভাবিক কার্যকলাপের জন্য।

## সাপোর্ট

যেকোনো সমস্যা বা প্রশ্নের জন্য আমাদের সাথে যোগাযোগ করুন।

**ইমেইল:** codersaiful@gmail.com  
**ওয়েবসাইট:** https://codeastrology.com
