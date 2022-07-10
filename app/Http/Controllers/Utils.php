<?php

namespace App\Http\Controllers;

trait Utils
{
    public function getDayRedaction(int $number)
    {
        switch (strtolower($number)) {
            case 2:
                $dayRedaction = 'selasa';
                break;
            case 3:
                $dayRedaction = 'rabu';
                break;
            case 4:
                $dayRedaction = 'kamis';
                break;
            case 5:
                $dayRedaction = 'jumat';
                break;
            case 6:
                $dayRedaction = 'sabtu';
                break;
            case 7:
                $dayRedaction = 'minggu';
                break;
            default:
                $dayRedaction = 'senin';
        }
        return $dayRedaction;
    }

    public function sendWa($text, $phone)
    {
        $key = env('WOOWA_KEY'); //this is demo key please change with your own key
        $url = 'http://116.203.191.58/api/async_send_message';
        $data = array(
            "phone_no"  => $phone,
            "key"       => $key,
            "message"   => $text,
            "skip_link" => True // This optional for skip snapshot of link in message
        );
        $data_string = json_encode($data);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 360);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string)
            )
        );
        // echo $res = curl_exec($ch);
        curl_close($ch);
    }
}
