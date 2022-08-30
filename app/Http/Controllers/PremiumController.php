<?php

namespace App\Http\Controllers;

use App\Models\cabalCash;
use App\Models\cabalChangeAuth;
use App\Models\cabalLogsPremium;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PremiumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //
    public function index()
    {
        return view('painel.pages.premium.index');
    }

    public function buyVip()
    {
        // cash player
        $cash = cabalCash::where('ID', Auth::user()->ID)
                                ->where('UserNum', Auth::user()->UserNum)
                                ->first();



        $expiracao  = date('Y-m-d H:i:s.B', strtotime('+30 days'));
		$MyIPAtual  = $_SERVER["REMOTE_ADDR"];
		$Web_Date   = date('Y-m-d H:i:s.B');
        $premiumID  = 5; // premium ID
        $vipPremium_valor = 3000; // valor do vip

        if($cash->Cash < $vipPremium_valor){
            return response()->json([
                'success' => false,
                'message' => "Você não tem cash suficiente! é precisso um total de 3.000 cash",
            ]);
        }
        else
        {

            // cash total
            $valorCash = $cash->Cash - $vipPremium_valor;

            // descont cash vip
            cabalCash::where('ID', Auth::user()->ID)
                        ->where('UserNum', Auth::user()->UserNum)
                        ->update(['Cash' => $valorCash]);

            // ADD VIP ACCOUNT
            cabalChangeAuth::where('UserNum', Auth::user()->UserNum)->delete(); // delete USER VIP
            cabalChangeAuth::create([
                'UserNum'       => Auth::user()->UserNum,
                'ServiceKind'   => $premiumID,
                'ExpireDate'    => $expiracao
            ]); // adiciona vip

            // ADD LOGS
            cabalLogsPremium::create([
                'Account'   => Auth::user()->ID,
                'UserNum'   => Auth::user()->UserNum,
                'IP'        => $MyIPAtual,
                'Data'      => $Web_Date,
                'Tipo'      => $premiumID ,
            ]);

            // ITEMS ENVIADOS
            DB::update( // POCAO INESGOTAVEL 1K HP
                DB::raw("USE [CabalCash]exec  up_AddMyCashItemByItem '".Auth::user()->UserNum."', '1', '1', '3182', '0', '17' ")
            );
            DB::update( // POCAP INESGOTAVEL 1K MP
                DB::raw("USE [CabalCash]exec  up_AddMyCashItemByItem '".Auth::user()->UserNum."', '1', '1', '3183', '0', '17' ")
            );
            DB::update( // DESTREINAMENTO DE PET
                DB::raw("USE [CabalCash]exec  up_AddMyCashItemByItem '".Auth::user()->UserNum."', '1', '1', '7433', '30', '31' ")
            );
            DB::update( // CARTAO LOJA REMOTA
                DB::raw("USE [CabalCash]exec  up_AddMyCashItemByItem '".Auth::user()->UserNum."', '1', '1', '1275', '0', '17' ")
            );
            DB::update( // CARTAO ARMAGEM REMOTO
                DB::raw("USE [CabalCash]exec  up_AddMyCashItemByItem '".Auth::user()->UserNum."', '1', '1', '2335', '0', '17' ")
            );
            DB::update( // CARTAO AGENTE REMOTO
                DB::raw("USE [CabalCash]exec  up_AddMyCashItemByItem '".Auth::user()->UserNum."', '1', '1', '1542', '0', '17' ")
            );
            DB::update( // NUCLEO GUIA
                DB::raw("USE [CabalCash]exec  up_AddMyCashItemByItem '".Auth::user()->UserNum."', '1', '1', '944', '0', '17' ")
            );
            DB::update( // PEDRA DA FRONTEIRA 3
                DB::raw("USE [CabalCash]exec  up_AddMyCashItemByItem '".Auth::user()->UserNum."', '1', '1', '6433', '0', '17' ")
            );

            return response()->json([
                'success' => true,
                'message' => "Obrigado por efetuar a compra do VIP no Cabal Hype, Seu vip já foi ativado",
            ]);


        }

    }
}
