<?php
require '../../pruebas/vendor/autoload.php';
class Event
{
    public function __construct()
    {
    }

    public function getClient()
    {
        $client = new Google_Client();
        $client->setApplicationName('Google Calendar API PHP MQ');
        $client->setScopes(Google_Service_Calendar::CALENDAR);
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

    public function newEvent($date1, $date2, $time1, $time2, $summary, $location, $description, $calendar)
    {
        $client = $this->getClient();
        $service = new Google_Service_Calendar($client);

        $event = new Google_Service_Calendar_Event(array(
            'summary' => $summary,
            'location' => $location,
            'description' => $description,
            'start' => array(
                'dateTime' => $date1 . 'T' . $time1 . '-05:00',
                'timeZone' => 'America/Bogota',
            ),
            'end' => array(
                'dateTime' => $date2 . 'T' . $time2 . '-05:00',
                'timeZone' => 'America/Bogota',
            )
        ));

        try {
            $calendarId = $calendar;
            $event = $service->events->insert($calendarId, $event);
        } catch (Google_Service_Exception $e) {
            echo "</br>Caught Google_Service_Exception: ";
            print_r($e->getMessage());
        }
    }
}
