<?php

	class users_controller extends base_controller {


		public function __construct() {
			parent::__construct();
			
		}

		public function index() {

			if($this->user) {
			#redirects users to their profile page if they go to the homepage	
        	Router::redirect('/users/profile');

        	}
    	
			#setup the view
			$this->template->content = View::instance('v_index_index');
			echo $this->template->title ="Welcome Page";

			#render the view
			echo $this->template;

		}


	

		public function signup($error = NULL) {
			#Setup the view
			$this->template->content = View::instance('v_users_signup');
			$this->template->title ="Sign Up";
			
			#If there is an issue with the signup this will update the view
			$this->template->content->error = $error;
      	  	
      	  	
			#render the view
			echo $this->template;

		}



		public function p_signup() {


		  #Checking for blank fields
        	foreach($_POST as $field => $value) {
            	if(empty($value) || ctype_space($value))  {
                	#If any fields are blank, send error message
                	Router::redirect('/users/signup/blank-fields');  
            		}
        		}       

       		 #checking to see if the email already exists in the db
       		 $exists = DB::instance(DB_NAME)->select_field("SELECT email FROM users WHERE email = '" . $_POST['email'] . "'");
			
			#if that email address does already exist
			if($exists) {
				Router::redirect('/users/signup/email-exists');
			}
				
			else {	
				
				     	
        			#DB info not submitted by the user
        			$_POST['created'] = Time::now();
					$_POST['modified'] = Time::now();
			
					#encript password and token
					$_POST['password'] =sha1(PASSWORD_SALT.$_POST['password']);
					$_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());

					#sotre the information into a var
					$users_id = DB::instance(DB_NAME)->insert("users", $_POST);

					#send them to a page so they can login and get postin
					Router::redirect('/users/login');

			}
		}
		
		

		public function profile($error = NULL) {

			#if statement determines if the user has the rights to access the content. If they don't they get redirect to an error message
			if(!$this->user) {

				Router::redirect('/users/membersonly');
			}

          
			#setup the view
			$this->template->content = View::instance('v_users_profile');
			#give the page a title
			$this->template->title = "Profile of ".$this->user->first_name;
			
			#If there is an issue with the signup this will update the view
			$this->template->content->error = $error;
			
			#render
			echo $this->template;


		}




		public function p_profile_update() {

			#this is the error checking for the profile updates so that people don't feed in blank fields or duplicate email address			
			foreach($_POST as $field => $value) {
            	if(empty($value)  || ctype_space($value))  {
                	#If any fields are blank, send error message
                	Router::redirect('/users/profile/blank-fields');  
            		}
        		}       

       		 #checking to see if the email already exists in the db
       		 $exists = DB::instance(DB_NAME)->select_field("SELECT email FROM users WHERE email = '" . $_POST['email'] . "'");
			
			#if that email address does already exist
			if($exists) {
				Router::redirect('/users/profile/email-exists');
			}
				
			else {	

			#create array based on what the users input to feed into the db	
			$data = Array(

				"user_id" => $this->user->user_id, 
				"first_name" => $_POST['first_name'], 
				"last_name" => $_POST['last_name'], 
				"email" => $_POST['email']
				);

			#insert into the db
	        $user_id = DB::instance(DB_NAME)->update_or_insert_row("users", $data);
			
			#refresh the page once the update is made
			Router::redirect('/users/profile');
			}
		}


		public function profile_photo () {

			#file name from user
			$image_name = $_FILES['avatar']['name'];
			#pulling the extension type off of the file to append to the new file name in the db
			$file_ext 	= substr($image_name, strrpos($image_name, '.'));
			#new image name 
			$avatar 	=	$this->user->user_id.$file_ext;	

			#upload to the /uploads/avatar directory 
			$upload = Upload::upload($_FILES, "/uploads/avatars/", array("gif", "jpeg", "jpg", "png"), $this->user->user_id);	 

			#test image compatibility
			if ($_FILES['avatar']['error'] == 0)
			{
	      			if($upload == "Invalid File Type") {
					Router::redirect("/users/profile/error");
				}
			
			else {

				#associate user_id with image name in db
				$data = Array("avatar" => $avatar);
				DB::instance(DB_NAME)->update("users", $data, "WHERE user_id = ".$this->user->user_id);

				#resize the image - could not get this to work did it with css
				//$imgObj = new Image(APP_PATH."/uploads/avatars/".$avatar);	
				//$imgObj->resize(180, 180);
				//$imgObj->save_image(APP_PATH."/uploads/avatars/".$avatar);	
				//$imgObj->display;
				}
			}
			else 
			   { 
		       	router::redirect("/users/profile/error");  
		       }

		        // Redirect back to the profile page
		        router::redirect('/users/profile'); 
		    }  


		
		    
		    

	    public function profile_error() {

	    	#setup the view
			$this->template->content=View::instance('v_users_profile_error');
			$this->template->title = "Profile Error";
			#render the view
			echo $this->template;
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


