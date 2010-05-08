<?php

require_once('phpOpenGraph.class.php');

$og = new phpOpenGraph('http://www.rottentomatoes.com/m/10011268-oceans/');

foreach($og->metadata as $key => $value) {
    echo $key . ': ' . $value . "<br />\n";
}