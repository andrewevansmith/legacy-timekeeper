<?php

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

