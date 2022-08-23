<?php

namespace App\Http\Controllers;

use App\Models\cabalAuth;
use App\Models\Plans;
use App\Services\MercadoPagoGateway;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MercadoPagoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getCreatePreference(Request $request)
    {
        $plan = Plans::where('Name', $request->planName)
                     ->where('status', '=', '1')
                     ->first();
        // valores dos pacotes
        // $pacotes = array(
        //     '0.99',
        //     '20',
        //     '30',
        //     '50',
        //     '100',
        //     '150',
        //     '200',
        //     '500',
        // );

        // $price  = number_format(explode("$", $request->price)[1], 2);
        $price  = number_format(explode("$", $plan->Price)[1], 2);
        // dd($price);

        if($price <= 0)
        {
            return response()->json(['result' => 0, 'message' => 'Você deve escolher um plano de donate para gerar o PIX, tente novamente!'] );
        }

        // $pacote = 0;
        // foreach ($pacotes as $key => $value) {
        //     if($value == $price)
        //         $pacote = $key;
        // }

        $mp = new MercadoPagoGateway(env('MP_CLIENT_ID'), env('MP_CLIENT_SECRET'));

        $user = Auth::user();

        $payment = $mp->create($user, $plan->id, $price); // gerar PIX

        if($payment->point_of_interaction)
        {
            return response()->json(['result' => 1, 'pix' => $payment->point_of_interaction->transaction_data] );
        }
        else{
            return response()->json(['result' => 0, 'message' => 'Falha no processamento, tente novamente!'] );
        }

    }
}
