<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\Api\OrdersController;
use function Laravel\Prompts\text;
use Illuminate\Http\Request;

class MakeOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:make-order';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(Request $request)
    {
        for ($i=1; $i <= 10; $i++){
            $order = new OrdersController();
            $order->store($request);
        }
    }
}
