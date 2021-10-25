<?php

declare(strict_types=1);

namespace App;

class calculations
{

    public function deleting_two_letters($data)
    {
        // $data['a'] = htmlentities($_GET['action'], ENT_QUOTES);

        // $data = $_GET['action'];
        dump($data);
        $score  = strlen($data);

        $score -= 2;

        $intA = 2;
        $a   = 0;
        for($int=1; $int<=$score; $int++) {
        $word_request['h'][$a] = $data[$intA];
        $a++;
        $intA++;
        }
        
        dump($word_request);
        echo $word_request;

        return $word_request;
    }

}