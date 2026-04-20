=== Smart Asset Optimizer for Fast Loading ===
Contributors: sakibsnaz
Tags: speed, performance, optimization, asset management, core web vitals
Requires at least: 6.0
Tested up to: 6.9
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Kill plugin bloat. Selectively disable unnecessary CSS and JS per page to boost speed and Core Web Vitals.

== Description ==

**Smart Asset Optimizer for Fast Loading** is a lightweight, high-performance plugin designed to eliminate the #1 cause of slow WordPress sites: **Plugin Bloat**. 

Most WordPress plugins load their scripts and styles on every single page, even when they aren't needed. This slows down your site, hurts your SEO, and frustrates your users.

Smart Asset Optimizer gives you a surgical "Kill Switch." Easily identify and disable specific CSS and JS handles for every individual Post or Page, ensuring only the necessary code loads for your users.

### 🚀 Why Choose Smart Asset Optimizer for Fast Loading?

*   **Boost Core Web Vitals:** Dramatically reduce "Total Blocking Time" and "Lighthouse" scores.
*   **Per-Page Control:** No global settings that break your site. Choose exactly what to disable on a per-post basis.
*   **Admin Bar Scanner:** A built-in scanner helps you identify every script and style handle running on your frontend in real-time.
*   **Developer Friendly:** No complex configuration. Just paste the handle and save.
*   **Ultra Lightweight:** Zero bloat. The plugin itself has a footprint of less than 20KB.

== Installation ==

1. Upload the plugin folder to the `/wp-content/plugins/` directory, or install via the WordPress dashboard.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Access the **Smart Asset Optimizer** meta box on any Post or Page edit screen.
4. Select the `smart-asset-optimizer-fast-loading.zip` file and click **Install Now**.

== Frequently Asked Questions ==

= How do I find the script or style handles? =
Visit the frontend of any page while logged in as an administrator. Click **Scan Assets** in the WordPress Admin Bar. A modal will appear showing all active handles. Click any handle to copy it.

= Will this break my site? =
If you disable a script that is required for a page feature (like a slider or contact form), that feature will stop working. However, this only affects the specific page you edited. 

If a page feature stops working, simply remove the handle from the Smart Asset Optimizer box on the Edit Page screen and save. Your site will immediately return to its original state.

== Screenshots ==

1. **The Scanner:** Our sleek frontend scanner displaying active JS and CSS handles.
2. **The Editor:** The intuitive Meta Box integrated into the WordPress Page/Post editor.

== Changelog ==

= 1.0.0 =
* Initial release.
* Added Browser-Side DOM Scanner for handle detection.
* Integrated per-page Meta Box for asset dequeuing.
* Added safety protection for core dependencies.
