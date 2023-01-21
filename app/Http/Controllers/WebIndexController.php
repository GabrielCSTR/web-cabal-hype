<?php

namespace App\Http\Controllers;

use App\Models\cabalAuth;
use App\Models\cabalCash;
use App\Models\cabalCharacter;
use App\Models\cabalGuild;
use App\Models\Plans;
use App\Models\Transations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WebIndexController extends Controller
{
    public function index()
    {
        // ranking
        $rankings = cabalCharacter::where('Nation', '!=', '3')
                                //->where('LEV', '<', '200')
                                ->whereRaw('name not like ?',"%HYPE%")
                                ->whereRaw('name not like ?',"%Vara%")
                                ->whereRaw('name not like ?',"%Dexter%")
                                ->whereRaw('name not like ?',"%Testando%")
                                ->whereRaw('name not like ?',"%teste%")
                                ->orderBy('LEV', 'DESC')
                                ->orderBy('Reputation', 'DESC')
                                ->take(10)
                                ->get();
        // guilds
        $guilds = cabalGuild::orderBy('Point', 'DESC')
                                ->whereRaw('GuildName not like ?',"%STAFF%")
                                ->whereRaw('GuildName not like ?',"%HYPE%")
                                ->take(10)
                                ->get();
        // count player on
        $playersON = cabalCharacter::where('Login', '1')
                                ->count();

        $playerAlzs = cabalCharacter::orderBy('Alz', 'DESC')
                                    ->whereRaw('name not like ?',"%HYPE%")
                                    ->whereRaw('name not like ?',"%[DEV]%")
                                    ->whereRaw('name not like ?',"%[GM]%")
                                    ->take(10)
                                    ->get();

        return view('web.index', compact('rankings', 'guilds', 'playersON', 'playerAlzs'));
    }

    public function download()
    {
        // ranking
        $rankings = cabalCharacter::where('Nation', '!=', '3')
                //->where('LEV', '<', '200')
                ->whereRaw('name not like ?',"%HYPE%")
                ->whereRaw('name not like ?',"%Vara%")
                ->whereRaw('name not like ?',"%Dexter%")
                ->whereRaw('name not like ?',"%Testando%")
                ->whereRaw('name not like ?',"%teste%")
                ->orderBy('LEV', 'DESC')
                ->orderBy('Reputation', 'DESC')
                ->take(10)
                ->get();

        // guilds
        $guilds = cabalGuild::orderBy('Point', 'DESC')
                ->whereRaw('GuildName not like ?',"%STAFF%")
                ->whereRaw('GuildName not like ?',"%HYPE%")
                ->take(10)
                ->get();

        return view('web.download', compact('rankings','guilds'));
    }

    public function activeAccountView($key, $account)
    {
        // ranking
        $rankings = cabalCharacter::where('Nation', '!=', '3')
                //->where('LEV', '<', '200')
                ->whereRaw('name not like ?',"%HYPE%")
                ->whereRaw('name not like ?',"%Vara%")
                ->whereRaw('name not like ?',"%Dexter%")
                ->whereRaw('name not like ?',"%Testando%")
                ->whereRaw('name not like ?',"%teste%")
                ->orderBy('LEV', 'DESC')
                ->orderBy('Reputation', 'DESC')
                ->take(10)
                ->get();

        // guilds
        $guilds = cabalGuild::orderBy('Point', 'DESC')
                ->whereRaw('GuildName not like ?',"%STAFF%")
                ->whereRaw('GuildName not like ?',"%HYPE%")
                ->take(10)
                ->get();

        if($key != "" && $account != "")
        {

            $user = cabalAuth::where('Chave', $key)
                ->where('UserNum', $account)
                ->whereNull('is_active')
                ->first();

            if(!$user)
            {
                return redirect()->route('web.home')->with('success', 'Pagina não existe!');
            }
            else
            {
                return view('web.active', ['rankings' => $rankings, 'guilds' => $guilds, 'account' => $account]);
            }


        }

        return view('web.active', compact('rankings','guilds', 'key', 'account'));
    }

    public function activeAccount($account)
    {
        // check dados
        if($account != "")
        {
            // get user infos
            $user = cabalAuth::where('UserNum', $account)
                            ->whereNull('is_active')
                            ->first();
            // check user exist
            if($user)
            {
                $user->AuthType = 1;
                $user->is_active = 1;
                $user->save();
                return redirect()->route('web.home')->with('success', 'Pagina não existe!');
            }
            else
            {
                return redirect()->route('web.home')->with('success', 'Pagina não existe!');
            }

        }

        return redirect()->route('web.home')->with('success', 'Pagina não existe!');
    }

    public function callback(Request $request)
    {
        $payment_pedents[]= null; // save all payment pendents
        $transations = Transations::where('status', '0')->get(); // get all transations status PENDENTE

        // save transations status PENDETE
        foreach ($transations as $transation) {
           $payment_pedents[] = $transation->id_payment;
        }

        // LIMPANDO DADOS
        $payment_pedents = array_filter($payment_pedents, 'strlen');

        foreach ($payment_pedents as $payment) {

            $mercadoPagoData = $this->getMercadoPagoData($payment); // GET DATA MERCADOPAGO

            //CHECK PAYMENT VALIDATE APPROVED
            if($mercadoPagoData['status'] == "approved" &&
               $mercadoPagoData['status_detail'] == "accredited"
               ) // CHECK VALIDATION
            {
                $transation = Transations::where('id_payment', $payment)
                                        ->where('status', '0')
                                        ->first(); // CONFIG TRANSATION ID DADOS

                if($transation) // CHECK TRANSATION
                {
                    // PEGANDO DADOS PACOTE COMPRADO
                    $pacote = Plans::find($transation->id_pacote);

                    // UPDATE TRANSATION STATUS PAGO
                    $transation->status = 1;
                    $transation->save();

                    // UPDATE CASH PLAYER
                    $cash = cabalCash::where('UserNum', $transation->id_user)
                                    ->update(['Cash' => DB::raw( 'Cash +'. $pacote->Cash )]);

                    return 'SUCESS PAYMENT';
                }
                else
                {
                    redirect()->to('/')->send();
                }
            }

        }
    }

    function getMercadoPagoData($payment)
    {
        // GET API MERCADO PAGO
        $headers[] = 'Accept: application/json';
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Authorization: Bearer ' . env('MP_CLIENT_SECRET');

        $ch = curl_init("https://api.mercadopago.com/v1/payments/". $payment);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $result = curl_exec($ch);
        curl_close($ch);

        $mercadoPagoData = json_decode($result, true); // DADOS MERCADOPAGO

        return $mercadoPagoData;
    }

    public static function format_timeSince($Minutes)
    {
        if ($Minutes < 0)
        {
            $Min = Abs($Minutes);
        }
        else
        {
            $Min = $Minutes;
        }
        $iHours = Floor($Min / 60);
        $Minutes = ($Min - ($iHours * 60)) / 100;
        $tHours = $iHours + $Minutes;
        if ($Minutes < 0)
        {
            $tHours = $tHours * (-1);
        }
        $aHours = explode(".", $tHours);
        $iHours = $aHours[0];
        if (empty($aHours[1]))
        {
            $aHours[1] = "00";
        }
        $Minutes = $aHours[1];
        if (strlen($Minutes) < 2)
        {
            $Minutes = $Minutes ."0";
        }
    $tHours = $iHours ."h ". $Minutes."m";

        return $tHours;
    }
}
