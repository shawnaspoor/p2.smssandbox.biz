<?php

	class users_controller extends base_controller {


		public function __construct() {
			parent::__construct();
			
		}

		public function index() {
			echo "This is the index page";

		}

		public function signup() {
			#Setup the view
			$this->template->content = View::instance('v_users_signup');
			echo $this->template->title ="Sign Up";
			#render the view
			echo $this->template;

			echo "This is the signup page";

		}

		public function p_signup() {
			

			$_POST['created'] = Time::now();
			$_POST['password'] =sha1(PASSWORD_SALT.$_POST['password']);

			$_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());
 			
 			#echo"<pre>";
			#print_r($_POST);
			#echo"<pre>";

			 $users_id = DB::instance(DB_NAME)->insert("users", $_POST);

			Router::redirect('/users/login');

		}

		public function login() {


			#setup the view
			$this->template->content=View::instance('v_users_login');
			#render the view
			echo $this->template;
			#echo "This is the login page";



		}

		public function p_login() {


 			#echo"<pre>";
			#print_r($_POST);
			#echo"<pre>";
			
			#sanitize input to stop SQL attacks
			$_POST = DB::instance(DB_NAME)->sanitize($_POST);

			$_POST['password'] =sha1(PASSWORD_SALT.$_POST['password']);
   				 $q = "SELECT token 
        				FROM users 
       				 	WHERE email = '".$_POST['email']."' 
        				AND password = '".$_POST['password']."'";	

				echo $q;

			$token = DB::instance(DB_NAME)->select_field($q);

			#Success
			if($token) {
				setcookie('token', $token, strtotime('+1 day'),'/');

				echo "You are logged in";
			}
			#fail
			else {
				echo "Login failed";
			}

		}

		public function logout() {
			echo "This is the logout page";

		}



		public function profile($user = null) {
			#setup the view
			$this->template->content = View::instance('v_users_profile');
			#give the page a title
			$this->template->title = "Profile";
			#setup the client fild head
			$client_files_head = Array(
				'/css/profile.css',
				'/css/master.css'
				);
			$this->template->client_files_head = Utils::load_client_files($client_files_head);
			#setup the client fild body
			$client_files_body = Array(
				'/css/profile.js',
				'/css/master.js'
				);
			$this->template->client_files_body = Utils::load_client_files($client_files_body);
			#pass the data to the view
			$this->template->content->user=$user;

			#display the view
			echo $this->template;


			//$view = View::instance('v_users_profile');	
			//$view->user = $user;
			//echo $view;

			/*
			if($user_name == null) {
				echo "No user specified";
			}
			else {
				echo "This is the profile ".$user_name;
			}
			*/
		}


} #eoc