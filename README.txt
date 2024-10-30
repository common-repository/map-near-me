=== Map Near Me ===
Contributors: blessedlogic
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=EXJQHGBWYH9TG&source=url
Tags: map, near me, store locator, map search, google, google map, locations
Requires at least: 4.7
Tested up to: 5.5
Stable tag: 1.0.0
Requires PHP: 7.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Utilize a simple shortcode with a search word that will render a button on your website that opens Google map listing all the locations near you.

== Description ==

**Map Near Me** is a shortcode with a search word that allows the ability to insert a button with a zip code field on your website.  Clicking on the button will open a Google map page on a separate tab listing everything based on your search word located near the entered zip code.  Optionally, the zip code field can be disabled, which will search everything located near the end user's location. 

Typical uses:

+ Use it as a simple store locator listing all of your stores in a specific zipcode.
+ Use on your blog to provide locations of just about anything related to your article.
+ Help your readers find the nearest park, post office, city hall, or anything!

This plugin avoids having to get a Google API because it does not embed Google assets into your website, instead, it opens Google maps in a separate browser tab.

== Instructions ==

At a minimum, there must be at least one argument supplied.  This argument will be passed on to Google as the search word(s) list on the map.  If there are multiple search words, then all the words must be separated by a space and enclosed in quotes.  By default, the zipcode input field will always be shown followed by a clickable button.

= Examples: =

+ *[map_near_me barber]* or *[map_near_me "barber shop"]* will show the zip code input field followed by a button that is labeled as <i>Find [search word(s)] Near me</b>. Clicking on the button will open Google map with the search words passed in.  If zip code is suppled by the end user, then the zip code will be included in the search word that is passed to Google map.  If the zip code is not supplied, then Google map will search near the end user's location by default.

+ *[map_near_me keyword="parks"]* uses the name-value pair of "keyword" with search words.  The end result is the same as if the "keyword" name-value pair is not used, however, if any of the optional name-value pairs are used, then the "keyword" name-value pair must be used.

+ *[map_near_me keyword="post office" zipcode=1]* or *[map_near_me keyword="post office" zipcode=0]* - by default, a zip code input field will appear next to the submit button which will allow the user to restrict the keyword to a specific zip code. If desired, you may disable the zip code input field. If no zip code is supplied, or if the zip code field is disabled, then Google will attempt to search near the user’s location with the keyword search word. Assigning a “1” will enable the zip input field and assigning a “0” will disable it.

+ *[map_near_me keyword="library" label="Where is the library?"]* - by default, the button label will always be “Find [keyword] Near Me”. If desired, you may override the label by using the label attribute.

For more examples, or to see a demo, visit the <a href="https://blessedlogic.com/map-near-me/" target="_blank">Map Near Me plugin page</a>.

== Frequently Asked Questions ==

= The input field doesn't look right =

The appearance of the input field is based on your theme's style sheet.  If it does not appear the way you expected it to, you may tweak the input field using the *mnm_input* class.

= What happens if no zip code is entered? =

If no zip code is entered in the input field, then Google will attempt to locate near the end user's current location.

== Changelog ==

= 1.0.0 =
+ Initial install

= 1.1.0 =
+ Added wrapper around code
