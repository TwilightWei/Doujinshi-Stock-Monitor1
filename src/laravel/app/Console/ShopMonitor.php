<?php

namespace App\Console;

use App\Console\MelonShopPageParser;
use App\Console\EmailSender;
use App\Doujinshi;
use App\Mail\Notification;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ShopMonitor extends Command
{
    # Command name
    protected $signature = 'monitor:parse';
 
    # Command description
    protected $description = 'monitor the shop page of the books';
    
    /*
    1. Get all books from DB
    2. Parse stock status of each book
        2.1 Update stock status of each book
        2.2 Record book with low stock
    */
    public function handle()
    {
        $changelist = [];
        $notification = false;
        $parser = new MelonShopPageParser();
        $booklist = Doujinshi::all();
        foreach ($booklist as $book)
        {
            $new_status = 'No Data';
            $raw_status = $parser->parseStockStatus($book->shop_page_url);
            if ($raw_status == '在庫あり'){
                $new_status = 'Plenty';
            } elseif ($raw_status == '残りわずか'){
                $new_status = 'Rare';
            } elseif ($raw_status == '好評受付中'){
                $new_status = 'Preorder';
            } elseif ($raw_status == '-'){
                $new_status = 'Out of stock';
            }

            if ($book->online_stock_status != $new_status)
            {
                $book->online_stock_status = $new_status;
            }
            if ($new_status == 'Rare' || $new_status == 'Out of stock')
            {
                $notification = true;
                $changelist[] = $book;
            }
            $book->save();
        }

        if ($notification == true){
            $to = collect([
                ['email' => 'tzutan@nature.ee.ncku.edu.tw']
            ]);
            Mail::to($to)->send(new Notification($changelist));
        }
    }
}