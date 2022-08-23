<?php

namespace App\Http\Controllers;

use App\Http\Requests\PasswordChangeRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
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
        return view('painel.pages.profile.index');
    }

    public function updatePW(PasswordChangeRequest $request)
    {
        $account = Auth::user();
        // update password
        DB::select(DB::raw("EXEC Account.dbo.cabal_tool_strdeveloped_update_pw_web '$account->ID','$request->password'"));

        return response()->json([
            'success' => true,
            'message' => "Senha modificada com sucesso - Cabal Hype!",
        ]);
    }
}
