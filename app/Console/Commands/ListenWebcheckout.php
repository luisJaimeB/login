<?php

namespace App\Console\Commands;

use App\Actions\VerifyPaymentStatus;
use App\Constants\InvoiceStatus;
use App\Models\Invoice;
use App\Services\WebCheckoutService;
use Illuminate\Console\Command;

class ListenWebcheckout extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'webcheckout:verify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(WebCheckoutService $webCheckout)
    {
        $invoices = Invoice::whereNotNull('request_id')
            ->where('invoice_status', InvoiceStatus::PENDING)
            ->get();

        foreach ($invoices as $invoice) {
            VerifyPaymentStatus::execute($webCheckout, $invoice);    
        }
        
        return self::SUCCESS;
    }
}
