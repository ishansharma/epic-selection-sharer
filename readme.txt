=== Epic Sharer: Medium Like Sharing ===
Contributors: ishan001
Donate link: https://www.paypal.com/cgi-bin/webscr?&cmd=_xclick&business=ishan.sharma001@gmail.com&currency_code=USD&amount=5&item_name=Donation%20fo%20Epic%20Sharer%20Plugin
Tags: social, share, sharing, twitter, email
Requires at least: 4
Tested up to: 4.5.2
Stable tag: 2.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Epic Selection Sharer adds a Medium like sharing popup to your posts and pages.

== Description ==

Epic Selection Sharer will add a medium like sharing popup to your posts and pages. It is mobile compatible and supports Twitter, Facebook and email. 

**You need to have [Titan Framework](https://wordpress.org/plugins/titan-framework/) (free, available in WordPress Plugin Directory) installed and activated for Epic Sharer to work**

**Features**: 

* Mobile compatible
* Option to set 'via @handle' for twitter
* Supports Facebook
* Option to show on posts, pages or homepage

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/epic-sharer` directory, or install the plugin through the WordPress plugins screen directly.
1. Activate the plugin through the 'Plugins' screen in WordPress
1. Use the `Sharing Settings` screen to configure the plugin


== Frequently Asked Questions ==

= The sharing pop-under is not appearing on mobile. =

This is a known issue that will be fixed in next version. You have to add custom css to your theme files. If you are comfortable with editing your theme, add following line to your theme's style.css:

`.selectionSharer.show {z-index: 9999;}`

= Can I enable it on custom post types? =

No. Only posts, pages and home page are supported as of now.

== Screenshots ==

1. Automatically adds sharer to posts.
2. On mobile, show a simple popunder.
3. Plugin settings, as of version 1.

== Changelog ==

= 2.1 -
* Setting foundation for i18n. 
* Minor bugfix to make plugin look correct on 2016 theme

= 2.0 =
* Adding Facebook support. 

= 1.2 =
* Fixed wrong version number. 

= 1.1 =
* Fixed blank screen/class does not exist error when Titan Framework was not installed/activated.

= 1.0 =
* Launch version, includes basic settings. 

== Upgrade Notice ==

= 2.0 =
This version adds Facebook support.

= 1.2 =
No changes for users. Just a minor versioning issue fixed. 

= 1.1 =
This upgrade fixes a minor issue for new users.

= 1.0 =
This is the first version and there are more features incoming.
