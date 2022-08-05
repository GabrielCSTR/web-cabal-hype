<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $IP = $_SERVER['REMOTE_ADDR'];
        $chave = Str::random(10);

        // cria novo usuario cabal
        $createAccount = DB::select(
            DB::raw("SET NOCOUNT ON;EXEC Account.dbo.cabal_tool_strdeveloped_register_web '$request->ID','$request->password','$request->email',
            '$chave', '$IP'")
        );

        return response()->json([
            'success' => true,
            'message' => "Olá, $request->ID. Sua conta foi criada com sucesso, agradecemos a preferencia, tenha um bom jogo",
        ]);

    }
}
