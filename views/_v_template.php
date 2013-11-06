<!DOCTYPE html>
<html>
<head>
	<title><?php if(isset($title)) echo $title; ?></title>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
					
	<!-- Controller Specific JS/CSS -->
	<?php if(isset($client_files_head)) echo $client_files_head; ?>

	<!--the css link out would go here-->
	 <!-- CSS -->
    <link href="/css/css-bootstrap/bootstrap.css" rel="stylesheet">
    <style type="text/css">

      /* Sticky footer styles
      -------------------------------------------------- */

      html,
      body {
        height: 100%;
        /* The html and body elements cannot have any padding or margin. */
      }

      /* Wrapper for page content to push down footer */
      #wrap {
        min-height: 100%;
        height: auto !important;
        height: 100%;
        /* Negative indent footer by it's height */
        margin: 0 auto -60px;
      }

      /* Set the fixed height of the footer here */
      #push,
      #footer {
        height: 60px;
      }
      #footer {
        background-color: #f2f2f2;

      }

      /* Lastly, apply responsive CSS fixes as necessary */
      @media (max-width: 767px) {
        #footer {
          margin-left: -20px;
          margin-right: -20px;
          padding-left: 20px;
          padding-right: 20px;
        }
      }



      /* Custom page CSS
      -------------------------------------------------- */
      /* Not required for template or sticky footer method. */

      #wrap > .container {
        padding-top: 60px;
      }
      .container .credit {
        margin: 20px 0;
      }

      a {
        display: inline-block;
        padding-right: 20px;

      }

      code {
        font-size: 80%;
      }

    </style>
	<link rel="stylesheet" media="screen" href="/css/css-bootstrap/bootstrap-responsive.css" />
	
</head>

<body>	
	<div id="wrap">
	<!---top navbar fixed to the top of the page-->
      <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
          <div class="container">
            <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="brand" href="/">Now that you mention it...</a>
            <div class="nav-collapse collapse">
              <ul class="nav">
                <li><a href="/users/signup">Sign up</a></li>
                <li><a href="/users/login">Log in</a></li>
                <li><a href="/users/profile">Profile</a></li>

                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Posts<b class="caret"></b></a>
                  <ul class="dropdown-menu">
                    <li><a href="/posts/add">Add a new post</a></li>
                     <li><a href="/posts/user_index">Previous posts</a></li>
                    <li><a href="/posts/index">Feed</a></li>
                    <li><a href="/posts/users">Peeps to follow (not marshmallows, sorry)</a></li>
                  </ul> 
                </li>
                <li><a href="/users/logout">Logout</a></li>     
              </ul>
            </div><!--/.nav-collapse -->
          </div>
        </div>
      </div>
       <div class="container">

		<?php if(isset($content)) echo $content; ?>

		<?php if(isset($client_files_body)) echo $client_files_body; ?>
		
	 </div>

      <div id="push"></div>
    </div>

    <div id="footer">
      <div class="container">
        <p class="muted credit"><a href="#">About</a> <a href="#">Help</a> <a href="#">Privacy</a> <a href="#">Terms</a></p>
      </div>
    </div>



    <!-- javascript - Placed at the end of the document so the pages load faster -->

    <script src="/js/js-bootstrap/jquery.js"></script>
    <script src="/js/js-bootstrap/bootstrap-transition.js"></script>
    <script src="/js/js-bootstrap/bootstrap-alert.js"></script>
    <script src="/js/js-bootstrap/bootstrap-modal.js"></script>
    <script src="/js/js-bootstrap/bootstrap-dropdown.js"></script>
    <script src="/js/js-bootstrap/bootstrap-scrollspy.js"></script>
    <script src="/js/js-bootstrap/bootstrap-tab.js"></script>
    <script src="/js/js-bootstrap/bootstrap-tooltip.js"></script>
    <script src="/js/js-bootstrap/bootstrap-popover.js"></script>
    <script src="/js/js-bootstrap/bootstrap-button.js"></script>
    <script src="/js/js-bootstrap/bootstrap-collapse.js"></script>
    <script src="/js/js-bootstrap/bootstrap-carousel.js"></script>
    <script src="/js/js-bootstrap/bootstrap-typeahead.js"></script>

  </body>
</html>