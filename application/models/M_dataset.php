<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dataset extends CI_Model {
    
    function get_rh(){
        $this->db->select('*');
        $this->db->from('dht11');
        $this->db->order_by('int_ID','ASC');
        $query = $this->db->get();
        return $query;
    }
    function get_sh(){
        $this->db->select('*');
        $this->db->from('dht11');
        $this->db->order_by('int_ID','ASC');
        $query = $this->db->get();
        return $query;
    }
    function get_rh_search($start = null, $end = null){
        
        // $start=  $start." 00:00:00";
        // $end=  $end." 23:59:00";
        $this->db->select('*');
        $this->db->from('dht11');
            $this->db->where('Time_Stamp'.'>=',$start);
            $this->db->where('Time_Stamp'.'<=',$end);
        $this->db->order_by('int_ID','ASC');
        $query = $this->db->get();
        return $query;
    }
    function get_sh_search($start = null, $end = null){
        // $start=  $start." 00:00:00";
        // $end=  $end." 23:59:00";
        $this->db->select('*');
        $this->db->from('dht11');
            $this->db->where('Time_Stamp'.'>=',$start);
            $this->db->where('Time_Stamp'.'<=',$end);
        $this->db->order_by('int_ID','ASC');
        $query = $this->db->get();
        return $query;
    }

    // kmi 
    // function get_rh(){
    //     $this->db->select('*');
    //     $this->db->from('rh');
    //     $this->db->order_by('id_rh','ASC');
    //     $query = $this->db->get();
    //     return $query;
    // }
    // function get_sh(){
    //     $this->db->select('*');
    //     $this->db->from('suhu');
    //     $this->db->order_by('id_suhu','ASC');
    //     $query = $this->db->get();
    //     return $query;
    // }
    // function get_rh_search($start = null, $end = null){
        
    //     // $start=  $start." 00:00:00";
    //     // $end=  $end." 23:59:00";
    //     $this->db->select('*');
    //     $this->db->from('rh');
    //         $this->db->where('dtmInserted'.'>=',$start);
    //         $this->db->where('dtmInserted'.'<=',$end);
    //     $this->db->order_by('id_rh','ASC');
    //     $query = $this->db->get();
    //     return $query;
    // }
    // function get_sh_search($start = null, $end = null){
    //     // $start=  $start." 00:00:00";
    //     // $end=  $end." 23:59:00";
    //     $this->db->select('*');
    //     $this->db->from('suhu');
    //         $this->db->where('dtmInserted'.'>=',$start);
    //         $this->db->where('dtmInserted'.'<=',$end);
    //     $this->db->order_by('id_suhu','ASC');
    //     $query = $this->db->get();
    //     return $query;
    // }
}

