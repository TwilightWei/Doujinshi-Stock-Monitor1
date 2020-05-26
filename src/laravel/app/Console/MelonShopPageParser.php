<?php

namespace App\Console;

use App\Console\ShopPageParser;

class MelonShopPageParser extends ShopPageParser
{
    # Get stock status from shop page
    public function parseStockStatus($url)
    {        
        $c = curl_init($url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        $html = curl_exec($c);

        $dom = new \DOMDocument;
        // Disable errors on invalid html
        libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        $xpath = new \DOMXPath($dom);

        $nodelist = $xpath->query('//div[@class="drop_cart clearfix"]');
        if ($nodelist->length > 0){
            $data = $xpath->query('//span[@class="stock"]')->item(0)->textContent;
        } else {
            $nodelist = $xpath->query('//div[@class="drop_cart"]');
            $data = $nodelist->item(0)->getElementsByTagName('td')->item(2)->textContent;
        }

        return $data;
    }

    # Get data for model from shop page
    public function parseAll($url)
    {
        $data = array('book_name' => '', 'online_stock_status' => '');
        
        $c = curl_init($url);
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        $html = curl_exec($c);

        $dom = new \DOMDocument;
        // Disable errors on invalid html
        libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        $xpath = new \DOMXPath($dom);

        $node = $dom->getElementById('description');
        $data['book_name'] = $node->getElementsByTagName('td')->item(0)->textContent;

        $nodelist = $xpath->query('//div[@class="drop_cart clearfix"]');
        if ($nodelist->length > 0){
            $data['online_stock_status'] = $xpath->query('//span[@class="stock"]')->item(0)->textContent;

        } else {
            $nodelist = $xpath->query('//div[@class="drop_cart"]');
            $data['online_stock_status'] = $nodelist->item(0)->getElementsByTagName('td')->item(2)->textContent;
        }

        return $data;
    }
}