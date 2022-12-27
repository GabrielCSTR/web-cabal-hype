<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Jobs\SendWelcomeEmail;
use App\Models\cabalAuth;
use App\Models\User;
use App\Notifications\WelcomeEmailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{

    public function login(LoginRequest $request)
	{

        // get account
        $account = cabalAuth::where('ID', $request->ID)->first();

        // check account banned
        if($account && $account->AuthType ==2 || $account->AuthType==3)
        {
            return response()->json([
                'error' => true,
                'message' => "Atenção, sua conta está bloqueada não é possivel fazer login!",
            ]);
        }

        // VALIDACAO SE EXISTE EMAIL NA CONTA
        if(!$account->Email)
        {
            return response()->json([
                'error' => true,
                'message' => "Atenção, Você precisa de email valido para poder acessar o painel. Caso tenha duvidas entre em contato com o ADM!",
            ]);
        }

        // check login
        $loginAccount = collect(DB::select(
            DB::raw("EXEC Account.dbo.cabal_tool_strdeveloped_login_web '$account->UserNum','$request->password'")
        )[0])->implode(':');


        if($loginAccount == 1)
        {
            // Auth login
            Auth::loginUsingId($account->UserNum, true);

            return response()->json([
                'success' => true,
                'message' => "Logado com sucesso, Seja bem vindo ao painel user - Cabal Hype!",
            ]);
        }
        else
        {
            return response()->json([
                'error' => true,
                'message' => "Atenção, Informações de Login incorretas!",
            ]);
        }

        // return redirect()->route('home')->with('success', 'Logado com sucesso!');
	}

    public function register(RegisterRequest $request)
    {
        $IP = $_SERVER['REMOTE_ADDR'];
        $chave = Str::random(10);

        // cria novo usuario cabal
        $createAccount = DB::select(
            DB::raw("SET NOCOUNT ON;EXEC Account.dbo.cabal_tool_strdeveloped_register_web '$request->ID','$request->password','$request->email',
            '$chave', '$IP'")
        );

        $user = cabalAuth::where('ID', $request->ID)->first();
        // email data
        $email_data = array(
            'name'  => $request->ID,
            'email' => $request->email,
            'subject' => 'CADASTRO - GAMES HYPE',
            'link'  => route('web.active', ['key' => $chave, 'account' => $user->UserNum])
        );

        SendWelcomeEmail::dispatch($email_data);
        // send email with the template
        // Mail::send('welcome_email', $email_data, function ($message) use ($email_data) {
        //     $message->to($email_data['email'], $email_data['name'])
        //         ->subject('CADASTRO - GAMES HYPE')
        //         ->from('suporte@gameshype.com.br', 'Suporte Games Hype');
        // });
        //$user->notify(new WelcomeEmailNotification());
        //dd($user);

        return response()->json([
            'success' => true,
            'message' => "Olá, $request->ID. Sua conta foi criada com sucesso, agradecemos a preferencia, tenha um bom jogo",
        ]);

    }

    public function logout()
    {
        Auth::logout();
	    return redirect()->route('web.home');
    }
}