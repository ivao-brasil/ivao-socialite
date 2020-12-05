<?php


namespace IvaoSocialite;


use GuzzleHttp\ClientInterface;
use IvaoSocialite\Exception\DomainNotAllowedException;

class UserDataHttpClient
{
    private const IVAO_LOGIN_API_URL = "https://login.ivao.aero/api.php";
    private $http;

    public function __construct(ClientInterface $http)
    {
        $this->http = $http;
    }

    public function getUserFromToken(string $token): array
    {
        if ($token === 'error') {
            throw new DomainNotAllowedException();
        }
        
        $response = $this->http->request("GET", self::IVAO_LOGIN_API_URL, [
            'query' => [
                "token" => $token,
                "type" => "json"
            ]
        ]);

        $content = json_decode($response->getBody(), true);

        return ($content && array_key_exists("result", $content) && $content["result"]) ? $content : [];
    }
}
