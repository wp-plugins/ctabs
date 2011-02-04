=== Plugin Name ===
Contributors: bbodine1, snumb130
Donate link: http://ctabs.webtmc.us/donate
Tags: content, tabs, separator, jquery tabs, jquery  
Requires at least: 2.6
Tested up to: 3.0.4
Stable tag: 1.2.2

Content Tabs (cTabs) allows you to post content into separate tabs on a page using shortcodes. [shortcodes] 

== Description ==

Why do you need it? It makes things so much easier when you have a lot of content to put on one page and tabs would be ideal. cTabs lets you add a tabbed content area directly in your post or page, without having to edit the theme template.

cTabs comes with a nice default style but you can edit it anyway you would like through the built in CSS editor in options menu. If you change the css and want to go back to the default, just reset the css in the options menu.

== Installation ==

Old *busted* way to install this plugin:

1. Upload folder `ctabs` to the `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.
1. Place `[tabgroup][tab title="Tab One"]Content in tab one here.[/tab][tab title="Tab Two"]Content in tab two here.[/tab][/tabgroup]` in your post or page content area.
1. If desired, click the cTabs option on the admin appearance menu. Change the CSS to whatever you would like.

New *hotness* way to install this plugin:

1. From your wordpress plugin menu, click 'add new'.
1. Search for 'ctabs'.
1. Click 'Install Now'.
1. After install, click 'Activate'.
1. Place `[tabgroup][tab title="Tab One"]Content in tab one here.[/tab][tab title="Tab Two"]Content in tab two here.[/tab][/tabgroup]` in your post or page content area.
1. If desired, click the cTabs option on the admin appearance menu. Change the CSS to whatever you would like.


== Frequently Asked Questions ==

= Why do I get a huge margin above my tabs? =

Wordpress wants you to place all of your shortcodes on a line by themselves. I try to keep the line above and below my shortcode empty when I use them. If there is content on the line above, below, or beside the [shortcode] it will add a lot of <br>'s to the top of the tabs.

= Can I have multiple tabgroups on one page? =

Currently no. I plan to make that option available soon.

= Can I customize the CSS? =

Yes. cTabs is very customizable directly from the admin options menu. Modify the CSS however you want. Option to reset to default is available.

== Screenshots ==

1. Default customization of cTabs in action.
2. cTabs option page.

== Changelog ==

= 1.2.2 =
* Fixed - Issue causing jQuery conflict and tabs to show but not switch. 

= 1.2.1 =
* Fixed - Issue that broke tabs. 

= 1.2 =
* Added - Don't show nasty head css when not using the tabs.

= 1.1 =
* Added ability to use other plugin shortcodes inside a tab.
* Minor default CSS adjustments to help avoid conflicts.
* Minor update to options page
 

= 1.0 =
* Initial Release


== Upgrade Notice ==

= 1.2.2 =
* Fixed - Issue causing jQuery conflict and tabs to show but not switch. 
