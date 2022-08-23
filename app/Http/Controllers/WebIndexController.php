<?php

namespace App\Http\Controllers;

use App\Models\cabalAuth;
use App\Models\cabalCharacter;
use App\Models\cabalGuild;

class WebIndexController extends Controller
{
    public function index()
    {
        // ranking
        $rankings = cabalCharacter::where('Nation', '!=', '3')
                                ->where('LEV', '<', '200')
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

        return view('web.index', compact('rankings', 'guilds', 'playersON'));
    }

    public function download()
    {
        // ranking
        $rankings = cabalCharacter::where('Nation', '!=', '3')
                ->where('LEV', '<', '200')
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
                ->where('LEV', '<', '200')
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
                ->where('ID', $account)
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
            $user = cabalAuth::where('ID', $account)
                            ->whereNull('is_active')
                            ->first();
            // check user exist
            if($user)
            {
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
}
