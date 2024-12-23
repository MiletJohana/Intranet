<?php

require $_SERVER['DOCUMENT_ROOT'] . "/pruebas/vendor/autoload.php";



class SpreadSheet

{

    public function __construct()

    {

    }



    public function getClient()

    {

        $client = new Google_Client();

        $client->setApplicationName('Google Sheets API PHP MQ');

        $client->setScopes(Google_Service_Sheets::SPREADSHEETS_READONLY);

        $client->setAuthConfig($_SERVER['DOCUMENT_ROOT'] . '/resources/utils/google-api/credentials.json');

        $client->setAccessType('offline');

        $client->setPrompt('select_account consent');

    

        $tokenPath = $_SERVER['DOCUMENT_ROOT'] . '/resources/utils/google-api/token.json';

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



    public function getDataFromSheet($spreadsheetId, $range)

    {

        // Get the API client and construct the service object.

        $client = $this->getClient();

        $service = new Google_Service_Sheets($client);

    

        // Prints the names and majors of students in a sample spreadsheet:

        $response = $service->spreadsheets_values->get($spreadsheetId, $range);

        $values = $response->getValues();

    

        if (empty($values)) {

            print "No data found.\n";

        } else {

            //print_r($values);

            // foreach ($values as $row) {

            //     // Print columns A and E, which correspond to indices 0 and 4.

            //     printf("%s, %s\n", $row[0], "\n");

            // }

            return $values;

        }

    }

}

