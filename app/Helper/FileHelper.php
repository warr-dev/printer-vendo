<?php

namespace App\Helper;

use Error;
use Illuminate\Support\Facades\Storage;

class FileHelper
{
    public static function getPdfPageColors($file_path)
    {
        // following command only works at linux
        if (ServerHelper::isOnWindows())
            throw new Error('Server doesnt support ink coverage');
        $out = shell_exec("gs -q  -o - -sDEVICE=inkcov  '$file_path'");
        if (strpos($out, 'error') !== false)
            throw new Error('an error occured');
        $a = explode("\n", $out);
        array_pop($a); //remove last part
        $output = [];
        $colored_counter = 0;
        $overly_colored = 0;
        $bw_counter = 0;
        $colored = [];
        $overlycolored = [];
        $bw = [];
        foreach ($a as $b => $c) {
            $output[$b] = explode('  ', $c);
            $cyan = floatval($output[$b][0]);
            $magenta = floatval($output[$b][1]);
            $yellow = floatval($output[$b][2]);
            // $black=substr($output[$b][3],0,strpos($output[$b][3],' '));
            // foreach(explode('  ',$c) as $colvals){
            //     if(int)
            // }
            if ($cyan > .5 || $magenta > .5 || $yellow > .5) {
                $overly_colored++;
                array_push($overlycolored, $b + 1);
            } else if ($cyan > 0 || $magenta > 0 || $yellow > 0) {
                $colored_counter++;
                array_push($colored, $b + 1);
            } else {
                $bw_counter++;
                array_push($bw, $b + 1);
            }
        }
        $result = [
            'page_count' => sizeof($output),
            'colored_count' => $colored_counter,
            'colored_pages' => $colored,
            'overly_colored_count' => $overly_colored,
            'overly_colored_pages' => $overlycolored,
            'bw_count' => $bw_counter,
            'bw_pages' => $bw,
        ];
        return $result;
    }
}
