<!DOCTYPE html>
<html>
<head>
   <title>Legacy Timekeeper</title> 
   <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/reset.css" />
   <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/tktime.css" />
   <script type="text/javascript" src="<?=base_url()?>js/jquery.js"></script>
   <style type="text/css">
      div#loginbox { width: 200px; margin: 50px auto; background-color: #eee; padding: 10px; border: 1px solid #ccc; }
      div#loginbox input { display: block; margin-bottom: 15px;}
   </style>
</head> 
<body>
   <header>
   	<h1>Legacy Timekeeper</h1>
      <ul>
         <li><?=anchor('ntime', 'Home')?></li>
         <li><?=anchor('ntime/admin', 'Admin')?></li>
         <li><?=anchor('ntime/logout', 'Logout')?></li>
      </ul>
      <div class="clear"></div>
   </header>

   <div id="loginbox">
      
      Username:
      <input id="username" type="text" />
      Password:
      <input id="password" type="password" />
      
      <button id="clock">Clock in</button>
      <button id="login">Log in</button>
   
   </div>

<script type="text/javascript" src="<?=base_url()?>js/ntime.js"></script>
</body>
</html>
