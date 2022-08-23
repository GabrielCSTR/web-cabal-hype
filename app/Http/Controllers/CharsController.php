<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddPointsCharRequest;
use App\Models\cabalCharacter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CharsController extends Controller
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

    public function index()
    {
        // $chars = cabalCharacter::all();
        $chars = cabalCharacter::where(DB::raw('CharacterIdx/8'), Auth::user()->UserNum)->get();
        return view('painel.pages.chars.index', compact('chars'));
    }

    public function addPoints(int $id, AddPointsCharRequest $request)
    {

        // total de pontos que vai ser distribuidos
        $calc = $request->FOR + $request->INT + $request->DES;

        $char = cabalCharacter::where(DB::raw('CharacterIdx/8'), Auth::user()->UserNum)
                                ->where('CharacterIdx', $id)
                                ->first();
        // TOTAL DE PONTOS DO CHAR
        $charPNT = $char->PNT;

        if(checkCharON($id))
        {
            return response()->json([
                'error' => true,
                'message' => "Atenção, Seu personagem '$char->Name' deve esta OFFLINE do JOGO para poder distribuir pontos!",
            ]);
        }

        if($request->FOR == 0 && $request->INT == 0 && $request->DES == 0)
        {
            return response()->json([
                'error' => true,
                'message' => "Atenção, Informe algum valor!",
            ]);
        }

        // Check se o valor de pontos é maior q o valor de pontos que o char tem
        if($charPNT == 0)
        {
            return response()->json([
                'error' => true,
                'message' => "Atenção, este personagem não tem pontos suficientes para serem adicionados.",
            ]);
        }

        if($charPNT < $calc)
        {
            return response()->json([
                'error' => true,
                'message' => "Atenção, este personagem não tem pontos suficientes para serem adicionados.",
            ]);
        }
        else
        {
            // UPDATE PONTOS
            $accountDB = cabalCharacter::where(DB::raw('CharacterIdx/8'), Auth::user()->UserNum)
                        ->where('CharacterIdx', $id)
                        ->update(
                            [
                                'STR' => $char->STR + $request->FOR,
                                'DEX' => $char->DEX + $request->DES,
                                'INT' => $char->INT + $request->INT,
                                'PNT' => $char->PNT - $calc,
                            ]
                            );
            if($accountDB)
            {
                return response()->json([
                    'success' => true,
                    'message' => 'Pontos adicionados com sucesso!',
                ]);
            }
            else
            {
                return response()->json([
                    'error' => true,
                    'message' => 'Falha erro -202!',
                ]);
            }
        }
    }

    public function cleanPK(int $id)
    {
        $char = cabalCharacter::where(DB::raw('CharacterIdx/8'), Auth::user()->UserNum)
                                ->where('CharacterIdx', $id)
                                ->first();

        if($char)
        {
            if(checkCharON($id))
            {
                return response()->json([
                    'error' => true,
                    'message' => "Atenção, Seu personagem '$char->Name' deve esta OFFLINE do JOGO para poder distribuir pontos!",
                ]);
            }

            // valor do PK
            $calcularPK = 2000 * $char->PKPenalty;

            if($char->Alz < $calcularPK)
            {
                return response()->json([
                    'error' => true,
                    'message' => "Atenção, você não possui alz suficiente para limpar sua punição!",
                ]);
            }
            elseif($char->PKPenalty == 0)
            {
                return response()->json([
                    'error' => true,
                    'message' => "Atenção, você não possui punição para limpar.",
                ]);
            }
            elseif(Auth::user()->AuthType ==2 || Auth::user()->AuthType==3)
            {
                return response()->json([
                    'error' => true,
                    'message' => "Atenção, sua conta está bloqueada não é possivel utiliza este sistema!",
                ]);
            }
            elseif(Auth::user()->AuthType ==4)
            {
                return response()->json([
                    'error' => true,
                    'message' => "Atenção, sua conta está temporariamente desativada , é necessário ativa-lá para utilizar esté sistema!",
                ]);
            }
            else
            {
                // LIMPAR PK
                // UPDATE
                $updatePK = cabalCharacter::where(DB::raw('CharacterIdx/8'), Auth::user()->UserNum)
                ->where('CharacterIdx', $id)
                ->update(
                    [
                        'Alz' => $char->Alz - $calcularPK,
                        'PKPenalty' => 0
                    ]
                );

                if($updatePK)
                {
                    return response()->json([
                        'success' => true,
                        'message' => 'Obrigado! sua penalidade foi limpa!',
                    ]);
                }
                else
                {
                    return response()->json([
                        'error' => true,
                        'message' => "Alerta, Falha ao tentar limpar o PK tente novamente -503!",
                    ]);
                }

            }
        }
        else
        {
            return response()->json([
                'error' => true,
                'message' => "Atenção, TENTATIVA DE BURLAR O SISTEMA, SEUS DADOS FORAM SALVOS :)",
            ]);
        }
    }
}
