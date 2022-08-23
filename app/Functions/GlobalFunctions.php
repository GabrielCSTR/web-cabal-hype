<?php

use App\Models\cabalCharacter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

    function getClass($style)
    {
       return ($style / 1 & 7);
    }

    function formatReputation($str)
    {

       $formatted = preg_replace('/,000+/', '', $str);
       $formatted .= "0 M";
       return  $formatted;
    }

    function getClassName($style)
    {
        $classeChar_name = array(
			1=>'GU',
			2=>'DU',
			3=>'MA',
            4=>'AA',
            5=>'GA',
			6=>'EA',
        );

        $classID = ($style / 1 & 7);

        return $classeChar_name[$classID];
    }

    function checkCharON($charIdx)
    {
        $char = cabalCharacter::where(DB::raw('CharacterIdx/8'), Auth::user()->UserNum)
                                ->where('CharacterIdx', $charIdx)
                                ->first();
        if($char->Login) return true; else return false;
    }
