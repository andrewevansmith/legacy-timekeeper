<?php
   function timediff($in_time, $out_time)
   {
      if ($out_time == '0000-00-00 00:00:00') 
         return timespan(mysql_to_unix($in_time), time());
      return timespan(mysql_to_unix($in_time), mysql_to_unix($out_time));
   }
?>

<!DOCTYPE html>
<html>
<head>
   <title>Legacy Timekeeper</title> 
   <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/reset.css" />
   <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/tktime.css" />
   <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/admin.css" />
   <script type="text/javascript" src="<?=base_url()?>js/jquery.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
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
   <center>
   <h2 style="margin-top: 20px">This month</h2>
   <div id="report">
   <table border=0> 
      <tr class="bold">
      	<td>In</td>
      	<td>Out</td>
      	<td>Time worked</td>
      </tr>
      <?php foreach($punches as $punch): ?>
         <tr>
            <td><?=$punch['in_time']?></td>
            <td><?=$punch['out_time']?></td>
            <td><?=timediff($punch['in_time'], $punch['out_time'])?></td>
         </tr>
      <?php endforeach; ?>
   </table>
   </div>
   <h3>Work Total: <span><?=$total?></span></h3>
   </center>

<script type="text/javascript" src="<?=base_url()?>js/ntime.js"></script>
</body>
</html>
