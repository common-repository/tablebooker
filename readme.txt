=== tablebooker - The official plugin for tablebooker ===
Contributors: tablebooker, johannesdr
link: https://tablebooker.com
Tags: tablebooker, restaurant, reservation, booking, menu, restaurants, menus, dining, food
Requires at least: 5.0
Tested up to: 6.3.1
Stable tag: 3.1.0
Requires PHP: 5.6
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Include the tablebooker modules for booking, gift cards, takeaway, menu card and more in your Wordpress site.

== Description ==

Requires a Tablebooker Pro account: https://pro.tablebooker.com

Features:

* Reservation widget: displays the real-time booking module
* Menu widget: displays the restaurant menu card
* Reviews widget: show curated reviews from you customers
* Shop widget: sell gift cards or takeaway from your website with Tablebooker.shop.

== Installation ==

1. Unzip the tablebooker.zip file
2. Upload the entire 'tablebooker' folder to the '/wp-content/plugins/' directory
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Update Site Wide options through the Settings -> tablebooker Options
5. Include the reservation form on the desired page by adding the tag
[tablebooker_reservation] to the page. Or use the function tablebooker_reservation()
to include the form in your theme.
6. Include the menu on the desired page by adding the tag
[tablebooker_menu] to the page.
7. Include the customers feedbacks on the desired page by adding the tag
[tablebooker_feedback] to the page.
8. Include the restaurant shop on the desired page by adding the tag
[tablebooker_shop], [tablebooker_shop_vouchers] or [tablebooker_shop_takeaway] to the page.
Or use the functions tablebooker_shop(), tablebooker_shop_vouchers() or tablebooker_shop_takeaway() to include the form in your theme.


== Frequently Asked Questions ==
Nothing yet

== Changelog ==

= 3.1.0 =
* Tested with WordPress 6.3.1
* Removed old RestoGiftCards code. Make sure you replace the RestoGiftCard widgets [tablebooker_giftcard] with [tablebooker_shop_vouchers].
* Rebranding Tablemanager to Tablebooker Pro
* Added preparations for localization
* Fix bug in shop voucher shortcode

= 3.0.0 =
* Tested with WordPress 6.2.2 and made some changes to make it work
* RestoGiftCards has been replaced with the new Tablebooker Shop. Update your settings and shortcodes.

= 2.1.0 =
* Tested with WordPress 5.8
* Bugfix for shortcode
* New shortcodes added (menu, gift cards, reviews)

= 2.0.0 =
* Brand new booking module design. Easier to use, easier to install and with more features and theming options

= 1.1.2 =
* Bugfix for shortcode

= 1.1.1 =
* Installation instructions update

= 1.1.0 =
* Configurable background (light/dark)
* Configure embed language
* Update iframe code

= 1.0.1 =
* Extended installation instructions

= 1.0.0 =
* Initial public release

== Upgrade Notice ==

= 1.1.2 =
* Tested with WordPress 4.6.1
* Bugfix for shortcode

= 1.1.1 =
* Tested with WordPress 4.0.1
* Installation instructions update

= 1.1.0 =
* Improved iframe compatibility with themes
* Reservation form language configurable
* Background color configurable

= 1.0.1 =
* Extended installation instructions
