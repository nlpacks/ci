<?php

  class securitycheck
  {
  	public function isLogin()
  	{
  		if (!isset($_SESSION["developer"]))
  		{
  			$host  = $_SERVER['HTTP_HOST'];
  			$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
  			$extra = 'index.html';
  			header("Location: http://$host$uri/$extra");
  			return;
  		}
  	}
  }
?>