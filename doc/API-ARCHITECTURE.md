# API Architecture Overview

```
BDP Popup Plugin
│
├── API System
│   │
│   ├── REST API Endpoints (bdp-popup/v1/)
│   │   ├── /settings          (GET, POST) - All settings
│   │   ├── /content           (GET, POST) - Content & Message
│   │   ├── /universal         (GET, POST) - Universal Settings
│   │   └── /coupon            (GET, POST) - Coupon Button
│   │
│   ├── Authentication
│   │   ├── API Key Generation
│   │   ├── Header: X-API-Key
│   │   └── Query: ?api_key=
│   │
│   └── Request Logging
│       ├── Last 100 requests
│       ├── Time, Method, Endpoint
│       ├── IP Address tracking
│       └── Status codes
│
├── Admin Interface
│   │
│   ├── Popup > API
│   │   ├── API Access Key section
│   │   ├── Generate/Copy key
│   │   ├── Available Endpoints
│   │   └── Recent API Requests (table)
│   │
│   └── Popup > API Docs
│       ├── Quick Start Guide
│       ├── Endpoint Reference
│       ├── Code Examples
│       └── Error Responses
│
└── Documentation (doc/)
    ├── api-documentation-bangla.md
    ├── quick-start-bangla.md
    ├── README-BANGLA.md
    ├── CHANGELOG-API.md
    └── IMPLEMENTATION-SUMMARY.md
```

## Request Flow

```
External Application
        │
        ├─── HTTP Request (GET/POST)
        │    └─── Header: X-API-Key: xxxxx
        │
        ▼
WordPress REST API
        │
        ├─── Route: /wp-json/bdp-popup/v1/{endpoint}
        │
        ▼
Api_Handler::check_permission()
        │
        ├─── Validate API Key
        │    ├─── Header check
        │    └─── Query param check
        │
        ▼
Api_Handler::{endpoint_method}()
        │
        ├─── Get/Update options
        ├─── Log request
        │    └─── Request_Logger::log_request()
        │
        ▼
WP_REST_Response
        │
        └─── JSON Response
             ├─── Success: {success: true, data: {...}}
             └─── Error: {code: "xxx", message: "xxx"}
```

## Data Flow

```
API Request
     │
     ▼
┌─────────────────────┐
│  Api_Handler        │
│  - check_permission │
│  - validate input   │
└─────────────────────┘
     │
     ▼
┌─────────────────────┐
│  WordPress Options  │
│  - get_option()     │
│  - update_option()  │
└─────────────────────┘
     │
     ▼
┌─────────────────────┐
│  Request_Logger     │
│  - log_request()    │
│  - store last 100   │
└─────────────────────┘
     │
     ▼
Response to Client
```

## Settings Structure

```
bdp_pop_options (WordPress Option)
│
├── Content Settings
│   ├── title
│   ├── message
│   ├── coupon
│   ├── browse_text
│   ├── browse_link
│   └── popup_image
│
├── Universal Settings
│   ├── visibility_all
│   ├── closed_date
│   ├── cookie_expire_time
│   ├── popup_as_header
│   ├── popup_page_id
│   └── topbar_position
│
└── Coupon Settings
    ├── coupon_text
    ├── coupon_visibility
    └── coupon_page_link
```

## Security Layers

```
┌──────────────────────────────────┐
│  1. API Key Authentication       │
│     - Stored in wp_options       │
│     - Required for all requests  │
└──────────────────────────────────┘
           │
           ▼
┌──────────────────────────────────┐
│  2. WordPress Nonce              │
│     - Admin forms only           │
│     - CSRF protection            │
└──────────────────────────────────┘
           │
           ▼
┌──────────────────────────────────┐
│  3. Input Sanitization           │
│     - sanitize_text_field()      │
│     - esc_* functions            │
└──────────────────────────────────┘
           │
           ▼
┌──────────────────────────────────┐
│  4. Request Logging              │
│     - IP tracking                │
│     - Status monitoring          │
└──────────────────────────────────┘
```

## File Organization

```
bdp-popup/
│
├── api/                          (NEW FOLDER)
│   ├── api-handler.php          ← REST API routes & handlers
│   └── request-logger.php       ← Request logging system
│
├── admin/
│   ├── page-loader.php          ← Updated: Added API menu
│   └── page/
│       ├── api-settings.php     ← NEW: API management page
│       ├── api-docs.php         ← NEW: API documentation page
│       ├── api-data.php.old     ← DEPRECATED
│       ├── main-page.php        ← Updated: Removed old API
│       ├── universal-settings.php ← Updated: Removed api_site_bool
│       └── coupon-button.php    ← Updated: Removed api_site_bool
│
├── frontend/
│   ├── frontend-loader.php      ← Updated: Removed old API
│   └── api.php.old             ← DEPRECATED
│
├── doc/                          (NEW FOLDER)
│   ├── api-documentation-bangla.md  ← Complete API docs
│   ├── quick-start-bangla.md        ← Quick start guide
│   ├── README-BANGLA.md             ← Overview
│   ├── CHANGELOG-API.md             ← Change log
│   └── IMPLEMENTATION-SUMMARY.md    ← This summary
│
└── init.php                      ← Updated: Initialize API
```

## Integration Examples

### PHP (WordPress)
```php
$response = wp_remote_post(rest_url('bdp-popup/v1/content'), [
    'headers' => ['X-API-Key' => $api_key],
    'body' => json_encode(['title' => 'New Title'])
]);
```

### JavaScript (Fetch)
```javascript
fetch('/wp-json/bdp-popup/v1/content', {
    method: 'POST',
    headers: {
        'X-API-Key': apiKey,
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({title: 'New Title'})
});
```

### cURL (Command Line)
```bash
curl -X POST "https://site.com/wp-json/bdp-popup/v1/content" \
  -H "X-API-Key: xxx" \
  -H "Content-Type: application/json" \
  -d '{"title":"New Title"}'
```

## Monitoring & Logging

The admin can monitor all API activity through:
- **Admin Page**: Popup > API
- **Recent Requests Table**:
  - Time (timestamp)
  - Method (GET/POST)
  - Endpoint (full route)
  - IP Address
  - Status (200, 400, 403, etc.)
- **Clear Logs**: Remove all logged requests

## Version Information

- **Implementation Date**: November 10, 2025
- **Plugin Version**: 1.0.6.0
- **API Version**: v1
- **Namespace**: bdp-popup/v1
