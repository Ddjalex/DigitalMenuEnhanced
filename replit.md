# Professional Digital Menu with SMS Marketing

## Overview

This is a **professionally enhanced digital restaurant menu** for Fuji Cafe featuring modern animations, sophisticated design, food imagery, and integrated customer SMS marketing capabilities. The project transforms a basic PHP menu into a premium, visually stunning digital menu with VIP customer engagement features.

**Key Features:**
- **Mobile Navigation Menu** - Hamburger menu with smooth slide-in animation
- **Social Media Integration** - Admin-controlled Facebook, Instagram, and TikTok links
- **Neo Digital Solution Branding** - Footer with clickable logo and link
- Stunning food images with lazy loading and zoom animations
- VIP club customer registration for SMS marketing
- Beautiful animated hero header with gradient background
- Smooth scroll-triggered animations throughout
- Interactive hover effects with elevation and scaling
- Professional card-based layout with modern design
- Responsive mobile-first design
- Staggered entrance animations for menu items
- Category navigation with smooth scrolling
- Professional typography (Playfair Display + Inter fonts)
- Warm cafe color palette with CSS variables for easy customization
- Customer phone number collection for personalized lunch notifications

## User Preferences

- **Communication style:** Simple, everyday language
- **Design focus:** Professional, modern, visually impressive animations
- **Target audience:** Restaurant customers viewing digital menus
- **Business goal:** Collect customer phone numbers for SMS marketing campaigns

## System Architecture

### Frontend Architecture

**Technology Stack:**
- **PHP 8.2** - Server-side rendering
- **Pure CSS3** - Advanced animations, transforms, transitions, grid, flexbox
- **Vanilla JavaScript** - AJAX form submission, smooth scroll navigation, intersection observers
- **Google Fonts** - Playfair Display (headings) + Inter (body text)

**Design System:**
- CSS custom properties for colors, shadows, and gradients
- Modular animation keyframes (fadeIn, slideIn, pulse, imageReveal, etc.)
- Responsive grid layout with auto-fill (min 320px cards)
- Professional color scheme: Warm browns, cream backgrounds, gold accents
- Error and success state animations

### Backend Architecture

**Database Integration:**
- Original PHP backend queries preserved
- Multi-tenant architecture support
- Fetches categories and menu items from MySQL database
- Now includes `image_url` field for food images
- Prepared statements for security

**VIP Customer Management:**
- AJAX-powered customer registration
- Phone number validation (9-digit Ethiopian format)
- Automatic +251 country prefix addition
- Duplicate detection to prevent re-registration
- Data stored in JSON format (`vip_customers.json`)
- File locking (LOCK_EX) to prevent concurrent write issues
- Ready for Twilio SMS integration

**File Structure:**
```
/index.php                          # Main digital menu with animations
/login.php                          # Redirect to admin login
/save_vip_customer.php              # VIP customer registration backend
/schema.sql                         # Database schema documentation
/uploads/                           # Uploaded menu item images
/uploads/.htaccess                  # Security: prevent PHP execution
/admin/
  ├── index.php                     # Menu management with file upload
  ├── login.php                     # Admin authentication
  ├── logout.php                    # Session logout
  ├── orders.php                    # Order management
  ├── settings.php                  # Site settings (social media, contact)
  ├── change_password.php           # Password change functionality
  └── session.php                   # Session management
/vip_customers.json                 # Customer data storage
/menu_items.json                    # Menu items data
/orders.json                        # Orders data
/reviews.json                       # Rating/review data
/site_settings.json                 # Site configuration
/admin_users.json                   # Admin credentials
```

### Data Storage

- **Production Menu:** MySQL database with tables: `tenants`, `menu_categories`, `menu_items`
- **Demo Menu:** PHP arrays with sample menu data and Unsplash food images
- **VIP Customers:** JSON file with structured records (timestamp, name, phone, review, IP)

### Animation Features

1. **Hero Animations:** Gradient shift, floating patterns, fade-in effects
2. **Category Animations:** Staggered fade-up, underline on hover
3. **Item Animations:** Cascading waterfall effect, shimmer on hover
4. **Image Animations:** Lazy loading with reveal effect, zoom on hover
5. **Form Animations:** Focus transitions, loading states, success/error feedback
6. **Micro-interactions:** Price scaling, button transforms, scroll-to-top
7. **Performance:** GPU-accelerated (transform/opacity only)

## External Dependencies

### Third-party Services
- **Google Fonts API** - Typography (Playfair Display, Inter)
- **Unsplash** - Mock food images (demo version only)
- **Twilio** (ready for integration) - SMS marketing notifications

### Package Dependencies
- **PHP 8.2** - Server runtime
- No npm/composer dependencies required

### Browser Requirements
- Modern browsers with CSS Grid, Flexbox, Custom Properties support
- JavaScript enabled for AJAX submissions, smooth scroll, and intersection observers
- Fetch API support for form submissions

## SMS Marketing Integration

### Current Implementation
- Customer name and phone number collection
- Phone validation (9-digit format)
- Automatic country prefix (+251 for Ethiopia)
- Optional message/review field
- Duplicate detection
- Data stored in structured JSON format

### Integration Ready
The system collects and stores customer data in a format ready for SMS marketing platforms:
```json
{
  "timestamp": "2025-11-05 12:30:45",
  "name": "Customer Name",
  "phone": "+251912345678",
  "review": "Optional customer message",
  "ip_address": "127.0.0.1"
}
```

**Next Step:** Connect to Twilio using the Twilio connector (`connector:ccfg_twilio_01K69QJTED9YTJFE2SJ7E4SY08`) to send automated lunch notifications to registered VIP customers.

## Recent Changes

**November 5, 2025 - Final Updates:**
- **File Upload System:**
  - Changed admin menu item form from URL input to secure file upload
  - Server-side MIME type validation using finfo_file()
  - Whitelist validation for extensions (jpg, jpeg, png, gif, webp)
  - .htaccess protection in uploads directory to prevent PHP execution
  - Uploads stored in /uploads/ directory with unique filenames
  
- **Admin Security:**
  - Added change password functionality at /admin/change_password.php
  - Password validation (minimum 6 characters)
  - Current password verification before update
  - Secure password hashing with password_hash()
  - Admin credentials stored in admin_users.json
  
- **UI Improvements:**
  - Mobile menu resized: 260px desktop, 70% mobile (max 280px)
  - Cleaner, more professional mobile navigation
  - Footer branding updated to match reference design
  - Logo displayed first, followed by "Powered by Neo Digital Solution"
  
- **Documentation:**
  - Created comprehensive schema.sql file
  - Documents production MySQL/PostgreSQL database structure
  - Includes migration notes from JSON to database
  - Sample data and performance indexes included

**November 5, 2025 - Mobile Navigation & Branding Update:**
- **Mobile Navigation Menu:**
  - Hamburger menu button (fixed position, top-left)
  - Slide-in navigation drawer with smooth animations
  - Navigation links: Menu, Feedback, Contact Us, Review
  - Social media icons (Facebook, Instagram, TikTok)
  - Coffee house logo and branding in menu header
  - Overlay background blur when menu is open
  - Mobile-responsive design (85% width on mobile, max 320px)
  
- **Footer Enhancement:**
  - "Powered by Neo Digital Solution" section
  - Clickable Neo Digital Solution logo (attached_assets/neo_1762334562172.png)
  - Link to Neo Digital Solution website (https://neodigitalsolutions.com/)
  - Professional styling with hover effects
  
- **Admin Settings Panel:**
  - New admin/settings.php page for managing:
    - Social media URLs (Facebook, Instagram, TikTok)
    - Contact information (phone, email, address)
  - Settings stored in site_settings.json
  - Form validation and security (authentication required)
  - Settings automatically load on the public menu page
  
- **Navigation Integration:**
  - Added ⚙️ Settings link to admin dashboard navigation
  - Consistent navigation across admin pages (Menu, Orders, Settings)
  - Section anchors for smooth scrolling (#menu, #feedback, #reviews, #contact)

**November 5, 2025 - Complete System Overhaul:**
- **Order Management System:**
  - Added "Order Now" buttons to all available menu items
  - Implemented secure order processing with server-side price validation
  - Customer order form with name and phone number collection
  - Orders stored in JSON format with timestamps and status tracking
  - Admin can view, accept, or reject orders
  
- **5-Star Rating System:**
  - Interactive star rating for each menu item
  - Click-to-rate functionality
  - Average rating calculation and display
  - Review count display for each item
  - Reviews stored in structured JSON format
  
- **Complete Admin Dashboard:**
  - Secure login system (default: username: admin, password: password)
  - Session-based authentication
  - Full CRUD menu management (add, edit, delete items)
  - Order management interface with accept/reject functionality
  - Real-time order statistics (pending, accepted, rejected)
  - Professional responsive UI with gradient design
  
- **Data Management:**
  - Menu items loaded from JSON file (menu_items.json)
  - Dynamic category generation from menu items
  - Secure order processing (prices validated server-side)
  - File locking for concurrent write operations
  - All data stored in JSON format for easy management
  
- **Security Enhancements:**
  - Server-side price validation to prevent tampering
  - Item availability checking before order acceptance
  - Password hashing for admin accounts
  - Session management for admin authentication
  - Input sanitization and validation
  
**Previous Updates:**
- Added food images to all menu items with lazy loading
- Implemented VIP club customer registration system
- Created AJAX-powered form with error handling
- Added backend validation and data persistence
- Implemented phone number formatting (+251 prefix)
- Added duplicate customer detection
- Enhanced grid layout for menu items (responsive cards)
- Added image zoom animations on hover
- Implemented success and error state feedback
- Integrated Twilio-ready data structure for SMS marketing

**Previous Updates:**
- Enhanced digital menu with professional animations and modern design
- Added CSS custom properties for easy theme customization
- Implemented staggered entrance animations for menu items
- Created category navigation with smooth scroll functionality
- Added responsive design with mobile optimizations
- Integrated Google Fonts (Playfair Display + Inter)
- Set up PHP 8.2 development environment
- Configured PHP server workflow on port 5000

## Production Deployment Notes

### Database Requirements
Add `image_url` field to your `menu_items` table:
```sql
ALTER TABLE menu_items ADD COLUMN image_url VARCHAR(500) NULL;
```

### File Permissions
Ensure web server can write to the directory for `vip_customers.json`:
```bash
chmod 775 /path/to/project
```

### Admin Dashboard Integration
- Images can be uploaded and managed via admin dashboard
- The `image_url` field stores the path/URL to food images
- Mock images in demo can be replaced with actual food photography

### SMS Marketing Setup
1. Set up Twilio account and get API credentials
2. Use the Twilio connector integration in Replit
3. Create a scheduled script to read `vip_customers.json`
4. Send personalized lunch notifications at designated times
5. Track engagement and optimize message timing

## Next Phase Enhancements (Optional)

- Integrate Twilio API for automated lunch-time SMS notifications
- Add admin dashboard for viewing registered VIP customers
- Implement email marketing alongside SMS
- Add customer preferences (dietary restrictions, favorite categories)
- Create analytics dashboard for customer engagement
- Add `prefers-reduced-motion` media query for accessibility
- Additional breakpoint at 1024px for tablet/large screens
- High-resolution food photography with upload capability
- Dark mode toggle with theme transition
- Search and filter functionality
- Allergen information badges
- Print-friendly stylesheet
- Export customer data to CSV/Excel

---

**Status:** Production-ready digital menu with images, animations, and SMS marketing integration ✨🍽️📱
