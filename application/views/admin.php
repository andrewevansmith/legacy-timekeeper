<?php include("upload.php") ?>
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

   <aside id="userlist"><!-- User List -->
      <!-- Online folks -->
      <h3>Online Users</h3>
      <ul class="online">
         <?php if (count($online_users) == 0) echo "<span style='font-size: 11px; font-style: italic;'>No users online</span>"; ?>
         <?php foreach($online_users as $online_user): ?>
            <li><?=$online_user['name']?></li>
         <?php endforeach?>
      </ul>
   </aside><!-- End User List --> 

   <div id="main"><!-- List of tools -->
      <ul class="tools">
         <li>
            <img src="<?=base_url()?>images/icons/add-user.png" alt="placeholder" />
            <h5><a class="box" href="#adduser">Add User</a></h5>
            <div style='display: none;'>
            <div id="adduser">
               <h3>Add a User</h3>
               <div class="left"> Name <input type="text" id="name" /> 
                  Password <input type="password" id="password" /> 
                  Email <input type="text" id="email" />
                  <input type="hidden" value="blank.png" id="user_image" />
                  <button id="usersubmit">Submit</button>
               <button class="close">Exit</button>
               </div>
               <div class="left">
                  <img id="usrphoto" src="<?=base_url()?>images/people/blank.png" alt="blank" />
                  <form action="" target="upload_iframe" method="post" enctype="multipart/form-data">
                     <input type="hidden" name="fileframe" value="true">
                     <input type="file" name="file" id="file" onChange="jsUpload(this)">
                  </form>
                  <span style="color:green" id="uploadprogress"></span>
               </div>
            </div>
            </div>
         </li>
         <li>
            <img src="<?=base_url()?>images/icons/delete-user.png" alt="placeholder" />
            <h5><a class="box" href="#removeuser">Remove Users</a></h5>
            <div style="display:none">
            <div id="removeuser">
               <h3>Remove User(s)</h3>
            	<ul id="removelist">
                  <?php foreach ($online_users as $user):?>
                     <li id="<?=$user['id']?>">
                        <?= $user['name'] ?>
                        <input type="hidden" id="<?=$user['id']?>" value="<?=$user['id']?>" />
                        <span class="remove">(remove)</span>
                     </li>
                  <?php endforeach; ?>
                  <?php foreach ($offline_users as $user):?>
                     <li id="<?=$user['id']?>">
                        <?= $user['name'] ?>
                        <input type="hidden" value="<?=$user['id']?>" />
                        <span class="remove">(remove)</span>
                     </li>
                  <?php endforeach; ?>
               </ul>
               <button class="close">Exit</button>
            </div>
            </div>
         </li>
         <li>
            <img src="<?=base_url()?>images/icons/view.png" alt="placeholder" />
            <h5><a class="box" href="#timesheets">View Timesheets</a></h5>
            <div style="display:none">
            <div id="timesheets">
               <h3>View Timesheets</h3>
            	<ul id="removelist">
                  <?php foreach ($online_users as $user):?>
                     <li id="<?=$user['id']?>">
                        <?= $user['name'] ?>
                        <span class="remove"><?=anchor('ntime/hours_report/'.$user['id'], '(view)')?></span>
                     </li>
                  <?php endforeach; ?>
                  <?php foreach ($offline_users as $user):?>
                     <li id="<?=$user['id']?>">
                        <?= $user['name'] ?>
                        <span class="remove"><?=anchor('ntime/hours_report/'.$user['id'], '(view)')?></span>
                     </li>
                  <?php endforeach; ?>
               </ul>
               <button class="close">Exit</button>
            </div>
            </div>
         </li>
      </ul>
   </div><!-- End list of tools -->

<script type="text/javascript" src="<?=base_url()?>js/ntime.js"></script>
<script type="text/javascript">


   $("a.box").fancybox({
      'scrolling' : 'no',
   });

   $('#usersubmit').click( function() {

      var form_data = 
      {
         name: $('#name').val(),
         email: $('#email').val(), 
         password: $('#password').val(),
         image: $('#user_image').val()
      };

      $.ajax(
      {
         url: "<?=site_url('ntime/add_user')?>",
         type: 'POST',
         data: form_data,
         success: function(msg) 
         {
            window.location.reload();
         }
      });
      // Stops form from submitting 
      return false; 
   });

   $('button').click( function() { $.fancybox.close(); })
   $('.close').click( function() { window.location.reload(); })

   $('#removelist li').click( function() {
      var id = $(this).attr('id');

      var form_data = 
      {
         id: id
      };

      $.ajax(
      {
         url: "<?=site_url('ntime/remove_user')?>",
         type: 'POST',
         data: form_data,
         success: function(msg) 
         {
            window.location.reload();
         }
      }); 
   })



</script>
<iframe name="upload_iframe" style="width: 400px; height: 100px; display: none;"></iframe>
<script type="text/javascript" src="<?=base_url()?>js/upload.js"></script>

</body>
</html>
