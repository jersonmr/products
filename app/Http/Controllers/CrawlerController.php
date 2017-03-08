<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Weidner\Goutte\GoutteFacade;

class CrawlerController extends Controller
{
    public function getDataProducts()
    {
        if(!Cache::has('images') || !Cache::has('titles') || !Cache::has('options') || !Cache::has('options')) {                

            $crawler = GoutteFacade::request('GET', 'https://www.appliancesdelivered.ie/search?sort=price_desc');

            $images = $crawler->filter('.product-image img')->each(function($node) {
                return $node->attr('src');
            });
            $titles = $crawler->filter('.product-description h4')->each(function($node) {
                return $node->text();
            });
            $options = $crawler->filter('.product-description ul')->each(function($node) {
                return $node->text();
            });
            $prices = $crawler->filter('.product-description .section-title')->each(function($node) {
                return $node->text();
            });
            $urls = $crawler->filter('.product-image a')->each(function($node) {
                return $node->attr('href');
            });


            // Adding the vars to the cache
            Cache::put('images', array_slice($images, 0, 10), 3);
            Cache::put('titles', array_slice($titles, 0, 10), 3);
            Cache::put('options', array_slice($options, 0, 10), 3);
            Cache::put('prices', array_slice($prices, 0, 10), 3);
            Cache::put('urls', array_slice($urls, 0, 10), 3);
        }

        // Getting the cached data
        $images  = Cache::get('images');
        $titles  = Cache::get('titles');
        $options = Cache::get('options');
        $prices  = Cache::get('prices');
        $urls  = Cache::get('urls');          

        $dataCollection = array_map(null, $images, $titles, $options, $prices, $urls);
        
        return view('products', compact('dataCollection'));
    }
}
