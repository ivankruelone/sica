<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		Ivan Zuñiga Perez
 * @copyright	Copyright (c) 2012.
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/**
 * fecha_normalizada
 *
 * Te convierte una fecha en formato MMM/YYYY a formato YYYY-MM-DD.
 * No sirve para representar la caducidad de los medicamentos.
 * Ejemplo: MAY2018 -> 2018-05-31
 *
 * @access	public
 * @param	string
 * @return	date
 */
if ( ! function_exists('fecha_normalizada'))
{
    function fecha_normalizada($fecha)
    {
	if($fecha == 'SC' || $fecha == 'sc'){
	
		return '0000-00-00';
		}else{

			$fecha = explode('/', $fecha);
			
			$a = array(
				'ene'   => '01',
				'feb'   => '02',
				'mar'   => '03',
				'abr'   => '04',
				'may'   => '05',
				'jun'   => '06',
				'jul'   => '07',
				'ago'   => '08',
				'sep'   => '09',
				'oct'   => '10',
				'nov'   => '11',
				'dic'   => '12',
				'ENE'   => '01',
				'FEB'   => '02',
				'MAR'   => '03',
				'ABR'   => '04',
				'MAY'   => '05',
				'JUN'   => '06',
				'JUL'   => '07',
				'AGO'   => '08',
				'SEP'   => '09',
				'OCT'   => '10',
				'NOV'   => '11',
				'DIC'   => '12',
				'01'	=> '01',
				'02'	=> '02',
				'03'	=> '03',
				'04'	=> '04',
				'05'	=> '05',
				'06'	=> '06',
				'07'	=> '07',
				'08'	=> '08',
				'09'	=> '09',
				'10'	=> '10',
				'11'	=> '11',
				'12'	=> '12'
				);
			
			$fecha_busca = $fecha[1].'-'.$a[$fecha[0]].'-01';
			$ci=& get_instance();
			$ci->load->database();

			$sql = "SELECT LAST_DAY(?) as dia;";
			$query = $ci->db->query($sql, $fecha_busca);
			$row = $query->row();
			
			return $row->dia;
		}
        
    }
}

// ------------------------------------------------------------------------

 /**
 * formato_caducidad
 *
 * Te convierte una fecha en formato YYYY-MM-DD a formato MMMYYYY.
 * No sirve para representar la caducidad de los medicamentos.
 * Ejemplo: 2018-05-31 -> MAY2018
 *
 * @access	public
 * @param	date
 * @return	string
 */
if ( ! function_exists('formato_caducidad'))
{
	function formato_caducidad($cad)
	{
	   if($cad == "0000-00-00"){
	       return "SC";
	   }else{
    		$cad = explode('-', $cad);
            if(count($cad) == 3){
                
                if($cad[0]  > 0){
                    
                    $a = array(
                        '01' => 'ENE',
                        '02' => 'FEB',
                        '03' => 'MAR',
                        '04' => 'ABR',
                        '05' => 'MAY',
                        '06' => 'JUN',
                        '07' => 'JUL',
                        '08' => 'AGO',
                        '09' => 'SEP',
                        '10' => 'OCT',
                        '11' => 'NOV',
                        '12' => 'DIC',
                        '00' => 'ND'
                    );
                    
                    return $a[$cad[1]]."/".$cad[0];
                    
                }else{
                    return null;
                }
                
            }else{
                return null;
            }
        
        }
	}
}


// ------------------------------------------------------------------------

 /**
 * caduca_en_dias
 *
 * Dada una fecha te indica el numero de dias a caducar.
 *
 * @access	public
 * @param	date
 * @return	integer
 */
if ( ! function_exists('caduca_en_dias'))
{
	function caduca_en_dias($caduca){
	    $ci=& get_instance();
        $ci->load->database();
        $sql = "SELECT DATEDIFF(?, now()) as dias;";
        $query = $ci->db->query($sql, $caduca);
        $row = $query->row();
        
        return $row->dias;
    }
}
/* End of file funciones.php */
/* Location: ./application/helpers/funciones.php */