# ⚡ FastLoader: Surgical Asset Management for WordPress

[![WordPress Plugin](https://img.shields.io/badge/WordPress-Plugin-blue.svg)](https://wordpress.org/plugins/)
[![License](https://img.shields.io/badge/License-GPL%20v2-orange.svg)](LICENSE.txt)
[![Performance](https://img.shields.io/badge/Performance-Zero%20Bloat-green.svg)](#)

**FastLoader** is a lightweight, high-performance WordPress plugin designed to eliminate plugin bloat. Surgically disable specific CSS and JS files on a per-page basis to boost PageSpeed scores and master your Core Web Vitals.

---

## 🚀 Key Features

- **🔍 Real-time Asset Scanner:** Detect active script and style handles directly from your frontend Admin Bar. No more guessing handles in the source code.
- **🎯 Per-Page Precision:** Disable assets individually for every Post or Page. No global settings that break your site.
- **🛡️ Safety First:** Built-in protection for core dependencies like jQuery and the WordPress Admin Bar.
- **🍃 Zero Bloat Policy:** Native WordPress hooks and lightweight JavaScript. No external APIs, no heavy libraries, and no database clutter.
- **📋 Click-to-Copy:** One-click handle copying from our modern glassmorphism scanner modal.

---

## 🛠️ How It Works

Many WordPress plugins load their scripts and styles on every single page, even where they aren't used. This adds unnecessary HTTP requests and increases blocking time.

**FastLoader** gives you a "Kill Switch" for these assets:
1. **Scan:** Click "Scan Assets" in your Admin Bar while viewing any page.
2. **Identify:** See exactly what is loading and copy the handle (e.g., `contact-form-7`).
3. **Block:** Paste the handle into the FastLoader Meta Box on the Edit Page screen.
4. **Win:** Refresh and watch your PageSpeed scores climb.

---

## 💻 Installation

1. Download the latest release.
2. Upload the `fastloader` folder to your `/wp-content/plugins/` directory.
3. Activate the plugin via the **Plugins** menu in WordPress.
4. Navigate to any page on your site and start optimizing!

---

## 🔒 Security & Standards

- **Full Prefixing:** 100% compliant with WordPress.org namespace standards.
- **Data Integrity:** All inputs are sanitized using `sanitize_textarea_field` and `wp_unslash`.
- **Nonce Verification:** Every save operation is protected by WordPress security nonces.
- **Privacy:** FastLoader does not collect user data or use external tracking.

---

## 👨‍💻 Developer

Developed by **Sakib MD Nazmush**. 
Check out my other projects on [GitHub](https://github.com/nazsakib) or visit my [landing page](https://lightmaintenance.site).

---

## 📜 License

This project is licensed under the GPLv2 or later.
