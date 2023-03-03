<?php

namespace EngMahmoudElgml\GoogleIntegration;

class GoogleConnection
{

    protected $client;
    protected $service;

    public function __construct()
    {
        $this->client = new \Google_Client();
        $this->client->setAuthConfig(base_path(). '/credentials.json' );
        $tokenPath =base_path(). '/token.json' ;
        if (file_exists($tokenPath)) {
            $accessToken = json_decode(file_get_contents($tokenPath), true);
            $this->client->setAccessToken($accessToken);

            if ($this->client->isAccessTokenExpired()){
                $this->client->fetchAccessTokenWithRefreshToken($this->client->getRefreshToken());
            }

        }else{
            dd("There Is No Token File") ;
            /*TODO::throw Exception*/
        }
    }

    protected function getClient(){
        return $this->client ;
    }

}
