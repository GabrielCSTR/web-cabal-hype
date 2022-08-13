<?php

namespace App\Http\Controllers;

use App\Models\cabalCharacter;
use App\Models\cabalGuild;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
}
