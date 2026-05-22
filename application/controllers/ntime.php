<?php

class nTime extends Controller 
{
   protected $home_view = "login";

   function nTime()
   {
      parent::Controller();	
      $this->load->model('n_time');
   }

   function index()
   { 
      $data['users'] = $this->n_time->get_users();
      $this->load->view($this->home_view, $data);
   }

   function hours_report()
   {
      $id = $this->uri->segment(3);
      $data['user'] = $this->n_time->get_user_by_id($id);
      $data['punches'] = $this->n_time->get_punches_by_id($id);
      $data['total'] = $this->get_total_hours($data['punches']);
      $this->load->view('hours', $data);
   }

   function admin()
   {
      $data['online_users'] = $this->n_time->get_online_users();
      $data['offline_users'] = $this->n_time->get_offline_users();
      $this->load->view('admin', $data);
   }

   function get_total_hours($punches)
   {
      $total_time = 0;
      foreach ($punches as $punch)
      {
         $in_time = mysql_to_unix($punch['in_time']);
         $out_time = mysql_to_unix($punch['out_time']);
         if ($punch['out_time'] == '0000-00-00 00:00:00') $out_time = time();
         $seconds = $out_time - $in_time;
         $total_time += $seconds;
      }
      return $this->seconds_to_hours($total_time);
   }

   function punch() // Needs extensive testing
   {
      if (!$this->valid_credentials($_POST['user_id'], $_POST['password']))
      {
         $data['user'] = $this->n_time->get_user_by_id($_POST['user_id']);
         $data['error'] = "Incorrect password";
         $this->load->view('listitem', $data);
         return;
      }
      unset($_POST['password']);
      if ($this->clocked_in($_POST['user_id'])) $this->n_time->clock_out($_POST['user_id']);
      else $this->n_time->clock_in($_POST); 
      $data['user'] = $this->n_time->get_user_by_id($_POST['user_id']);
      $this->load->view('listitem', $data);
      return;
   }

   // -->>> Begin Helper Functions <<<-- 

   function remove_user() {$this->n_time->remove('user', $_POST['id']);}
   function timediff($in_time, $out_time) {echo timespan(mysql_to_unix($in_time), mysql_to_unix($out_time));}
   function clocked_in($id) {return ($this->n_time->get_active_punch($id) != 0);}
   function valid_credentials($id, $password) {return $this->n_time->valid($id, $password);}
   function seconds_to_hours($seconds)
   {
      if ($seconds < 60) return $seconds . 's';    
      $str = '';	
      $hours = floor($seconds / 3600);
      $str .= $hours.':';
      $seconds -= $hours * 3600;
      $minutes = floor($seconds / 60);
      $minutes = ($minutes == 0) ? 00 : $minutes;
      $minutes = ($minutes >= 10) ? $minutes : '0'.$minutes;
      $str .= $minutes;
      $seconds -= $minutes * 60;
      return $str;
   }
   function add_user()
   {
      $this->n_time->create('user', $_POST); 
      $data['online_users'] = $this->n_time->get_online_users();
      $data['offline_users'] = $this->n_time->get_offline_users();
      $this->load->view('userlist', $data);
   }

   // -->>> End Helper Functions <<<-- 

}
