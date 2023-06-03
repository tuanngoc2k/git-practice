=== GN Publisher: Google News Compatible RSS Feeds ===
Contributors: gnpublisher
Tags: google news, google, news, publisher center, rss, feed, feeds
Requires at least: 3.5
Tested up to: 6.2
Requires PHP: 5.4
Stable tag: 1.5.7
License: GPLv3 
License URI: https://www.gnu.org/licenses/gpl-3.0.html


== Description ==

GN Publisher makes RSS feeds that comply with the [Google News RSS Feed Technical Requirements](https://support.google.com/news/publisher-center/answer/9545420) for including your site in the [Google News Publisher Center](https://publishercenter.google.com/).

The plugin addresses common RSS compatiblity issues publishers experience when using the Google News Publisher Center, including:

-  Incomplete articles
-  Duplicate images
-  Missing images or media
-  Missing content (usually social media/Instagram embeds)
-  Title errors (missing or repeated titles)
-  Cached RSS feeds causing slow updating
-  Delayed crawling by Google

After installing, click on the *'Dashboard'* under GN Publisher on your plugins page for additional information about applying and troubleshooting issues related to the Google News Publisher Center.

**New in 1.5.7**

Added new feature to exclude categories from main feed.

Added compatibility with the plugin PublishPress Authors.

**New in 1.5.1**

Added New feature for content scraping protection.

**New in 1.4**

Refreshed UI and improved assets usage . Added Support Form .

**New in 1.0.9**

GN Publisher now displays the time of the most recent ping and feed fetch from Google. This helps when troubleshooting the dreaded 'empty sections' issue in the Google News Publisher Center.

**New in 1.0.6**

GN Publisher now pings Google when feeds are updated. This can help with faster updates in your Google News Publication.


### Support

We try our best to provide support on [WordPress GN Publisher plugin support forum](https://wordpress.org/support/plugin/gn-publisher/) forums. However, We have a special [team support](https://gnpublisher.com/contact-us/) where you can ask us questions and get help. Delivering a good user experience means a lot to us and so we try our best to reply each and every question that gets asked.


### Bug Reports

Bug reports for GN Publisher: Google News Compatible RSS Feeds are [welcomed on GitHub](https://github.com/ahmedkaludi/gn-publisher/issues/). Please note GitHub is not a support forum, and issues that aren't properly qualified as bugs will be closed.


== Frequently Asked Questions ==

= How to install and use this GnPublisher plugin? =

After you Active this plugin, just go to Dashboard > Settings > GN Publisher, and after that, You can check feed url and all other settings there!  

= How do I report bugs and suggest new features? =

You can report the bugs for this GN Pub plugin [here](https://github.com/ahmedkaludi/gn-publisher/issues/)

= Will you include features to my request? =

Yes, Absolutely! We would suggest you send your feature request by creating an issue in [Github](https://github.com/ahmedkaludi/gn-publisher/issues/new/) . It helps us organize the feedback easily.

= How do I get in touch? =
You can contact us from [here](https://gnpublisher.com/contact-us/)


== Installation ==

GN Publisher is a standard WordPress plugin and can be installed and activated through your WordPress admin section. Just search for GN Publisher in the WP plugins repository and install and activate.

GN Publisher may also be downloaded to your computer and uploaded, installed, and activated through your WP Admin plugins section.

= Minimum Requirements =

* PHP 5.4 or greater is required, PHP 7.2 or newer is recommended
* This plugin is compatible with all MySQL versions supported by WordPress


== Changelog ==

= 1.5.7 - (07 April 2023) =
* Added: Option to exclude categories from main feed. #48
* Added: Compatibility with the plugin PublishPress Authors #51

= 1.5.6 - (24 February 2023) =
* Fixed: Sanitization and output escaping missing in tab Upgrade to Pro #49
* Fixed: Feed URL's are not showing content of sub category. #34

= 1.5.5 - (19 January 2023) =
* Remove Offer Banner #40

= 1.5.4 - (02 November 2022) =
* Added: BFCM internal offer #36

= 1.5.3 - (11 November 2022) =
* Added: email in / out pop-up form on activation/deactivation #2
* Added: Improve Readme.txt #21
* Fixed: Created an option to choose feed url structure #23
* Fixed: Removed Category base bug with All in One SEO plugin #24
* Fixed: "!" is appearing even if the lenience is activated. #26
* Fixed: Post content is not reflected in feed when category base removed #27
* Fixed: Feed Validation Fails For arabic language #29

= 1.5.2 - (12 October 2022) =
* Added: settings link on plugins page #13
* Added: POP up for upgrade after activation like toc #14
* Added: Show a cta if the content is being stolen below feed section #15
* Added: Need to adding security nonce in deactivate form. #18
* Fixed: Services some parts are not clickable #16
* Fixed: Need Some Improvement with Pro #19
* Fixed: Incompatible with RankMath SEO Plugin #20

= 1.5.1 - (22 September 2022) =
* Stopping people from Stealing content from publishers #4

= 1.5 - (12 September 2022) =
* Fix for Feed URL contains subdirectory in path #7
* Fix for Loading script on all admin dashboard pages #9

= 1.4.2 - (9 September 2022) =
* Fix for "Most Recent Update Ping Sent" always "None recorded"

= 1.4.1 - (9 September 2022) =
* Fix for fatal errors on php 8+ on setting page
* Fix for tabs not working

= 1.4 - (9 September 2022) =
* UI Improvements
* Added Help &amp; support form
* Improved assets and readme

= 1.3 - (15 April 2021) =
* Removed Freemius
* Reverted a redirect change

= 1.2 - (18 March 2021) =
* Optimize image replacement feature
* Update for PHP 8 compatability

= 1.1 - (29 November 2020) =
* Fix for some doubled images not being caught
* Fix for some permalink examples on info page
* Added Freemius opt in

= 1.0.9 - (24 August 2020) =
* Added timestamp for most recent ping
* Added timestamp for most recent fetch
* Bug fix for pubdate timezone
* Expanded troubleshooting section
* Added refresh (cached) Pub Center articles upon activation

= 1.0.8 - (25 May 2020) =
* bug fix for pre 5.3 versions of WP
* fix for Yoast compatiblity
* fix for Monster Insight compatability
* Bug fix for Instagram embeds
* Removed time restriction on posts incld in feeds

= 1.0.7 - (23 April 2020) =
* Bug fixes affecting pre 5.3 versions of WP

= 1.0.6 - (23 April 2020) =	
* Added google websub notification

= 1.0.4 - (6 April 2020) =
* Syncing up version info

= 1.0.3 - (6 April 2020) =
* Disabled select rss plugins from altering this feed

= 1.0.2 - (2 April 2020) =
* Adjustments to featured image handling
* Added cache disabling
* Added GN Publisher to generator tag
* Removed default feed option in settings
* Added explicit feed urls on settings page

= 1.0.0 - (10 March 2020) =
* This is the first release of GN Publisher
