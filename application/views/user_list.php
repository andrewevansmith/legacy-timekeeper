<!DOCTYPE html>
<html>
<head>
   <title>Legacy Timekeeper</title> 
   <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/reset.css" />
   <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/tktime.css" />
   <script type="text/javascript" src="<?=base_url()?>js/jquery.js"></script>
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
   <ul>
    <?php foreach ($users as $user): ?>
      <li id="<?=$user['id']?>">
        <h3><?=$user['name']?></h3>
        <div class="hidden">
            <input type="hidden" id="id" value="<?=$user['id']?>" />
            <input type="hidden" id="username" value="<?=$user['name']?>" />
            Password: <input type="password" id="password" name="password" />
            <?php 
                if ($user['active_punch'] != 0)
                {
                  $in_time = mysql_to_unix($this->n_time->get_in_time($user['id']));
                  $now = time();
                  $data = array();
                  $data['content'] = 'Clock out <span>(' . timespan($in_time, time()) . ')</span>';
                }
                else $data['content'] = "Clock in";
                
                $data['id'] = $user['id'];
                $data['class'] = 'clock';
                echo form_button($data);
            ?>        
        </div>
      </li>
    <?php endforeach; ?>   
  </ul>

<script type="text/javascript" src="<?=base_url()?>js/ntime.js"></script>
</body>
</html>
