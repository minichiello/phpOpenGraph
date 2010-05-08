<?php
/*
Copyright (c) 2010 Gerson Minichiello

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/

class phpOpenGraph
{
    public $metadata;
    
    public $types = array(
	'activity' => array('activity', 'sport'),
        'business' => array('bar', 'company', 'cafe', 'hotel', 'restaurant'),
        'group' => array('cause', 'sports_league', 'sports_team'),
        'organization' => array('band', 'government', 'non_profit', 'school', 'university'),
        'person' => array('actor', 'athlete', 'author', 'director', 'musician', 'politician', 'public_figure'),
        'place' => array('city', 'country', 'landmark', 'state_province'),
        'product' => array('album', 'book', 'drink', 'food', 'game', 'isbn', 'movie', 'product', 'song', 'tv_show', 'upc'),
        'website' => array('article', 'blog', 'website')
    );
    
    function __construct($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $contents = curl_exec($ch);
        curl_close($ch);
        
        $dom = new DOMDocument;
        @$dom->loadHTML($contents);
        $tags = $dom->getElementsByTagName('meta');
        foreach($tags as $tag) {
            if ($tag->hasAttribute('property') && strpos($tag->getAttribute('property'), 'og:') === 0) {
                $key = str_replace('og:', '', $tag->getAttribute('property'));
                $this->metadata[$key] = $tag->getAttribute('content');
            }
        }
    }
}