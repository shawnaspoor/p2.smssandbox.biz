<?php

class posts_controller extends base_controller {

   public function __construct() {
         parent::__construct();

        # Make sure user is logged in if they want to use anything in this controller
    	if(!$this->user) {
        	Router::redirect('/users/membersonly');
    	}
    }

	public function add() {

		$this->template->content = View::instance('v_posts_add');
		$this->template->title = "New Post";
		echo $this->template;

	}

	public function p_add() {
		$this->template->content = View::instance('v_posts_padd');
		$this->template->title = "Post Added";

		$_POST['user_id']  = $this->user->user_id;
		$_POST['created']  = Time::now();
		$_POST['modified'] = Time::now();


		DB::instance(DB_NAME)->insert('posts', $_POST);

		echo $this->template;
	}
	

	public function user_index() {
	
		$this->template->content = View::instance('v_profile_posts_index');

		
		$q = "SELECT
				posts.content,
				posts.created
				FROM posts
				WHERE user_id= ".$this->user->user_id;
		
	
		$posts = DB::instance(DB_NAME)->select_rows($q);

		$this->template->content->posts = $posts;

		echo $this->template;
	
	
	
	
	}

	public function index() {

		$this->template->content = View::instance('v_posts_index');
		$this->template->title = "Posts index";

		
   		$q = "SELECT 
	            posts.content,
	            posts.created,
	            posts.user_id AS post_user_id,
	            users_users.user_id AS follower_id,
	            users.first_name,
	            users.last_name
	        FROM posts
	        INNER JOIN users_users 
	            ON posts.user_id = users_users.user_id_followed
	        INNER JOIN users 
	            ON posts.user_id = users.user_id
	        WHERE users_users.user_id = ".$this->user->user_id;

			$posts = DB::instance(DB_NAME)->select_rows($q);

			$this->template->content->posts = $posts;

			echo $this->template;



	}

	public function users() {

		#setup the view
		$this->template->content = View::instance("v_posts_users");
		$this->template->title = "Users";

		#pull all the users
		$q = "SELECT *
        	FROM users
        	WHERE user_id!= ".$this->user->user_id;


		#store the results of the query into an array called $users
		$users = DB::instance(DB_NAME)->select_rows($q);

    	$q = "SELECT * 
       		FROM users_users
        	WHERE user_id = ".$this->user->user_id;

		#store the previous SQL query into a new array called $connections
		$connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');

		

		#pass all this info into the view so the end user can see it
		$this->template->content->users 		= $users;
		$this->template->content->connections   = $connections;

		echo $this->template;	
	}

	public function follow($user_id_followed) {

	    # Prepare the data array to be inserted
	    $data = Array(
	        "created" => Time::now(),
	        "user_id" => $this->user->user_id,
	        "user_id_followed" => $user_id_followed
	        );

	    # Do the insert
	    DB::instance(DB_NAME)->insert('users_users', $data);

	    # Send them back
	    Router::redirect("/posts/users");

}

	public function unfollow($user_id_followed) {

	    # Delete this connection
	    $where_condition = 'WHERE user_id = '.$this->user->user_id.' AND user_id_followed = '.$user_id_followed;

	    DB::instance(DB_NAME)->delete('users_users', $where_condition);

	    # Send them back
	    Router::redirect("/posts/users");

}
	
}