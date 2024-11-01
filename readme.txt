=== YMYL Schema Post Content plugin ===

Contributors: Divo9, YMYL Themes LLC
 
Donate link: https://www.ymylthemes.com/ymyl-schema-post-content-plugin/

Tags: plugin, wordpress plugin, structured data plugin, schema markup plugin, custom plugin, custom post plugin, plugin schema markup

JSON-LD Requires at least: 4.4

Tested up to: 4.6.1

Stable tag: 2.1 
License: GPLv2 or later

License URI: http://www.gnu.org/licenses/gpl-2.0.html


This WordPress Plugin displays recent posts in each thumbnail view and post type using HTML5 Schema Markup Schema.org Vocabulary. Benefit from Schema Markup on Posts and Pages!


== Description ==
Easy to use plugin that allows WordPress built site owners to add Content/Post Markup to their websites (validated in Google Webmaster Tools). Using schema.org to describe your content will allow Google to index and show your posts in search. Including schema microdata in your web pages is similar to eating well, exercising or getting a good nights rest. You know you should be doing it, but actually following through can be harder than it sounds. But, like I always say, Do The WORK, and You Will Be REWARDED For It!

You can now make it really easy to add the proper Schema Markup to your posts and pages with the YMYL Schema Post Content Markup Plugin.

Contrary to common misconception, Google does in fact use Schema Markup to display rich snippets. Clear, concise rich snippets can result in higher click-through rates, as users can quickly and easily determine whether the content on your site is what they are looking for.

Although Schema and other Structured Markup formats have been around for several years, less than 3 percent bother to include Schema Microdata (they are losing out on a HUGE boost in SEO and Rankings!), and even fewer people actually know what schema is or what it is for. However, there is no need to be embarrassed, just learn how to make it an integral part of your SEO strategy.

As with other markup formats, schema microdata is applied to the content of a page to define exactly what it is and how it should be treated. Schema elements and attributes can be added directly to the HTML code of a web page to provide the search engines crawlers with additional information by using the YMYL Schema Post Content Plugin.

Including schema microdata in your HTML code can help search engine crawlers interpret the content of your pages more effectively. This, in turn, can increase your visibility. However, it is important to note that including schema (or any other structured markup format) in your code is not a quick and dirty SEO hack. Instead, think of Schema Markup as a best practice to make it easier for search engines to find and display your content.

Aside from making it easier for search engines to properly categorize your site content, marking up your pages with Schema Microdata can also be used to define and display rich snippets of your content in SERPs. 



 == Installation ==

 1. Upload the zip package via 'Plugins > Add New > Upload' in your WP Admin OR Extract the zip package and upload the YMYL Schema Post Content Plugin folder to the /wp-content/plugins/ directory via FTP.

 2. Activate the plugin through the 'Plugins > Installed Plugins' section in WP Admin.

 3. This plugin is specifically for posts/content only.
For an all inclusive Schema Markup Plugin, see the offer and descriptive benefits at https://www.ymylthemes.com/ymyl-schema-markup-plugin

 == Frequently Asked Questions ==

 = Can I Get Support? =

 Of course...simply Visit: https://www.ymylthemes.com/support-tickets/

= What is Schema Markup? =

 Schema.org is a vocabulary that machines (search engines bots) can understand and use. Major search engines also support Microdata. WordPress sites built using Schema Markup Vocabulary helps search engine better understand the structure of your website. Furthermore, major search engines like Google officially support certain Microdata itemtypes.

 = Will using schema.org improve my website's results from search engine? 

 It certainly can...depending on your site's content and adherence to Google guidelines.com.

 == Screenshots ==

 1. To be updated

 == Changelog ==

 = 2.0 =

  Validated
 = 2.1 =

 == Upgrade Notice ==
 Configuration changes noted.

 = That can be configured item =
* Change of title
* Display switching of thumbnail
* Setting the thumbnail size (to abide to the size of the media settings)
* The setting of the display number
* Display settings Posted
* Setting of post type
= Languages =
* English
= CSS setting of the initial state =
.ymyl_schema_post_plugin > ul {
	list-style: none !important;
}
.ymyl_schema_post_plugin > ul > li {
	position: relative;
}
.ymyl_schema_post_plugin > ul > li:before,
.ymyl_schema_post_plugin > ul > li:after {
	content: "";
	display: table;
}
.ymyl_schema_post_plugin > ul > li:after {
	clear: both;
}
.ymyl_schema_post_plugin > ul > li + li {
	margin-top: 10px;
}
.ymyl_schema_post_plugin .thumbnail-image {
	float: left;
	display: block;
/* REMOVE the width and height if you want your images to display at larger dimensions*/
width: 80px;
height: 80px;
}
.ymyl_schema_post_plugin .thumbnail-image img {
	max-width: 100%;
	height: auto;
	border:3px solid #fff;
}
.ymyl_schema_post_plugin .thumbnail-image + .title {
	margin-left: 88px;
}
.ymyl_schema_post_plugin .title {
	display: block;
}
.ymyl_schema_post_plugin .post-date {
	display: block;
}
.ymyl_schema_post_plugin .post-date.active-thumbnail-image {
	margin-left: 88px;
}

== Upgrade notice == 

Initial release
