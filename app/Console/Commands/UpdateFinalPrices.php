<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;

class UpdateFinalPrices extends Command
{
    protected $signature = 'products:update-final-prices';
    protected $description = 'Update fina_actual_regular_price and fina_actual_sale_price based on accessors';

    public function handle()
    {
        $this->info('Updating products...');

        Product::with(['variants'])->chunk(100, function ($products) {
            foreach ($products as $product) {
                $product->fina_actual_regular_price = $product->final_regular_price;
                $product->fina_actual_sale_price = $product->final_sale_price;
                $product->save();
            }
        });

        $this->info('Finished updating final prices.');
    }
}
