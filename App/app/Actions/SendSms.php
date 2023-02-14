<?php

namespace App\Actions;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class SendSms
{
    public function AuthGatway(){
        $client = new Client();
        $options = [
            'multipart' => [
                [
                    'name' => 'email',
                    'contents' => 'salikhovr0508@gmail.com'
                ],
                [
                    'name' => 'password',
                    'contents' => 'xQefwAWYAFy5hB3c9U9govnnNySyvEZZvjndwj1M'
                ]
            ]
        ];
        $request = new Request('POST', 'notify.eskiz.uz/api/auth/login');
        $res = $client->sendAsync($request, $options)->wait();
        $response = json_decode($res->getBody());
        return ['token'=>$response->data->token ?? ''];
    }
    public function sendSms($phone, $text){
        $token = $this->AuthGatway();
        if($token['token']){
            $client = new Client();
            $headers = [
                'Authorization' => 'Bearer '.$token['token']
            ];
            $options = [
                'multipart' => [
                    [
                        'name' => 'mobile_phone',
                        'contents' => $phone
                    ],
                    [
                        'name' => 'message',
                        'contents' => $text
                    ],
                    [
                        'name' => 'from',
                        'contents' => '4546'
                    ]
                ]];
            $request = new Request('POST', 'notify.eskiz.uz/api/message/sms/send', $headers);
            $res = $client->sendAsync($request, $options)->wait();
            $response = json_decode($res->getBody());
            return $response;
        }
    }

}
