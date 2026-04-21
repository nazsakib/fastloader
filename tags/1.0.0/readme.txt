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

**Smart Asset Optimizer for Fast Loading** is a lightweight, high-performance WordPress speed optimization plugin designed to eliminate the #1 cause of slow websites: **Plugin Bloat**.

Most WordPress plugins (like page builders, contact forms, and WooCommerce) load their CSS stylesheets and JavaScript files on *every single page*, even when they aren’t needed. This unnecessary code bloat increases your page size, slows down load times, ruins your Google PageSpeed Insights scores, and frustrates your users.

Smart Asset Optimizer acts as a surgical script manager and asset manager. It gives you a powerful "Kill Switch" to easily **remove unused CSS** and **disable unused JS** on a per-page or per-post basis. By dequeuing unnecessary assets, you ensure only the essential code loads, dramatically speeding up your WordPress site.

### 🚀 Core Features & Benefits

*   **Boost Core Web Vitals:** Dramatically reduce "Total Blocking Time" (TBT), "First Contentful Paint" (FCP), and achieve a perfect 100/100 Lighthouse score.
*   **Remove Unused CSS & JS:** Selectively disable bloated stylesheets and heavy scripts that are slowing down your pages. 
*   **Per-Page Asset Control:** No risky global settings. You have surgical control to dequeue scripts exactly where they aren't needed (e.g., disable Contact Form 7 on pages without a form).
*   **Frontend Asset Scanner:** Our built-in admin bar scanner instantly detects every active script (`wp_enqueue_script`) and style (`wp_enqueue_style`) handle running on your page in real-time.
*   **Speed Up Page Builders:** Fix the bloat caused by Elementor, Divi, WPBakery, and WooCommerce by unloading their assets on non-essential pages.
*   **Developer Friendly & Safe:** No complex configuration files. Just copy the handle from the scanner and paste it into the meta box. If something breaks, simply remove the handle to restore it.
*   **Ultra-Lightweight Footprint:** Zero bloat. The plugin itself is under 20KB, meaning your speed optimization tool won't slow you down.

### 💡 How It Works

1. **Scan the Page:** Browse to any page on your site frontend and click "Scan Assets" in the top Admin Bar.
2. **Find the Bloat:** The scanner reveals a list of all CSS and JS handles currently loading on that specific page.
3. **Disable & Optimize:** Go to the page editor, paste the handles of the unused assets into the Smart Asset Optimizer meta box, and save. The bloat is instantly removed!

### 📈 Why Choose Smart Asset Optimizer?

Unlike heavy caching plugins that try to minify everything, Smart Asset Optimizer tackles the root problem: stopping the code from loading in the first place. It is the perfect companion to your existing caching setup (like WP Rocket, LiteSpeed, or W3 Total Cache) to achieve maximum performance and SEO rankings.

== Installation ==

1. Upload the plugin folder to the `/wp-content/plugins/` directory, or install via the WordPress dashboard.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Access the **Smart Asset Optimizer** meta box on any Post or Page edit screen.
4. Select the `smart-asset-optimizer-for-fast-loading.zip` file and click **Install Now**.

== Frequently Asked Questions ==

= How do I find the script or style handles to disable? =
Visit the frontend of any page while logged in as an administrator. Click **Scan Assets** in the top WordPress Admin Bar. A modal will appear showing all active CSS and JS handles. Simply click any handle to instantly copy it to your clipboard.

= Will disabling assets break my site? =
If you disable a script that is required for a specific feature (like an image slider or a contact form), that feature will stop working. However, Smart Asset Optimizer is completely safe because it operates on a **per-page basis**. 

If a page feature breaks, simply go back to the Edit Page screen, remove that handle from the Smart Asset Optimizer box, and hit Update. Your site will instantly return to normal!

= Does this replace my caching plugin (like WP Rocket or LiteSpeed)? =
No. Smart Asset Optimizer is designed to work *alongside* your caching plugin. Caching plugins usually minify and combine files, but they still load all the code. Our plugin stops the unnecessary code from loading in the first place. For the best Core Web Vitals scores, you should use both!

= Does this work with Page Builders like Elementor, Divi, or WPBakery? =
Yes! In fact, it is highly recommended for page builder sites. Page builders often load heavy assets globally. You can use Smart Asset Optimizer to disable Elementor or Divi scripts on pages where you aren't actively using those specific modules.

= Can I use this with WooCommerce? =
Absolutely. WooCommerce is notorious for loading its cart fragments and styling scripts on every single page (like your blog posts or about page). You can easily dequeue WooCommerce scripts on non-shop pages to significantly speed up your website.

= Is there a risk of disabling core WordPress scripts? =
We've built in safety protections. You cannot accidentally disable critical WordPress core files (like `jquery` or admin bar styles) through the plugin interface, ensuring you never get locked out of your site.

== Screenshots ==

*Note: The exact UI and styling may vary slightly depending on your active WordPress theme and whether you are using the Classic Editor or the Block Editor.*

1. **The Scanner:** Our sleek frontend scanner displaying active JS and CSS handles.
2. **The Editor:** The intuitive Meta Box integrated into the WordPress Page/Post editor.

== Changelog ==

= 1.0.0 =
* Initial release.
* Added Browser-Side DOM Scanner for handle detection.
* Integrated per-page Meta Box for asset dequeuing.
* Added safety protection for core dependencies.
