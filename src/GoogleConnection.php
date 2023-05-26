<?php

namespace EngMahmoudElgml\GoogleIntegration;


class GoogleConnection
{

    protected $client;
    protected $service;

    protected $token = [] ;

    public function __construct($token = [])
    {
        if (count($token) > 0 )
            $this->token = $token;
        else $this->token = config('google.token');
        $credentials = config('google.credentials');


        $this->client = new \Google_Client();

        $this->client->setAuthConfig($credentials);
        $this->client->setAccessToken($this->token);
        $this->client->setAccessType('offline');
        $this->client->setPrompt('select_account consent');

        if ($this->client->isAccessTokenExpired()){
                $this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());
        }

    }

    public function getClient(){
        return $this->client ;
    }

    public function get_auth_url(){
        $this->client->setScopes(['https://www.googleapis.com/auth/spreadsheets' ,
            'https://www.googleapis.com/auth/drive' , 'https://www.googleapis.com/auth/drive' ,
            'https://www.googleapis.com/auth/drive.appdata' ,'https://www.googleapis.com/auth/drive.file'
            ,'https://www.googleapis.com/auth/drive.scripts']);

        //$this->client->setAccessToken();

        return $this->client->createAuthUrl();
    }




}
