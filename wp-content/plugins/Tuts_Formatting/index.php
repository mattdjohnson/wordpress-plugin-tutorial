<?php 
 
/*
Plugin Name: Tuts Formatting
Plugin URI: http://net.tutsplus.com
Description: Saves me time.
Version: 1.0
Author: Jeffrey Way
Author URI: http://net.tutsplus.com
*/ 
 
function Tut_Formatting($content) {
 
    $end_of_tut = <<<EOT
<ul class="webroundup">
    <li>Follow us on <a href="http://www.twitter.com/nettuts">Twitter</a>, or subscribe to the <a href="http://feeds.feedburner.com/nettuts" title="NETTUTS RSS Feed">NETTUTS RSS Feed</a> for more daily web development tuts and articles.</li></ul>
<p>
<script type="text/javascript"><!--digg_url = "post permalink (not digg url)"; // -->
</script>
<script src="http://digg.com/tools/diggthis.js" type="text/javascript"></script></p>  
EOT;
 
     
    $match = preg_match_all('/<div class=[\'"]?tutorial_image[\'"]?>\s*<img src=[\'"]?.+\.(jpg|gif|jpeg|png)[\'"]?(\s.+)?[(\s\/>)|(>)]\s*<\/div>/i', $content, $matches);
 
    if(!$match) 
    {
        $theContent = preg_replace('/<img src=[\'"]?.+\.(jpg||gif|jpeg|png)[\'"]?(\s.+)?[(\s\/>)|(>)]/', '<div class="tutorial_image">$0</div>', $content);
    }
     
    else
    {
        $theContent = $content;
    }
     
    $theContent = preg_replace('/<h2>/', '<h3>', $theContent);
    $theContent = preg_replace('/<\/h2>/', '</h3>', $theContent);
     
    # Or you can combine those two lines above into one if you would rather.
    # $theContent = preg_replace(’/<(\/?)h2>/’, ‘<$1h3>’, $theContent);
     
    return (is_single()) ? $theContent . $end_of_tut : $theContent;
 
} // end of Tut_Formatting
 
add_filter('the_content', 'Tut_Formatting');