<?php

namespace App\Console;

use App\Console\ToraShopPageParser;
use App\Console\EmailSender;

class ShopMonitor
{
    # Command name
    protected $signature = 'test:monitor';
 
    # Command description
    protected $description = 'monitor the shop page of the books';
    
    # Run this task
    public function handle()
    {
        return null;
    }

    # Get all urls of the books in db
    private function qcuireBookList()
    {
        return null;
    }

    # Get the stock status of the books in db
    private function parseBookList()
    {
        return null;
    }

    # Update the stock status of the books in db
    private function updateStackStatus()
    {
        return null;
    }
}