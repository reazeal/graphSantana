<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class GraphKendaraan_model extends MY_Model
{
    public $table = 'graph2';
    public $primary_key = 'id';
    public function __construct()
    {
        parent::__construct();
        
    }


    public function getdataDrilldown($id_graph2){
        $data = array();
        $this->db->select("
        `name`,
        `id_graph2` as id, 
        GROUP_CONCAT(CONCAT_WS(';',`name`,`value`)) AS dt
        ");
        $this->db->where('id_graph2',$id_graph2);
        $query = $this->db->get('drilldown_graph2');

        $totaly2 = $query->num_rows();
        if ($totaly2 > 0) {
            foreach ($query->result() as $atributy) {
                $dt_arr = explode(',',$atributy->dt);
                foreach ($dt_arr as $aa){
                    $dt_arrx = explode(';',$aa);
                    $data[] = array((string) $dt_arrx[0], (double) $dt_arrx[1]) ;
                }
            }
        }
        return $data;
    }

    public function getdatax(){
        $data = array();
        $query = $this->db->get('graph2');

        $totaly2 = $query->num_rows();
        if ($totaly2 > 0) {
            foreach ($query->result() as $atributy) {

                if($atributy->name=="Proprietary or Undetectable"){
                    $dt = null;
                }else{
                    $dt = $atributy->name;
                }

                $data[] = array(
                    (string) 'id' => (string) $atributy->name,
                    (string) 'name' => (string) $atributy->name,
                    (string) 'data' => $this->getdataDrilldown($atributy->id)
                );
            }

        }
        return $data;

    }

    public function getdata(){
        $data = array();
        $query = $this->db->get('graph2');

        $totaly2 = $query->num_rows();
        if ($totaly2 > 0) {
            foreach ($query->result() as $atributy) {

                if($atributy->name=="Proprietary or Undetectable"){
                    $dt = null;
                }else{
                    $dt = $atributy->name;
                }

                $data[] = array(
                    (string) 'id' => (integer) $atributy->id,
                    (string) 'name' => (string) $atributy->name,
                    (string) 'drilldown' => (string) $dt,
                    (string) 'y' => (double) $atributy->value
                );
            }

        }
        return $data;

    }

    public function get_data_all($search, $sort, $order, $limit, $offset)
    {
        $data = array();
        $this->db->select("
	       				a.id,
                        b.`name`,
                        a.`name` AS versi,
                        a.`value` AS prosen
       				");

        if(!empty($search)){
            $this->db->like('b.`name`',$search,'both');
            $this->db->or_like('a.`name`',$search,'both');
        }
        $this->db->join('graph2 b ','a.`id_graph2` = b.`id`');
        if(!empty($sort)){$this->db->order_by($sort, $order);}else{$this->db->order_by('b.`name`', 'ASC');}
        $query = $this->db->get('drilldown_graph2 a', $limit, $offset);
        if(!empty($search)){ $totaly2 = $query->num_rows();}else{ $totaly2 = $this->db->count_all('drilldown_graph2 a'); }

        if ($totaly2 > 0) {
            foreach ($query->result() as $atributy) {

                $data[] = array(
                    'id' => $atributy->id,
                    'name' => $atributy->name,
                    'versi' => $atributy->versi,
                    'prosen' => (double) $atributy->prosen
                );
            }

        }

        return array('total'=>$totaly2,'rows' => $data);
    }



}