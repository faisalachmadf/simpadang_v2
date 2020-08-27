<?php if ( ! defined('BASEPATH')) exit('Tidak ada akses langsung script diperbolehkan');
 
if ( ! function_exists('get_hari'))
{
    function get_hari()
    {
        $namaHari = array(
            'Sun' => 'Minggu',
            'Mon' => 'Senin',
            'Tue' => 'Selasa',
            'Wed' => 'Rabu',
            'Thu' => 'Kamis',
            'Fri' => "Jum'at",
            'Sat' => 'Sabtu');
        return $namaHari;
    }
}

if( ! function_exists('get_nama_hari'))
{
    function get_nama_hari($hri)
    {
        $namaHari = get_hari();
        return $namaHari[(string)$hri];
    }
}
   
/*  End of file common_helper.php
    Location ./application/helpers/common_helper.php */