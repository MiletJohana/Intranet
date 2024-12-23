<?php

require '../../pruebas/vendor/autoload.php';

class Mail
{
    public function __construct()
    {
    }

    public function getClient()
    {
        $client = new Google_Client();
        $client->setApplicationName('Google Mail API PHP MQ');
        $client->setScopes(Google_Service_Gmail::MAIL_GOOGLE_COM);
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

    public function mqMessage($app, $message)
    {
        $body = '<html lang="en">
        <head>
            <link rel="stylesheet" href="https://intranet.masterquimica.com/resources/css/bootstrap-material-design.min.css">
            <script src="https://intranet.masterquimica.com/resources/js/jquery-3.2.1.slim.min.js"></script>
            <script src="https://intranet.masterquimica.com/resources/js/popper.js"></script>
            <script src="https://intranet.masterquimica.com/resources/js/bootstrap-material-design.js"></script>
            <style>
                @font-face {
                    font-family: "Product-Sans";
                    src: url("https://intranet.masterquimica.com/resources/font/product-sans/Product%20Sans%20Regular.ttf");
                }

                .product-sans {
                    font-family: "Product-Sans";
                }
            </style>
        </head>

        <body class="product-sans">
            <div class="container">
                <div class="row mt-4">
                    <div class="col-md-4 col-12 offset-md-4 px-5 pt-5 text-center">
                        <img src="https://intranet.masterquimica.com/resources/img/Logo_Master.png" class="img-fluid" alt="Logotipo Master Quimica">
                    </div>
                </div>
                <div class="row pt-2">
                    <div class="col-md-6 col-12 offset-md-3 text-center">
                        <h1>' . $app . '</h1>
                    </div>
                </div>

                <div class="row pt-2">
                    <div class="col-10 offset-md-1 text-center">
                        <div class="card">
                            <div class="card-body">
                                <p class="h5">' . $message . '</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </body>

        </html>';
        return $body;
    }

    public function createMessage($sender, $to, $subject, $text)
    {
        $messageText = $this->mqMessage("CRM", $text);
        $message = new Google_Service_Gmail_Message();

        $rawMessageString = "From: <{$sender}>\r\n";
        $rawMessageString .= "To: <{$to}>\r\n";
        $rawMessageString .= 'Subject: =?utf-8?B?' . base64_encode($subject) . "?=\r\n";
        $rawMessageString .= "MIME-Version: 1.0\r\n";
        $rawMessageString .= "Content-Type: text/html; charset=utf-8\r\n";
        $rawMessageString .= 'Content-Transfer-Encoding: quoted-printable' . "\r\n\r\n";
        $rawMessageString .= "{$messageText}\r\n";

        $rawMessage = strtr(base64_encode($rawMessageString), array('+' => '-', '/' => '_'));
        $message->setRaw($rawMessage);
        return $message;
    }

    public function createDraft($user, $message)
    {
        $client = $this->getClient();
        $service = new Google_Service_Gmail($client);

        $draft = new Google_Service_Gmail_Draft();
        $draft->setMessage($message);

        try {
            $draft = $service->users_drafts->create($user, $draft);
            print 'Draft ID: ' . $draft->getId();
        } catch (Exception $e) {
            print 'An error occurred: ' . $e->getMessage();
        }

        return $draft;
    }

    public function sendMessage($userId, $message)
    {
        $client = $this->getClient();
        $service = new Google_Service_Gmail($client);
        try {
            $message = $service->users_messages->send($userId, $message);
            //print 'Message with ID: ' . $message->getId() . ' sent.';
            print 'Correo enviado. <br>';
            return $message;
        } catch (Exception $e) {
            print 'An error occurred: ' . $e->getMessage();
        }

        return null;
    }

    function listMessages($userId, $params)
    {
        $client = $this->getClient();
        $service = new Google_Service_Gmail($client);

        $pageToken = NULL;
        $messages = array();
        $opt_param = array();
        array_push($opt_param, $params);
        do {
            try {
                if ($pageToken) {
                    $opt_param['pageToken'] = $pageToken;
                }
                $messagesResponse = $service->users_messages->listUsersMessages($userId, $opt_param);
                if ($messagesResponse->getMessages()) {
                    $messages = array_merge($messages, $messagesResponse->getMessages());
                    $pageToken = $messagesResponse->getNextPageToken();
                }
            } catch (Exception $e) {
                print 'An error occurred: ' . $e->getMessage();
            }
        } while ($pageToken);

        // foreach ($messages as $message) {
        //     print 'Message with ID: ' . $message->getId() . '<br/>';
        // }

        return $messages;
    }
}
