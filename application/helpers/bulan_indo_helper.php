<?php if ( ! defined('BASEPATH')) exit('Tidak ada akses langsung script diperbolehkan');
 
if ( ! function_exists('get_bulan'))
{
    function get_bulan()
    {
        $namaBulan = array(
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember');
        return $namaBulan;
    }
}

if( ! function_exists('get_nama_bulan'))
{
    function get_nama_bulan($bln)
    {
        $namaBulan = get_bulan();
        return $namaBulan[(int)$bln];
    }
}
   
/*  End of file common_helper.php
    Location ./application/helpers/common_helper.php */