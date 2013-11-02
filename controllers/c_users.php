<?php

	class users_controller extends base_controller {


		public function __construct() {
			parent::__construct();
			
		}

		public function index() {

			if($this->user) {

        	Router::redirect('/users/profile');

        	}
    	
			#setup the view
			$this->template->content = View::instance('v_index_index');
			echo $this->template->title ="Welcome Page";




			#render the view
			echo $this->template;

		}


	

		public function signup() {
			#Setup the view
			$this->template->content = View::instance('v_users_signup');
			echo $this->template->title ="Sign Up";
			#render the view
			echo $this->template;

			

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

		public function login($error=NULL) {


			#setup the view
			$this->template->content=View::instance('v_users_login');
			$this->template->title = "Login";

			$this->template->content->error = $error;
			#render the view
			echo $this->template;


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

				#echo $q;

			$token = DB::instance(DB_NAME)->select_field($q);

			#Success
			if(!$token) {
				Router::redirect('/users/login/error');
			}
			#fail
			else {
							
				setcookie('token', $token, strtotime('+1 week'),'/');
				Router::redirect('/users/profile');
				#echo "You are logged in";
			}

		}


		public function logout() {
			# Generate and save a new token for next login
		    $new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());

		    # Create the data array we'll use with the update method
		    # In this case, we're only updating one field, so our array only has one entry
		    $data = Array("token" => $new_token);

		    # Do the update
		    DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");

		    # Delete their token cookie by setting it to a date in the past - effectively logging them out
		    setcookie("token", "", strtotime('-1 year'), '/');

		    # Send them back to the main index.
		    Router::redirect("/");

		}



		public function profile() {

			if(!$this->user) {

				Router::redirect('/users/membersonly');
			}

			#setup the view
			$this->template->content = View::instance('v_users_profile');
			#give the page a title
			$this->template->title = "Profile of ".$this->user->first_name;
			

			#setup the client fild head
			/* $client_files_head = Array(
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
			$this->template->content->user_name=$user_name;
			*/
			#display the view
			echo $this->template;

			
			//$view = View::instance('v_users_profile');	
			//$view->user = $user;
			//echo $view;

			
			//if($user_name == null) {
			//	echo "No user specified";
			//}
			//else {
			//	echo "This is the profile ".$user_name;
			//}
			
		}

		public function membersonly() {
			#setup the view
			$this->template->content = View::instance('v_users_membersonly');
			 #pushing other views to this page
			$this->template->content->loginfrag = View::instance('v_login_frag');
			$this->template->content->signupfrag = View::instance('v_signup_frag');   		

			#give the page a title
			$this->template->title = "Members Only";
			#display the view
			echo $this->template;

		}


} #eoc