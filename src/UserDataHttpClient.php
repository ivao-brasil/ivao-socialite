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

    public function getUserFromToken(string $token, ?string $apiUrl): array
    {
        if ($token === 'error') {
            throw new DomainNotAllowedException();
        }
        $apiUrl = $apiUrl ?? self::IVAO_LOGIN_API_URL;

        $response = $this->http->request("GET", $apiUrl, [
            'query' => [
                "token" => $token,
                "type" => "json"
            ]
        ]);

        $content = json_decode($response->getBody(), true);

        return ($content && array_key_exists("result", $content) && $content["result"]) ? $content : [];
    }
}
