<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2016, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2016, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Application Controller Class
 *
 * This class object is the super class that every library in
 * CodeIgniter will be assigned to.
 *
 * @package		CodeIgniter
 * @subpackage	Libraries
 * @category	Libraries
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/general/controllers.html
 */
class CI_Controller {

	/**
	 * Reference to the CI singleton
	 *
	 * @var	object
	 */
	private static $instance;

	/**
	 * Class constructor
	 *
	 * @return	void
	 */
	public function __construct()
	{
		self::$instance =& $this;

		// Assign all the class objects that were instantiated by the
		// bootstrap file (CodeIgniter.php) to local class variables
		// so that CI can run as one big super object.
		foreach (is_loaded() as $var => $class)
		{
			$this->$var =& load_class($class);
		}

		$this->load =& load_class('Loader', 'core');
		$this->load->initialize();
		log_message('info', 'Controller Class Initialized');
	}

	// --------------------------------------------------------------------

	/**
	 * Get the CI singleton
	 *
	 * @static
	 * @return	object
	 */
	public static function &get_instance()
	{
		return self::$instance;
	}

    /**
     * @param $filter
     * @return string
     */
    public function get_filter($filter) {
        $qs = '';
        $where = '';
        if (is_array($filter)) {
            for ($i=0;$i<count($filter);$i++){

                if($filter[$i]['field'] == 	'role_count'){
                    continue;
                }

                switch($filter[$i]['data']['type']){
                    case 'string' : $qs .= " AND ".$filter[$i]['field']." LIKE '%".$filter[$i]['data']['value']."%'"; break;
                    case 'list' :
                        if (strstr($filter[$i]['data']['value'],',')){
                            $fi = explode(',',$filter[$i]['data']['value']);
                            for ($q=0;$q<count($fi);$q++){
                                $fi[$q] = "'".$fi[$q]."'";
                            }
                            $filter[$i]['data']['value'] = implode(',',$fi);
                            $qs .= " AND ".$filter[$i]['field']." IN (".$filter[$i]['data']['value'].")";
                        }else{
                            $qs .= " AND ".$filter[$i]['field']." = '".$filter[$i]['data']['value']."'";
                        }
                        break;
                    case 'boolean' : $qs .= " AND ".$filter[$i]['field']." = ".($filter[$i]['data']['value']); break;
                    case 'numeric' :
                        switch ($filter[$i]['data']['comparison']) {
                            case 'ne' : $qs .= " AND ".$filter[$i]['field']." != ".$filter[$i]['data']['value']; break;
                            case 'eq' : $qs .= " AND ".$filter[$i]['field']." = ".$filter[$i]['data']['value']; break;
                            case 'lt' : $qs .= " AND ".$filter[$i]['field']." < ".$filter[$i]['data']['value']; break;
                            case 'gt' : $qs .= " AND ".$filter[$i]['field']." > ".$filter[$i]['data']['value']; break;
                        }
                        break;
                    case 'date' :
                        switch ($filter[$i]['data']['comparison']) {
                            case 'ne' : $qs .= " AND ".$filter[$i]['field']." != '".date('Y-m-d',strtotime($filter[$i]['data']['value']))."'"; break;
                            case 'eq' : $qs .= " AND ".$filter[$i]['field']." = '".date('Y-m-d',strtotime($filter[$i]['data']['value']))."'"; break;
                            case 'lt' : $qs .= " AND ".$filter[$i]['field']." < '".date('Y-m-d',strtotime($filter[$i]['data']['value']))."'"; break;
                            case 'gt' : $qs .= " AND ".$filter[$i]['field']." > '".date('Y-m-d',strtotime($filter[$i]['data']['value']))."'"; break;
                        }
                        break;
                }
            }
            $where .= $qs;
        }

        return $where;
    }

    //Mengubah format tanggal dari database ke format tgl-bln-thn
    function tanggal($tgl){
        if(!empty($tgl)){
            $tgl=explode(" ",$tgl);
            $tgl=explode("-",$tgl[0]);

            return $tgl[2]."-".$tgl[1]."-".$tgl[0];
        }else {
            return "-";
        }
    }

    //Mengubah format tanggal dari format tgl-bln-thn ke database
    function tanggaldb($tgl){
        if(!empty($tgl)){

            $tgl=explode("-",$tgl);
            return $tgl[2]."-".$tgl[1]."-".$tgl[0];

        }else{
            return "0000-00-00";
        }

    }

    //Mengubah format datetime dari Y-m-d H:i:s ke format d-m-Y H:i:s
    function datetime($datetime){
        if(!empty($datetime)){

            $datetime=explode(" ",$datetime);
            $date=$this->tanggaldb($datetime[0]);

            return $date." ".$datetime[1];
        }else{
            return "-";
        }

    }

    //Mengubah format datetime dari d-m-Y H:i:s ke format Y-m-d H:i:s
    function datetimedb($datetime){

        if(!empty($datetime)){
            $datetime=explode(" ",$datetime);
            $date=$this->tanggal($datetime[0]);

            return $date." ".$datetime[1];
        }else{
            return "0000-00-00 00:00:00";
        }

    }

    function get_nama_bulan_id($a){
        IF ($a == 1)
            $b = 'Januari';
        ELSEIF ($a == 2)
            $b = 'Pebruari';
        ELSEIF ($a == 3)
            $b = 'Maret';
        ELSEIF ($a == 4)
            $b = 'April';
        ELSEIF ($a == 5)
            $b = 'Mei';
        ELSEIF ($a == 6)
            $b = 'Juni';
        ELSEIF ($a == 7)
            $b = 'Juli';
        ELSEIF ($a == 8)
            $b = 'Agustus';
        ELSEIF ($a == 9)
            $b = 'September';
        ELSEIF ($a == 10)
            $b = 'Oktober';
        ELSEIF ($a == 11)
            $b = 'Nopember';
        ELSE
            $b = 'Desember';
        return $b;
    }

    function get_nama_bulan_eng($a){
        IF ($a == 1)
            $b = 'January';
        ELSEIF ($a == 2)
            $b = 'February';
        ELSEIF ($a == 3)
            $b = 'March';
        ELSEIF ($a == 4)
            $b = 'April';
        ELSEIF ($a == 5)
            $b = 'May';
        ELSEIF ($a == 6)
            $b = 'June';
        ELSEIF ($a == 7)
            $b = 'July';
        ELSEIF ($a == 8)
            $b = 'August';
        ELSEIF ($a == 9)
            $b = 'September';
        ELSEIF ($a == 10)
            $b = 'October';
        ELSEIF ($a == 11)
            $b = 'November';
        ELSE
            $b = 'December';
        return $b;
    }


    //Numericfield titik hilang, koma jadi titik
    function uang($val){

        $val = str_replace(".", "", $val);
        $val = str_replace("Rp", "", $val);
        $val = str_replace(",", ".", $val);

        return $val;
    }

    function convert_to_array($val){
        $data = array();

        $val= explode(",", $val);
        $total = count($val);

        for ($i = 0; $i < $total; $i++) {
            if ($val[$i] != "") {
                array_push($data, $val[$i]);
            }
        }

        return $data;
    }

    function cek_num($val) {
        if(is_numeric($val)){
            return $val;

        }else{
            return "Encrypted-Cannot-Shown";
        }

    }

    function datediff($tgl1, $tgl2){
        $tgl1 = (is_string($tgl1) ? strtotime($tgl1) : $tgl1);
        $tgl2 = (is_string($tgl2) ? strtotime($tgl2) : $tgl2);
        $diff_secs = abs($tgl1-$tgl2);
        $base_year = min(date("Y", $tgl1), date("Y", $tgl2));
        $diff = mktime(0, 0, $diff_secs, 1, 1, $base_year);

        return array("Tahun" => date("Y", $diff) - $base_year,
            "Total Bulan" => (date("Y", $diff)-$base_year) * 12 + date("n", $diff)-1,
            "Bulan" => date("n", $diff)-1,
            "Total Hari"=> floor($diff_secs/(3600 * 24)),
            "Hari" => date("j", $diff)-1,
            "Total Jam" => floor($diff_secs/3600),
            "Jam" => date("G", $diff),
            "Total Menit" => floor($diff_secs / 60),
            "Menit"=> (int) date("i", $diff),
            "Total Detik"=> $diff_secs,
            "Detik" => (int) date("s", $diff));
    }

}
