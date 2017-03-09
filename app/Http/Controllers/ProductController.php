<?php

namespace App\Http\Controllers;

use App\WishList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Weidner\Goutte\GoutteFacade;

class ProductController extends Controller
{
    public function getDataProducts()
    {
        if(!Cache::has('expensive_images') || !Cache::has('expensive_titles') || !Cache::has('expensive_options') || !Cache::has('expensive_prices')) {                     

            // Processing the 10 expensive products
            $this->getProducts("https://www.appliancesdelivered.ie/search?sort=price_desc", "expensive");  

            // Processing the 10 cheapest products
            $this->getProducts("https://www.appliancesdelivered.ie/search", "cheapest");          
        }

        // Getting the cached data
        $expensive_images  = $this->getDataCached('expensive_images');
        $expensive_titles  = $this->getDataCached('expensive_titles');
        $expensive_options = $this->getDataCached('expensive_options');
        $expensive_prices  = $this->getDataCached('expensive_prices');        

        // Saving the data in an only array
        $expensiveData = array_map(null, $expensive_images, $expensive_titles, $expensive_options, $expensive_prices);

        // Getting the 10 cheapest products
        $images_cheapest = $this->getDataCached('cheapest_images');
        $titles_cheapest = $this->getDataCached('cheapest_titles');
        $options_cheapest = $this->getDataCached('cheapest_options');
        $prices_cheapest = $this->getDataCached('cheapest_prices');

        // Saving the data in an only array
        $cheapestData = array_map(null, $images_cheapest, $titles_cheapest, $options_cheapest, $prices_cheapest);        

        return view('products', compact('expensiveData', 'cheapestData'));
    }

    /**
     * Get the 10 first products by value
     * @param  string $url   url to be searched
     * @param  string $value type of product: cheapest or expensive
     * @return void
     */
    public function getProducts($url, $value)
    {         
        $crawler = GoutteFacade::request('GET', $url);

        if ($value == "cheapest") 
        {                       
            $cheapest_images = $crawler->filter('.product-image img')->each(function($node) {
                return $node->attr('src');
            });
            $cheapest_titles = $crawler->filter('.product-description h4')->each(function($node) {
                return $node->text();
            });
            $cheapest_options = $crawler->filter('.product-description ul')->each(function($node) {
                return $node->text();
            });
            $cheapest_prices = $crawler->filter('.product-description .section-title')->each(function($node) {
                return $node->text();
            });        

            // Adding the vars to the cache
            $this->cache("cheapest_images", $cheapest_images);
            $this->cache("cheapest_titles", $cheapest_titles);
            $this->cache("cheapest_options", $cheapest_options);
            $this->cache("cheapest_prices", $cheapest_prices);
        }
        else
        {                       
            $expensive_images = $crawler->filter('.product-image img')->each(function($node) {
                return $node->attr('src');
            });
            $expensive_titles = $crawler->filter('.product-description h4')->each(function($node) {
                return $node->text();
            });
            $expensive_options = $crawler->filter('.product-description ul')->each(function($node) {
                return $node->text();
            });
            $expensive_prices = $crawler->filter('.product-description .section-title')->each(function($node) {
                return $node->text();
            });        

            // Adding the vars to the cache
            $this->cache("expensive_images", $expensive_images);
            $this->cache("expensive_titles", $expensive_titles);
            $this->cache("expensive_options", $expensive_options);
            $this->cache("expensive_prices", $expensive_prices);
        }
    }

    /**
     * Caching the 10 first elements of the array given
     * @param  string $element_name Name of the array
     * @param  array $element      Array to caching
     * @return void               
     */
    public function cache($element_name, $element)
    {
        // (60*24) One day of duration for the cache vars
        Cache::put($element_name, array_slice($element, 0, 10), (60*24));
    }

    /**
     * Assign to a var the array cached
     * @param  string $element_cached Name of the element cached
     * @return string                 
     */
    public function getDataCached($element_cached)
    {
        return Cache::get($element_cached);
    }

    /**
     * Save the choosen product to the wish_list table in Database
     * @param  Request $request Object of laravel
     * @return route           list of items added (Wish List)
     */
    public function saveProduct(Request $request)
    {
        $wish_list = new WishList;

        $data_request = $request->all();

        $wish_list->user_id = Auth::user()->id;

        $wish_list->fill($data_request)->save();        

        return redirect()->route('list-items');
        
    }
}
