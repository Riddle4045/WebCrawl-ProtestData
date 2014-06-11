All the files server a specific purpose i.e collection froma  specific source.
boradly : they can be classified as twitter files and non twitter files each for the named sources respectivley.


**TwitterAPIExchange.php**
Utility Class for using Twitter's REST API

**user_timeline.php**
Dependencies : TwitterAPIExchange.php
This class recursively extract given user's timeline * upto 3200 tweets ) searches for a partciular keywords in those ( optional ) and then recursively crawls user who have retweeded tweets contaiing our search keywords.

**simple_html_dom.php**
Utility class to parse DOM objects from a input html format.
http://simplehtmldom.sourceforge.net/

