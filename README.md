somc-subpages-produktion9
==============

Plugin Name: somc-subpages-produktion9
Plugin URI: https://github.com/produktion9/somc-subpages-produktion9
Description: Produktion9 List Subpages
Version: 1.0
Author: Martin Hansson
Author URI: http://produktion9.se
License: GPL
Requires at least: -
Tested up to: 3.8.1
Stable tag: -
Tags: List Subpages

== Description ==

List Subpages

Options:


== Installation ==

1. Download and extract the zip archive
2. Upload `somc-subpages-produktion9` folder to `/wp-content/plugins/`
3. Activate the plugin through the 'Plugins' menu in WordPress
4. Add the widget to a sidebar and configure the options as desired or use the shortcode

== Description ==

This plugin creates a "Sub Pages" Widget and also a Shortcode to use in pages.

It displays a list of subpages and children for the parent page.

The list shows the pages thumbnail (if set) and the title of the page. (Truncated to 20 characters if needed.)

Each level of pages/children is also collapsable and sortable by title.

Its possible to set the title of the list in the widget and also in the shortcode.
E.g: 
[sub_page title='Pages']


== Tested on ==
Wordpress theme 2014
-Firefox 27.0.1
-Safari 7.0.1
-Google Chrome 33.0.1750.117

== Bugs ==
- Only shows one level of children
- First parent page must have an id lower than first child
- Sorting on top level -> (Temporarily removed)