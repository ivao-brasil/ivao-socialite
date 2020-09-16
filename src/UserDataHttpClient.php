<?php


namespace IvaoSocialite;


class UserDataHttpClient
{
    private const IVAO_LOGIN_API_URL = "https://login.ivao.aero/api.php";

    public function getUserFromToken(string $token): array
    {
        $response = json_decode(file_get_contents(self::IVAO_LOGIN_API_URL . "?" . http_build_query([
                "token" => $token,
                "type" => "json"
            ])), true);

        return array_key_exists("result", $response) && $response["result"] ? $response : [];
    }
}