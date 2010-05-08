phpOpenGraph is a class written in PHP for parsing Open Graph protocol information from web sites.

Learn more about the protocol at:

http://opengraphprotocol.org

Usage:

require_once('phpOpenGraph.class.php');

$og = new phpOpenGraph('http://www.rottentomatoes.com/m/10011268-oceans/');

foreach($og->metadata as $key => $value) {
    echo $key . ': ' . $value . "<br />\n";
}