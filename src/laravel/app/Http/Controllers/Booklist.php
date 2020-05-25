<?php

namespace App\Http\Controllers;

use App\Console\MelonShopPageParser;
use App\Doujinshi;
use Illuminate\Http\Request;

class Booklist extends Controller
{
    # Add a new book into db and redirect to APP@show
    public function add(Request $request)
    {
        $shop_name = $request->input("shop_name");
        $product_id = $request->input("product_id");
        $book_name;
        $url;
        $online_stock_status;

        /*
        1. Check shop name and Check id format
        3. Build shop page url and parse it
        4. Write the book to db
        */
        if ($shop_name=="melonbooks" && preg_match("/^\d{6}$/", $product_id)) {
            $url = "https://www.melonbooks.co.jp/detail/detail.php?product_id="."$product_id"."&adult_view=1";
            $parser = new MelonShopPageParser();
            $p_array = $parser->parseAll($url);
            $book_name = $p_array['book_name'];
            if ($p_array['online_stock_status'] == '在庫あり'){
                $online_stock_status = 'Plenty';
            } elseif ($p_array['online_stock_status'] == '残りわずか'){
                $online_stock_status = 'Rare';
            } elseif ($p_array['online_stock_status'] == '好評受付中'){
                $online_stock_status = 'Preorder';
            } elseif ($p_array['online_stock_status'] == '-'){
                $online_stock_status = 'Out of stock';
            }

            $doj = new Doujinshi;
            $doj->id = $shop_name.$product_id;
            $doj->product_id = $product_id;
            $doj->book_name = $book_name;
            $doj->shop_page_url = $url;
            $doj->online_stock_status = $online_stock_status;
            $doj->shop_name = $shop_name;
            try{
                $doj->save();
            } catch (\Illuminate\Database\QueryException $e) {
                var_dump($e->errorInfo);
            }
            
            
        } else {
            echo "No such shop or no such item!"."<br/>";
        }
        return redirect()->action('App@show');
    }

    # Delete a book in db and redirect to APP@show
    public function delete(Request $request)
    {
        $shop_name = $request->input("shop_name");
        $product_id = $request->input("product_id");
        $booklist = Doujinshi::destroy($shop_name.$product_id);

        return redirect()->action('App@show');
    }
}
