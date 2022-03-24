<?php

namespace App\Services;

use App\Contracts\WebcheckoutContract;
use App\Models\Invoice;
use App\Request\CreateSessionRequest;
use App\Request\GetInformationRequest;
use Illuminate\Support\Facades\Http;

class WebCheckoutService implements WebcheckoutContract
{
    private array $data;

    public function getInformation(?int $session_id)
    {
        $getInfromation = new GetInformationRequest();
        $data = $getInfromation->auth();
        $url = $getInfromation::url($session_id);

        return $this->request($data, $url);
    }

    public function buildData(Invoice $invoice): self
    {
        $this->data = [
            "payment" => [
                "reference" => $invoice->number,
                "description" => trans('common.messages.buying', ['app' => config('app.name')]),
                "amount" => [
                    "currency" => "COP",
                    "total" => $invoice->total
                ],
                "allowPartial" => false
            ],
            "expiration"  => now()->addHours(12)->toIso8601String(),
            "returnUrl" => route('checkout.edit', ['number' => $invoice->number])
        ];

        return $this;
    }

    public function createSession(): array
    {
        $createSessionRequest = new CreateSessionRequest($this->data);
        $data = $createSessionRequest->toArray();
        $url = $createSessionRequest::url();

        return $this->request($data, $url);
    }

    private function request(array $data, string $url)
    {
        $response = Http::post($url, $data);
        
        return $response->json();
    }
}