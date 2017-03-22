<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Graph1_model extends MY_Model
{
    public $table = 'graph1';
    public $primary_key = 'id';
    public function __construct()
    {
        parent::__construct();
        
    }

    public function getdata(){
        $data = array();
        $this->db->select("
        b.`id`,
        b.`label_data`,
        b.`tipe_graph`,
        b.`fillColor`,
        b.`pointColor`,
        b.`pointHighlightFill`,
        b.`pointHighlightStroke`,
        b.`pointStrokeColor`,
        b.`strokeColor`,
        GROUP_CONCAT(a.`value` ORDER BY a.`id` ASC) AS datanya, 
        GROUP_CONCAT(a.`label` ORDER BY a.`id` ASC) AS labels
        ");
        $this->db->join('graph1 b','a.`id_graph1` = b.`id`');
        $this->db->where('b.`tipe_graph`','areaChart');
        $this->db->group_by('b.`id`');
        $query = $this->db->get('data_graph1 a');

        $totaly2 = $query->num_rows();
        if ($totaly2 > 0) {
            foreach ($query->result() as $atributy) {

                $aa =explode(",",$atributy->datanya);
                $bb =explode(",",$atributy->labels);


                $data[] = array(
                    'label' => $atributy->label_data,
                    'fillColor' => $atributy->fillColor,
                    'strokeColor' => $atributy->strokeColor,
                    'pointColor' => $atributy->pointColor,
                    'pointStrokeColor' => $atributy->pointStrokeColor,
                    'pointHighlightFill' => $atributy->pointHighlightFill,
                    'pointHighlightStroke' => $atributy->pointHighlightStroke,
                    'data' => (array) $aa,
                    'labels' => (array) $bb
                );
            }

        }
        return $data;

    }


    public function getdataPie(){
        $data = array();
        $this->db->select("
        b.`id`,
        b.`label_data`,
        b.`tipe_graph`,
        b.`color`,
        b.`highlight`,
        GROUP_CONCAT(a.`value` ORDER BY a.`id` ASC) AS datanya, 
        GROUP_CONCAT(a.`label` ORDER BY a.`id` ASC) AS labels
        ");
        $this->db->join('graph1 b','a.`id_graph1` = b.`id`');
        $this->db->where('b.`tipe_graph`','pieChart');
        $this->db->group_by('b.`id`');
        $query = $this->db->get('data_graph1 a');

        $totaly2 = $query->num_rows();
        if ($totaly2 > 0) {
            foreach ($query->result() as $atributy) {
                $bb =explode(",",$atributy->labels);

                $data[] = array(
                    'label' => $atributy->label_data,
                    'color' => $atributy->color,
                    'highlight' => $atributy->highlight,
                    'value' => (int) $atributy->datanya,
                    'labels' => (array) $bb
                );
            }

        }
        return $data;

    }


}