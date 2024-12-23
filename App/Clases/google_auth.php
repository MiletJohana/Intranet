<?php
session_start();

class DB
{
	private $conn;

	public function __construct()
	{
		$connectionString = 'mysql:host=localhost;dbname=masterqu_intranet;charset=utf8';
		$username = 'masterqu_admin';

		try{
			$this->conn = new PDO($connectionString,$username,'Y24(2pyu)S');
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e){
			die('Connection failed:' .$e->getMessage());
		}
	}
	public function get_connection()
	{
		return $this->conn;
	}
}
class GoogleAuth
{
	protected $client;

	public function __construct(Google_Client $googleClient = null)
	{
		$this->client = $googleClient;
		if ($this->client) {
			$this->client->setClientId('1087073166425-h94ht99ckv2t2qr45bm4ehb15mb42tsl.apps.googleusercontent.com');
			$this->client->setClientSecret('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');
			$this->client->setRedirectUri('https://intranet.masterquimica.com/application/home/');
			$this->client->setScopes(array('https://www.googleapis.com/auth/userinfo.email', 'https://www.googleapis.com/auth/calendar', 'https://www.googleapis.com/auth/spreadsheets', 'https://mail.google.com/'));
		}
	}
	public function isLoggedIn()
	{
		return isset($_SESSION['access_token']);
	}
	public function getAuthUrl()
	{
		return $this->client->createAuthUrl();
	}
	public function checkRedirectCode()
	{
		if (isset($_GET['code'])) {
			$db = new DB();
			$conn = $db->get_connection();
			$this->client->authenticate($_GET['code']);
			$this->setToken($this->client->getAccessToken());
			$payload = $this->getPayload();
			$this->createUser($payload);
			$email = $payload['email'];
			$sql4 = "SELECT * FROM mq_usu where eml_usu='$email' AND usu_elim != 1";
			$stmt = $conn->prepare($sql4);
			$stmt->execute();
			if($stmt){
				$r4 = $stmt->fetch(PDO::FETCH_ASSOC);
				$_SESSION['id'] = $r4['id_usu'];
				return true;
			}
				return false;
		} 
		return false;
	}
	public function setToken($token)
	{
		$_SESSION['access_token'] = $token;
		$this->client->setAccessToken($token);
		/*try {
			$this->client->setAccessToken($token);
		} catch (PDOException $ex) { } finally {
			if($token == null){
				header('Location: ../../index.php');
			}
		}*/
	}
	public function logout()
	{
		unset($_SESSION['access_token']);
	}
	public function getPayload()
	{
		$payload = $this->client->verifyIdToken();
		return $payload;
	}
	public function createUser($payload)
	{
		$db = new DB();
		$conn = $db->get_connection();
		$email = $payload['email'];
		$sql2 = "SELECT * FROM mq_usu where eml_usu='$email' AND usu_elim != '1';";
		$stmt2 = $conn->prepare($sql2);
        $stmt2->execute();
        $r = $stmt2->fetch(PDO::FETCH_ASSOC);
		$id = $r['id_usu'];
		$identifier = $payload['sub'];

		try {
			$query = "INSERT INTO mq_log (social_id, id_usu) VALUES (?,?)";
			$stmt = $conn->prepare($query);
			$stmt->execute([$identifier, $id]);
		} catch (PDOException $ex) { } finally {
			if ($stmt !== null) {
				$stmt = null; 
			}
		}
	}
}

//  session_start();
//  class DB
//  {
//  	private $conn;

// 	public function __construct()
//  	{
//  		$this->conn = new mysqli('localhost', 'masterqu_admin', 'MASTER.2020', 'masterqu_intranet');
//  	}
// 	public function get_connection()
// 	{
// 		return $this->conn;
// 	}
// }
// class GoogleAuth
// {
// 	protected $client;

// 	public function __construct(Google_Client $googleClient = null)
// 	{
// 		$this->client = $googleClient;
// 		if ($this->client) {
// 			$this->client->setClientId('1087073166425-h94ht99ckv2t2qr45bm4ehb15mb42tsl.apps.googleusercontent.com');
// 			$this->client->setClientSecret('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');
// 			$this->client->setRedirectUri('https://intranet2.masterquimica.com/application/home/');
// 			$this->client->setScopes(array('https://www.googleapis.com/auth/userinfo.email', 'https://www.googleapis.com/auth/calendar', 'https://www.googleapis.com/auth/spreadsheets', 'https://mail.google.com/'));
// 		}
// 	}
// 	public function isLoggedIn()
// 	{
// 		return isset($_SESSION['access_token']);
// 	}
// 	public function getAuthUrl()
// 	{
// 		return $this->client->createAuthUrl();
// 	}
// 	public function checkRedirectCode()
// 	{
// 		if (isset($_GET['code'])) {
// 			$db = new DB();
// 			$conn = $db->get_connection();
// 			$this->client->authenticate($_GET['code']);
// 			$this->setToken($this->client->getAccessToken());
// 			$payload = $this->getPayload();
// 			$this->createUser($payload);
// 			$email = $payload['email'];
// 			$sql4 = "SELECT * FROM mq_usu where eml_usu='$email'";
// 			$query4 = $conn->query($sql4);
// 			$r4 = $query4->fetch_array();
// 			$_SESSION['id'] = $r4['id_usu'];
// 			return true;
// 		}
// 		return false;
// 	}
// 	public function setToken($token)
// 	{
// 		$_SESSION['access_token'] = $token;
// 		$this->client->setAccessToken($token);
// 	}
// 	public function logout()
// 	{
// 		unset($_SESSION['access_token']);
// 	}
// 	public function getPayload()
// 	{
// 		$payload = $this->client->verifyIdToken();
// 		return $payload;
// 	}
// 	public function createUser($payload)
// 	{
// 		$db = new DB();
// 		$conn = $db->get_connection();
// 		$email = $payload['email'];
// 		$sql2 = "SELECT * FROM mq_usu where eml_usu='$email'";
// 		$query2 = $conn->query($sql2);
// 		$r = $query2->fetch_array();
// 		$id = $r['id_usu'];
// 		$identifier = $payload['sub'];
// 		try {
// 			$query = "INSERT INTO mq_log (social_id, id_usu) VALUES (?,?)";
// 			$statement = $conn->prepare($query);
// 			$statement->bind_param("ss", $identifier, $id);
// 			$statement->execute();
// 		} catch (Exception $ex) { } finally {
// 			$statement->close();
// 			$conn->close();
// 		}
// 	}
// }

