<?php
require '../../pruebas/vendor/autoload.php';
class Sheets
{
    public function __construct()
    {
    }

    function getClient()
    {
        $client = new Google_Client();
        $client->setApplicationName('Google Sheets API PHP MQ');
        $client->setScopes(Google_Service_Sheets::SPREADSHEETS);
        $client->setAuthConfig('../../resources/utils/google-api/credentials.json');
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');

        $tokenPath = '../../resources/utils/google-api/token.json';
        if (file_exists($tokenPath)) {
            $accessToken = json_decode(file_get_contents($tokenPath), true);
            $client->setAccessToken($accessToken);
        }

        if ($client->isAccessTokenExpired()) {
            if ($client->getRefreshToken()) {
                $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            } else {
                $client->setAccessToken($_SESSION['access_token']['access_token']);

                if (array_key_exists('error', $accessToken)) {
                    throw new Exception(join(', ', $accessToken));
                }
            }
            if (!file_exists(dirname($tokenPath))) {
                mkdir(dirname($tokenPath), 0700, true);
            }
            file_put_contents($tokenPath, json_encode($client->getAccessToken()));
        }
        return $client;
    }

    public function newSpreadSheet($title)
    {
        $client = $this->getClient();
        $service = new Google_Service_Calendar($client);

        $spreadsheet = new Google_Service_Sheets_Spreadsheet([
            'properties' => [
                'title' => $title
            ]
        ]);
        $spreadsheet = $service->spreadsheets->create($spreadsheet, [
            'fields' => 'spreadsheetId'
        ]);
        return printf("Spreadsheet ID: %s\n", $spreadsheet->spreadsheetId);
    }
}

$sheets = new Sheets();
$sheets->newSpreadSheet('hoja prueba');
