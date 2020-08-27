<?php if ( ! defined('BASEPATH')) exit('Tidak ada akses langsung script diperbolehkan');
 
if ( ! function_exists('get_bulan_romawi'))
{
    function get_bulan_romawi()
    {
        $namaBulan = array(
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII');
        return $namaBulan;
    }
}

if( ! function_exists('get_romawi'))
{
    function get_romawi($bln)
    {
        $namaBulan = get_bulan_romawi();
        return $namaBulan[(int)$bln];
    }
}
   
/*  End of file common_helper.php
    Location ./application/helpers/common_helper.php */