=== FastLoader: Ultimate WordPress Speed & Asset Optimization ===
Contributors: sakibsnaz
Tags: performance, speed, optimization, scripts, asset-manager, core-web-vitals, pagespeed, seo, cleanup, debloat
Requires at least: 6.0
Tested up to: 6.9
Stable tag: 1.0.0
Requires PHP: 7.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Boost your PageSpeed scores and master Core Web Vitals by surgically disabling unused CSS and JS files on a per-page basis.

== Description ==

**FastLoader** is a lightweight, high-performance plugin designed to eliminate the #1 cause of slow WordPress sites: **Plugin Bloat**. 

Many plugins load their scripts and styles on every single page, even where they aren't used. This increases HTTP requests, adds render-blocking CSS, and slows down JavaScript execution—negatively impacting your **Google Search rankings** and **Core Web Vitals**.

FastLoader gives you a surgical "Kill Switch." Easily identify and disable specific CSS and JS handles for every individual Post or Page, ensuring only the necessary code loads for your users.

### 🚀 Why Choose FastLoader for SEO?
* **Improve LCP & TBT:** Reduce the weight of your pages for better PageSpeed Insights scores.
* **Master Core Web Vitals:** Eliminate render-blocking assets that hurt your rankings.
* **Real-time Frontend Scanner:** No technical knowledge required. Scan and identify scripts directly from your site's frontend.
* **Zero Bloat:** We don't add more weight to your site. Our plugin is built with native hooks and zero external dependencies.

== Key Features ==
* **Real-time Asset Scanner:** Detect active JS and CSS handles directly from the frontend admin bar.
* **Per-Page Precision:** No global settings that break your site; manage assets individually for every Post or Page.
* **Modern Glassmorphism UI:** A sleek, user-friendly scanner that makes optimization easy.
* **Safety First Guard:** Prevents the accidental disabling of core WordPress dependencies like jQuery for admins.
* **Ultra Lightweight:** Optimized PHP and minimal JS for zero overhead.

== Installation ==

1. Download the plugin `.zip` file.
2. Log in to your WordPress Dashboard.
3. Navigate to **Plugins > Add New > Upload Plugin**.
4. Select the `fastloader.zip` file and click **Install Now**.
5. Click **Activate**.

== Frequently Asked Questions ==

= How do I find the script handles? =
Visit any page while logged in as an administrator. In the top Admin Bar, click the **Scan Assets** icon. A popup will appear listing all the unique "handles" (nicknames) for the scripts and styles currently loading on that page.

= Will this improve my Google PageSpeed score? =
Yes! By removing unused CSS and JS, you reduce the page size and execution time, which are critical factors for PageSpeed Insights and Core Web Vitals (LCP, FID, CLS).

= What happens if I disable a script by mistake? =
If a page feature stops working, simply remove the handle from the FastLoader box on the Edit Page screen and save. Your site will immediately return to its original state.

= Is it safe for beginners? =
Absolutely. We've included a "Protected List" to prevent you from disabling essential core files like jQuery or the Admin Bar CSS.

== Details & Usage ==

### Step 1: Scanning the Frontend
Navigate to the page you want to speed up. Click **Scan Assets** in the Admin Bar. Copy the handles of plugins you know aren't needed on this specific page (e.g., a contact form script on a blog post).

### Step 2: The Meta Box
Open the WordPress Editor for that page. Look for the **FastLoader Asset Manager** meta box in the sidebar.

### Step 3: Blocking Assets
Paste the handles into the box, one per line. 
*Example:*
`contact-form-7`
`wp-block-library`

### Step 4: Verification
Save the page. You'll notice an immediate reduction in page weight and improved performance in tools like PageSpeed Insights or GTmetrix.

== Screenshots ==

1. **The Scanner:** Our sleek frontend scanner displaying active JS and CSS handles.
2. **The Editor:** The intuitive Meta Box integrated into the WordPress Page/Post editor.

== Changelog ==

= 1.0.0 =
* Initial release.
* Added Browser-Side DOM Scanner for handle detection.
* Integrated per-page Meta Box for asset dequeuing.
* Added safety protection for core dependencies.
