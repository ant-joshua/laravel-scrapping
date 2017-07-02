<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Goutte;

class ScrappingController extends Controller
{
    //

    public function index( Request $request )
    {
    	$data['search'] = $request->get('keyword');
    	$products = null;
    	if($request->get('keyword')){
    		$bukalapak_product = $this->getBukalapakProducts($data['search']);
		    return view('index',array("products" => $bukalapak_product));
    	}
    	return view('index',compact('products'));
		
    	
    }

    public function getBukalapakProducts($search){
    	$crawler = Goutte::request('GET', 'https://www.bukalapak.com/products?utf8=%E2%9C%93&source=navbar&from=omnisearch&search_source=omnisearch_organic&search%5Bkeywords%5D='.$search);


		    $productName = [];
		    $productLink = [];
		    $productPrice = [];
		    $productImage = [];
		    $productRating = [];
		    $products = [];
		    $productName[] = $crawler->filter('.basic-products.basic-products--grid .product__name.line-clamp--2.js-tracker-product-link ')->each(function ($node,$i){
		    	$productName[] = $node->text();
		    	return $productName;
		    });	
		    $productLink[] = $crawler->filter('.basic-products.basic-products--grid .product-media__link.js-tracker-product-link')->each(function($node,$i){
		    	$productLink[] = "https://bukalapak.com".$node->attr('href');
		    	return $productLink;
		    });
		    $productPrice[] = $crawler->filter('.basic-products.basic-products--grid .product-price')->each(function($node,$i){
			    $productPrice[] = $node->attr('data-reduced-price');
			    return $productPrice; 
		    });
		    $productImage[] = $crawler->filter('.basic-products.basic-products--grid .product-media__img')->each(function($node,$i){
		    	$productImage[] = $node->attr('data-src'); 
		    	return $productImage;
		    });

		    $productRating[] = $crawler->filter('.basic-products.basic-products--grid .product-description .product__rating')->each(function($node,$i) {
		    	 if($node->filter('.rating')){
		    	 	if($node->filter('rating__star.js-rating-star')){

			    	 	$test = $node->text();
			    	 	$productRating[] = str_replace("\n", "", $test);
		    	 	}else{
		    	 		$productRating[] = "kosong";
		    	 	}
		    	 }else{
		    	 	$productRating[] = "" ;
		    	 }
		    	 return $productRating;
		    });
		    foreach($productPrice as $key => $value){
		    	foreach($value as $test => $val){
		    		array_push($productName[$key][$test],$val[0]);
		    	}
		    }
		    foreach($productLink as $key => $value){
		    	foreach($value as $test => $val){
		    		array_push($productName[$key][$test],$val[0]);
		    	}
		    }

		    foreach($productImage as $key => $value){
		    	foreach($value as $test => $val){
		    		array_push($productName[$key][$test],$val[0]);
		    	}
		    }
		    foreach($productRating as $key => $value){
		    	foreach($value as $test => $val){
		    		array_push($productName[$key][$test],$val[0]);
		    	}
		    }
		    $products = $productName[0];	
		    return $products;
    }

    public function getTokopediaProducts($search)
    {

    }

    
}	
