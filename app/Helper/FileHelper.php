<?php

namespace App\Helper;

use Error;
use Illuminate\Support\Facades\Storage;

class FileHelper
{
    public static function getPdfPageColors($file_path)
    {
        if(ServerHelper::isOnWindows())
            throw new Error('Server doesnt support ink coverage');
        $out = shell_exec("gs -q  -o - -sDEVICE=inkcov  '$file_path'");
        if (strpos($out, 'error') !== false)
            throw new Error('an error occured');
        $a = explode("\n", $out);
        $asd = array_pop($a);
        $output = [];
        $colored_counter = 0;
        $bw_counter = 0;
        $colored = [];
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
            if ($cyan > 0 || $magenta > 0 || $yellow > 0) {
                $colored_counter++;
                array_push($colored, $b + 1);
            } else {
                $bw_counter++;
                array_push($bw, $b + 1);
            }
        }
        $result = [
            'pages' => sizeof($output),
            'colored' => $colored_counter,
            'bw_counter' => $bw_counter,
            'bwpages' => $bw,
            'colored_pages' => $colored
        ];
        return $result;
    }
}
