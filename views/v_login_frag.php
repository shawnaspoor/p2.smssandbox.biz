<h2> Login</h2>
<form  class="form-horizontal" method="POST" action="/users/p_login">
	<div class="control-group">
		<label class ="control-label" for='inputemail'>Email &nbsp; </label>
			<div class="controls">
				<input type="text" id="inputemail" name="email" placeholder="Email">
			</div>
	</div>
	<div class="control-group">
		<label class ="control-label" for="inputpassword">Password &nbsp; </label>
			<div class="controls">
				<input type="password" id="inputpassword" name="password" placeholder="Password">

			</div>
	</div>

	<div class="control-group">
		<div class="controls">
			<button type="submit" class="btn btn-success" value="Log In">Submit</button>
		</div>
	</div>

</form>

