<?php 
	class LoginController extends MyController {
		private $loginModel;


		public function __construct() {
			$this->loginModel = new LoginModel();
		}

		public function login($username, $password) {
			$result = $this->loginModel->login($username, $password);

			if($result) {
				$_SESSION['CONNECTED'] = $username;
				MyController::redirect('index.php');
			}else{
				MyController::displayError('Identifiants incorrects');
			}
		}

	}
?>