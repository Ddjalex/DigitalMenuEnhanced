# Professional Digital Menu with SMS Marketing

## Overview

This project delivers a **professionally enhanced digital restaurant menu** for Fuji Cafe, featuring modern animations, sophisticated design, and integrated customer SMS marketing capabilities. It transforms a basic PHP menu into a premium, visually stunning digital experience with VIP customer engagement features. Key capabilities include a professional admin dashboard with analytics, mobile navigation, social media integration, high-quality food imagery with animations, and a VIP club customer registration system for targeted SMS marketing campaigns. The project aims to provide a modern, interactive menu while enabling personalized customer communication to drive repeat business and enhance the dining experience.

## User Preferences

- **Communication style:** Simple, everyday language
- **Design focus:** Professional, modern, visually impressive animations
- **Target audience:** Restaurant customers viewing digital menus
- **Business goal:** Collect customer phone numbers for SMS marketing campaigns

## System Architecture

### Frontend

The frontend leverages **PHP 8.2** for server-side rendering, **Pure CSS3** for advanced animations, transforms, transitions, grid, and flexbox layouts, and **Vanilla JavaScript** for AJAX form submissions, smooth scrolling, and intersection observers. It incorporates **Google Fonts** (Playfair Display for headings, Inter for body text) and a professional color scheme of warm browns, cream backgrounds, and gold accents, defined via CSS custom properties. The design system features modular animation keyframes, a responsive grid layout, and error/success state animations.

### Backend

The backend integrates with a **MySQL database** to fetch categories and menu items, supporting a multi-tenant architecture and using prepared statements for security. It includes a robust **VIP Customer Management** system that uses AJAX for registration, validates 9-digit Ethiopian phone numbers (adding a `+251` prefix), detects duplicates, and stores data in a `vip_customers.json` file with file locking (`LOCK_EX`) for concurrency control. The system is designed for **Twilio SMS integration**.

### Data Storage

- **Production Menu:** MySQL database (`tenants`, `menu_categories`, `menu_items` tables, including an `image_url` field).
- **VIP Customers:** `vip_customers.json` file storing structured records (timestamp, name, phone, review, IP).

### Animation Features

The system incorporates a wide range of animations, including hero animations (gradient shift, fade-in), category animations (staggered fade-up, underline on hover), item animations (cascading waterfall, shimmer), image animations (lazy loading, zoom on hover), form animations (focus transitions, loading states), and micro-interactions (price scaling, button transforms). All animations are GPU-accelerated for performance.

## External Dependencies

### Third-party Services

-   **Google Fonts API**: Used for typography (Playfair Display, Inter).
-   **Unsplash**: Provides mock food images for the demo version.
-   **Twilio**: The system is ready for integration with Twilio for SMS marketing notifications.

### Browser Requirements

-   Modern browsers with support for CSS Grid, Flexbox, Custom Properties.
-   JavaScript enabled for AJAX submissions, smooth scroll, and intersection observers.
-   Fetch API support for form submissions.