=== Better Excerpt ===
Contributors: blogmum
Donate link: http://blogmum.com/donate/
Tags: excerpt, the_excerpt 
Requires at least: 2.8 
Tested up to: 2.8.4
Stable tag: 0.2

Gives you full control over the WordPress excerpt: change the length, the ellipsis [...] and surrounding markup.

== Description ==

By default, the WordPress excerpt is fixed at 55 words, wrapped in &lt;p&gt; tags and with [...] as an unlinked ellipsis at the end. This plugin allows you to specify the length of the excerpt you want, text or HTML before the excerpt, text or HTML after the excerpt, and whether you want to automatically append a link to the full post. 

Example uses:

* set the excerpt at a length that works with your magazine-style theme
* automatically wrap every excerpt in div tags
* automatically add a "read more" link after your excerpt, linking to the full post
* get rid of that super-annoying [...] thing!

== Installation ==

1. Upload `betterexcerpt.php` to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Set your own preferences in Settings > Better Excerpt

== Frequently Asked Questions == 

= Does it remove HTML tags? =
Yes, it does.

= Can't you make it leave HTML tags in? =
If you want to leave HTML in, then the "more" tag is your friend. the_excerpt is meant to remove HTML.

= How can I have excerpts of different lengths? = 
You can manually call the function like this:
`&lt;?php echo better_excerpt($length, $ellipsis, $before_text, $after_text, $link_to_post, $link_text); ?&gt;`
for example
`&lt;?php echo better_excerpt(500, '...', '<p>', '</p>' 'yes', 'read more'); ?&gt;`
obviously replacing the variables with your own values. The value of link_to_post should be 'yes' or 'no'. All variables need to have values, so if you don't want any - e.g. - code before or after the extract, you need empty inverted commas '' 

= Does it leave half-words at the end of my excerpt? =
No, it doesn't: half-words are trimmed back to the end of the previous word.

= I set length to 55 but it's only giving me about 10 words =
Length is set in characters - that is, letters, numbers, spaces and bits of punctuation. We do it like this because some people use lots of long words, and some people don't, so a ten word excerpt for some would be the same length as a twenty word excerpt for others. As a general rule of thumb, assume 5 letters in the average English word.

= I installed it but now I get a fatal error for strrpos... =
This plugin requires PHP5. Most likely, you're still running PHP4. It's time to upgrade.

== Changelog == 

= 0.2 = 
* added manual function to allow excerpts of varying lengths 
* tidied up the read me file! 

= 0.1 = 
* original release

== Screenshots ==

1. Screenshot of admin options page.