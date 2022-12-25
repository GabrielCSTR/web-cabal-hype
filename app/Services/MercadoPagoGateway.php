<?php

namespace App\Services;

use App\Models\Transations;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use \MercadoPago;

class MercadoPagoGateway
{

    private string $clientId;
    private string $clientSecret;

    public function __construct(string $clientId, string $clientSecret)
    {
        $this->clientId = $clientId;
        $this->clientSecret = $clientSecret;

        MercadoPago\SDK::setAccessToken($this->getClientSecret());
    }

    public function getClientId()
    {
        return $this->clientId;
    }

    public function getClientSecret()
    {
        return $this->clientSecret;
    }

    public function create(object $user, int $pacote, $price)
    {

        $external_reference = uniqid("ref_");

        if($price > 0 )
        {
            $payment = new MercadoPago\Payment();
            $payment->transaction_amount    = number_format($price, 2); // total compranda
            $payment->description           = "CABAL HYPE:: Compra do Pacote : Plano-".$pacote; // titulo rifa
            $payment->payment_method_id     = "pix"; // metodo pagamento PIX
            $payment->payer = array(  // dados usuario
                "email"             => $user->Email,
                "first_name"        => $user->UserNum,
                "last_name"         => $user->ID,
                "identification"    => array(
                    "type"          => "CPF",
                    "number"        => "19119119100"
                ),
                "address"=>  array(
                    "zip_code"      => "06233200",
                    "street_name"   => "Av. das Nações Unidas",
                    "street_number" => "3003",
                    "neighborhood"  => "Bonfim",
                    "city"          => "Osasco",
                    "federal_unit"  => "SP"
                )
            );

            $payment->external_reference    = $external_reference;
            //$payment->notification_url      = route('callback');

            // $todayDate = Carbon::now();
            // $todayDate->addDays(1);
            // $payment->date_of_expiration =  $todayDate->toISOString();
            $payment->save();

            $transation             = new Transations();
            $transation->id_user    = Auth::user()->UserNum;
            $transation->id_payment = $payment->id;
            $transation->id_ref     = $external_reference;
            $transation->id_pacote  = $pacote;
            $transation->status     = 0;
            $transation->created_at = Carbon::now();
            $transation->save();

            return $payment;
        }

        return false;
    }

    public function getPayment($id)
    {
        $pago = MercadoPago\Payment::find_by_id($id);

        $payment = MercadoPago\Payment::find_by_id($_GET["data_id"]);


        return $payment;
    }
}
