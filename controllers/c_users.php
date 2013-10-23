<?php

	class users_controller extends base_controller {


		public function __construct() {
			parent::__construct();
			
		}

		public function index() {
			echo "This is the index page";

		}

		public function signup() {
			echo "This is the signup page";

		}

		public function login() {
			echo "This is the login page";

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