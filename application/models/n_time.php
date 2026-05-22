<?php

class n_time extends Model 
{
  function get_users() 
  {
    $q = $this->db->query('SELECT * FROM user');
    return $q->result_array();
      echo "HELLO";
  }

  function get_online_users()
  {
    $q = $this->db->query("SELECT name, id FROM user WHERE active_punch != '0'");
    $q = $q->result_array(); 
    return $q;
  }
  
  function get_offline_users()
  {
    $q = $this->db->query("SELECT name, id FROM user WHERE active_punch = '0'");
    $q = $q->result_array(); 
    return $q;
  }

  function get_user_by_id($id)
  {
    $q = $this->db->query("SELECT * FROM user WHERE id = '$id'");
    $q = $q->result_array(); 
    return $q[0];
  }

  function get_active_punch($user_id)
  {
    $q = $this->db->query("SELECT active_punch FROM user WHERE id = '$user_id'");
    $q = $q->result_array();
    return $q[0]['active_punch'];
  }
  
  function get_in_time($user_id)
  {
    $id = $this->get_active_punch($user_id);
    $q = $this->db->query("SELECT * FROM punch WHERE id = '$id'");
    $q = $q->result_array();
    return $q[0]['in_time'];
  }

  function get_punches_by_id($id)
  {
     $q = $this->db->query("SELECT * FROM punch WHERE user_id='$id'");
     return $q->result_array();
  }
  
  function clock_out($user_id)
  {
    $id = $this->get_active_punch($user_id);
    $this->db->query("UPDATE user SET active_punch = '0' WHERE id = '$user_id'");
    $this->db->query("UPDATE punch SET out_time = CURRENT_TIMESTAMP WHERE id = '$id'");
  }
  
  function clock_in($data)
  {
    $this->create('punch', $data);
    $id = $this->db->insert_id();
    $this->db->query("UPDATE user SET active_punch = '$id' WHERE id = '$data[user_id]'");
  } 
  
  function create($table, $content)
  {
    return $this->db->insert($table, $content); 
  }

  function remove($table, $id)
  {
      $this->db->where('id', $id);
      $this->db->delete($table);
  }

  // added late
  
  function valid($id, $password)
  {
     $q = $this->db->query("SELECT name FROM user WHERE id='$id' AND password='$password'");
     return $q->num_rows();
  }
  
}
