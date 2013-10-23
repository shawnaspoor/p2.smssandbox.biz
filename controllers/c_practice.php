<?php

class practice_controller extends base_controller {


	public function test_db() {
		/*	
		# SQL command
		$q = "INSERT INTO users SET
				first_name='Sam',
				last_name ='Seaborn',
				email='seaborn@whitehouse.gov'";

		echo $q;
				
		#Run the command
		echo DB::instance(DB_NAME)->query($q);

		*/
		#SQL Command update
		/* 
		$q = "DELETE FROM users
			WHERE email = 'seaborn@whitehouse.gov'";

		#Run the Command
		echo DB::instance(DB_NAME)->query($q);

        */
        /*
		$new_user = Array (
			'first_name'=>'Albert',
			'last_name'=>'Einstein',
			'email'=>'albert@gmail.com',
			);
			DB::instance(DB_NAME)->insert('users',$new_user);	

			*/
		/*	
		$q = 'SELECT email
		FROM users
		WHERE users_id=1';

		echo DB::instance(DB_NAME) -> select_field($q);
		*/
		$_POST['first_name']='Albert';
		$_POST=DB::instance(DB_NAME)->sanitize($_POST);
		$q = 'SELECT email
			FROM users
			WHERE first_name = " '.$_POST['first_name']'"';
	}




/*--------------------------------------------------------------------------------------------------------------------------------*/


	public function test1() {
		require(APP_PATH.'/libraries/Image.php');

		$imageObj =  new Image ('http://www.placekitten.com/1000/1000');

		$imageObj->resize(200, 200);

		$imageObj->display();
}

	public function test2() {
		#Static calling of method
		echo Time::now();
	}
}

