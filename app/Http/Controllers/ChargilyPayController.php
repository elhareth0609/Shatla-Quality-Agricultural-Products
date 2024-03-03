<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Chargily\ePay\Chargily;

class ChargilyPayController extends Controller
{
    public function pay() {

        $chargilyConfig = config('chargily'); 

        $chargily = new Chargily([
            'api_key' => $chargilyConfig['key'],
            'api_secret' => $chargilyConfig['secret'],
            'urls' => [
                'back_url' => route('chargily.payment.success'), 
                'webhook_url' => route('chargily.payment.webhook'),
            ],
            'mode' => 'EDAHABIA',
            'payment' => [
                'number' => 'payment-number-from-your-side',
                'client_name' => 'client name',
                'client_email' => 'client_email@mail.com',
                'amount' => 75,
                'discount' => 0,
                'description' => 'payment-description',
            ]
        ]);

        $redirectUrl = $chargily->getRedirectUrl();

        if ($redirectUrl) {
            return redirect($redirectUrl);
        } else {
            return "We can't redirect to your payment now";
        }

    }

    public function Response() {
      $chargilyConfig = config('chargily'); 

      $chargily = new Chargily([
          'api_key' => $chargilyConfig['key'],
          'api_secret' => $chargilyConfig['secret'],
      ]);

      if ($chargily->checkResponse()) {
          $response = $chargily->getResponseDetails();

          // Validate order status, update database, or perform other actions
          // Example: if ($response['invoice']['status'] !== 'approved') { ... }

          // $response = array(
          //     "invoice" => array(
          //                 "id" => 5566321,
          //                 "client" => "Client name",
          //                 "invoice_number" => "123456789",
          //                 "due_date" => "2022-01-01 00:00:00",
          //                 "status" => "paid",
          //                 "amount" => 75,
          //                 "fee" => 25,
          //                 "discount" => 0,
          //                 "comment" => "Payment description",
          //                 "tos" => 1,
          //                 "mode" => "EDAHABIA",
          //                 "invoice_token" => "randoom_token_here",
          //                 "due_amount" => 10000,
          //                 "created_at" => "2022-01-01 06:10:38",
          //                 "updated_at" => "2022-01-01 06:13:00",
          //                 "back_url" => "https://www.mydomain.com/success",
          //                 "new" => 1,
          //     );
          // )

          return response('OK', 200);
      } else {
          return response('Error', 400);
      }
    }

    public function handleSuccess(Request $request)
    {
        // Your logic to handle successful payment callback
    }

    // Method to handle webhook notifications from Chargily
    public function handleWebhook(Request $request)
    {
        // Your logic to handle webhook notifications
    }
}
