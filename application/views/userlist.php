      <!-- Online folks -->
      <h3>Online</h3>
      <ul class="online">
         <?php foreach($online_users as $online_user): ?>
            <li><?=$online_user['name']?></li>
         <?php endforeach?>
      </ul>
      <!-- Offline folks -->
      <h3>Offline</h3>
      <ul class="offline">
         <?php foreach($offline_users as $offline_user): ?>
            <li><?=$offline_user['name']?></li>
         <?php endforeach?>
      </ul>
