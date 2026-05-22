        <h3><?= $user['name'] ?></h3>
        <div class="hidden">
            <input type="hidden" id="userid" value="<?=$user['id']?>" />
            <input type="hidden" id="username" value="<?=$user['name']?>" />
            Password: <input type="password" id="password" name="password" />
            <?php if (isset($error)) echo "<p style='color:red;'>".$error."</p>"; ?>
            <?php 
                if ($user['active_punch'] != 0)
                {
                  $in_time = mysql_to_unix($this->n_time->get_in_time($user['id']));
                  $now = time();
                  $data = array();
                  $data['content'] = 'Clock out <span>('. timespan($in_time, time()) .')</span>';
                }
                else {
                  $data['content'] = "Clock in";
                }
                
                $data['id'] = $user['id'];
                $data['class'] = 'clock';

                echo form_button($data);
            ?>
            
        </div>
        
        
