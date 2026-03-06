=== FastLoader ===
Contributors: sakibsnaz
Tags: performance, speed, optimization, scripts, asset-manager
Requires at least: 6.0
Tested up to: 6.9
Stable tag: 1.0.0
Requires PHP: 7.4
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Surgically disable specific CSS and JS files on a per-page basis to boost PageSpeed scores and eliminate plugin bloat.

== Description ==
FastLoader allows you to disable specific CSS and JS files on a per-page basis. This is perfect for stopping heavy plugins from loading their scripts on pages where they aren't needed, significantly improving your PageSpeed scores.

== Key Features: ==
* **Real-time Asset Scanner:** Detect active JS and CSS handles directly from the frontend admin bar.
* **Per-Page Control:** No global settings that break your site; manage assets individually for every Post or Page.
* **Zero Bloat:** Built using native WordPress hooks and lightweight JavaScript. No external APIs or heavy libraries.
* **Safety First:** Prevents the accidental disabling of core WordPress dependencies like the Admin Bar and jQuery for logged-in admins.

== Installation ==

1. Download the plugin `.zip` file.
2. Log in to your WordPress Dashboard.
3. Navigate to **Plugins > Add New > Upload Plugin**.
4. Select the `fastload-selective-assets.zip` file and click **Install Now**.
5. Click **Activate**.

== Frequently Asked Questions ==

= How do I find the script handles? =
Simply visit any page on your website while logged in as an administrator. In the top black Admin Bar, click the magnifying glass icon labeled **Scan Assets**. A popup will appear listing all the unique "handles" for the scripts and styles currently loading on that page.

= What is a "handle"? =
In WordPress, a handle is a unique nickname given to a script or stylesheet (e.g., `contact-form-7` or `wp-block-library`). Our plugin uses these nicknames to tell WordPress not to load them.

= Will this break my site? =
If you disable a script that a page actually needs (like a gallery script on a gallery page), that specific feature will stop working. However, the rest of your site will remain intact. If something looks wrong, simply remove the handle from the FastLoader box and save the page to restore it.

= Can I disable core WordPress features? =
We have included a "Protected List" to prevent you from accidentally disabling essential files like jQuery or the Admin Bar CSS, which would make it difficult to manage your site.

== Details & Usage ==

### Step 1: Scanning the Frontend
Navigate to the page you wish to optimize. Click **Scan Assets** in the Admin Bar. Copy the handles you want to remove (for example, `wp-block-library` if you aren't using Gutenberg blocks on that specific page).

### Step 2: The Meta Box
Go to the Edit screen for that page. On the right-hand sidebar, locate the **FastLoader Asset Manager** box. 

### Step 3: Blocking Assets
Paste the handles into the text area, one per line. 
*Example:*
`contact-form-7`
`mailchimp-for-wp`

### Step 4: Verification
Save the page and view the frontend. Use the "View Page Source" feature or a speed testing tool like PageSpeed Insights to confirm that the files are no longer being requested.

== Screenshots ==

1. **The Scanner:** The frontend scanner tool displaying active JS and CSS handles.
2. **The Editor:** The Meta Box integrated into the WordPress Page Editor for easy asset management.

== Changelog ==

= 1.0.0 =
* Initial release.
* Added Browser-Side DOM Scanner for handle detection.
* Integrated per-page Meta Box for asset dequeuing.
* Added safety protection for core dependencies.
