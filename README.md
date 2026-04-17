# ⚡ Smart Asset Optimizer for Fast Loading 🚀

[![WordPress Plugin](https://img.shields.io/badge/WordPress-Plugin-blue.svg)](https://wordpress.org/plugins/)
[![License](https://img.shields.io/badge/License-GPL%20v2-orange.svg)](LICENSE.txt)
[![Performance](https://img.shields.io/badge/Performance-Zero%20Bloat-green.svg)](#)
[![SEO Optimized](https://img.shields.io/badge/SEO-Optimized-brightgreen.svg)](#)

**Smart Asset Optimizer for Fast Loading** is a high-performance WordPress plugin designed to eliminate the #1 cause of slow websites: **Plugin Bloat**.

## The Problem
Most WordPress plugins load their JavaScript and CSS on **every single page** of your site, even if that page doesn't use the plugin's features. This results in:
- Excessive HTTP requests.
- Bloated page sizes.
- Slower "Core Web Vitals" (LCP, TBT).
- Lower SEO rankings.

## The Solution
Smart Asset Optimizer gives you a surgical **"Kill Switch"** for assets. With a built-in frontend scanner and a per-page management system, you can choose exactly what code runs on every post or page.

---

## 🚀 Key Features

### 🔍 Real-Time Asset Scanner
Identify every script and style handle running on your frontend directly from the WordPress Admin Bar. The glassmorphic UI makes it easy to spot and copy handles in seconds.

### 🎯 Per-Page Precision
No more global settings that break your site. Disable assets selectively on a page-by-page basis to ensure maximum compatibility.

### 🛡️ Safety Guard
The plugin automatically prevents you from disabling core WordPress dependencies (like `jquery` or `admin-bar`) while you are logged in, ensuring you never lock yourself out.

### ⚡ Ultra-Lightweight
Built with performance in mind. The plugin has zero external dependencies and a footprint of less than 20KB.

---

## 🛠️ Installation

1. Clone or download this repository into your `/wp-content/plugins/` directory.
2. Rename the folder to `smart-asset-optimizer-fast-loading`.
3. Activate the plugin in the WordPress Dashboard.

---

## 📖 How to Use

1. **Scan:** Visit the frontend of any page. Click **Scan Assets** in the top Admin Bar.
2. **Copy:** Identify the handles you don't need (e.g., `contact-form-7` on a blog post) and click to copy.
3. **Manage:** Edit the post/page, find the **Smart Asset Optimizer Asset Manager** box in the sidebar.
4. **Kill:** Paste the handles (one per line) and Save.
5. **Verify:** Check your page speed and ensure the page still functions correctly.

---

## 🔒 Security & Standards Compliance

- **WordPress.org Ready:** 100% compliant with official namespace and security standards.
- **Data Integrity:** All inputs are rigorously sanitized using `sanitize_textarea_field`.
- **Anti-CSRF Protection:** Every save operation is shielded by WordPress security nonces.
- **Privacy First:** 0% tracking, 0% data collection. 100% Open Source.

---

## 👨‍💻 Developer & Support

Crafted with ❤️ by **Sakib MD Nazmush**. 

- 🌟 **Like this plugin?** Give it a star on GitHub!
- 📂 **More Projects:** [GitHub Profile](https://github.com/nazsakib)
- 🌐 **Portfolio:** [sakibnazmush.vercel.app](https://sakibnazmush.vercel.app)

---

## 📜 License

This project is licensed under the GPLv2 or later. Performance optimization should be accessible to everyone.
