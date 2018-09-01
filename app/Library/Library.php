<?php 
use Illuminate\Support\Facades\Cache;

date_default_timezone_set('Asia/Jakarta');

function set_active( $route ) {
    if( is_array( $route ) ){
        return in_array(Request::path(), $route) ? 'active open' : '';
    }
    return Request::path() == $route ? 'active open' : '';
}

function set_current( $route ) {
    if( is_array( $route ) ){
        return in_array(Request::path(), $route) ? 'current' : '';
    }
    return Request::path() == $route ? 'current' : '';
}

function ceklink( $route ) {
    if( is_array( $route ) ){
        return in_array(Request::path(), $route) ? 'true' : '';
    }
    return Request::path() == $route ? 'true' : '';
}

function provinsi($prov){
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://api.rajaongkir.com/starter/province",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
          "key: 563b6d1fe883cc55cb374d08692ab9e0"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    $data = json_decode($response, true);
    for ($i=0; $i < count($data['rajaongkir']['results']); $i++) {
        if($data['rajaongkir']['results'][$i]['province_id'] == $prov){
            echo $data['rajaongkir']['results'][$i]['province'];
        }
    }
    echo "</select><br><br>";
}

function kabupaten($prov,$kab){
    $provinsi_id = $prov;
 
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "http://api.rajaongkir.com/starter/city?province=$provinsi_id",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "key: 563b6d1fe883cc55cb374d08692ab9e0"
      ),
    ));
     
    $response = curl_exec($curl);
    $err = curl_error($curl);
     
    curl_close($curl);
     
    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
      //echo $response;
    }
     
    $data = json_decode($response, true);
    for ($i=0; $i < count($data['rajaongkir']['results']); $i++) { 
        
        if($data['rajaongkir']['results'][$i]['city_id'] == $kab){
            echo $data['rajaongkir']['results'][$i]['city_name'];
        }
    }
}

function angkaBiasa($angka){
    // cari posisi mulai dari angka ke 1
    $cek  = 2;
    $angka2     = $angka{$cek - 1};
    while($angka2 != '.') {
        $angka2 = $angka{++$cek};
    }
    $angka2 = substr($angka, 0, $cek);
    $angka = str_replace(',', '', $angka2);
    return $angka;
}

function potong_tanggal($angka){
    // cari posisi mulai dari angka ke 1
    $cek  = 2;
    $angka2     = $angka{$cek - 1};
    while($angka2 != ' ') {
        $angka2 = $angka{++$cek};
    }
    $angka2 = substr($angka, 0, $cek);
    return $angka2;
}

function potong_kalimat($kalimat) {
    $teks = strip_tags($kalimat);
    $teks = substr($teks,0,220);
    $teks = substr($teks,0,strrpos($teks," "));

    return $teks;
}

function angkaRupiah($angka){
	
	$hasil_rupiah = number_format($angka,0,',','.');
	
	return $hasil_rupiah;
}

function waktuLalu($tanggal){
    $tgl_sekarang = date('Y-m-d');
    $start_date = new DateTime($tanggal);
    $end_date = new DateTime($tgl_sekarang);
    $interval = $start_date->diff($end_date);
    if($interval->days == 0){
        $data = "Hari ini";
    } else {
        $data = $interval->days." Hari yang lalu";
    }
    return $data;
}

function waktu($tanggal){
    $tgl_sekarang = date('Y-m-d');
    $start_date = new DateTime($tanggal);
    $end_date = new DateTime($tgl_sekarang);
    $interval = $start_date->diff($end_date);
    
    $tanggal = $tanggal;
    $delimeter="-";
    $date = explode($delimeter,$tanggal);
    //Tanggal yang di inputkan di penggal berdasarkan tanda "/"
    $month  = $date[1];
    $day    = substr($date[2], 0, 2);
    $year   = $date[0];

    //Tanggal Sekarang
    $y=date("Y");
    $m=date("m");
    $d=date("d");
    //Gunakan Fungsi GregorianToJD untuk mengetahui selisih tanggal
    $jd1 = GregorianToJD($m, $d, $y);
    $jd2 = GregorianToJD($month, $day, $year);
    // hitung selisih hari kedua tanggal
    $selisih = $jd1 - $jd2;
    if($selisih > 0){//cek apakah tanggal yg dipilih pada masa lampau
          $hasil = -$interval->days;
    }else{
         $hasil = $interval->days;
    }

    return $hasil;
}

function nama_bulan($bln){
    switch ($bln){
        case 1: 
            return "Januari";
            break;
        case 2:
            return "Februari";
            break;
        case 3:
            return "Maret";
            break;
        case 4:
            return "April";
            break;
        case 5:
            return "Mei";
            break;
        case 6:
            return "Juni";
            break;
        case 7:
            return "Juli";
            break;
        case 8:
            return "Agustus";
            break;
        case 9:
            return "September";
            break;
        case 10:
            return "Oktober";
            break;
        case 11:
            return "November";
            break;
        case 12:
            return "Desember";
            break;
    }
}

// buat seo
function karakter($s) {
    $d = array ('-','/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+','<','>');
	// $s = strtolower($s);
    // $s = str_replace($d, '', $s); // Hilangkan karakter yang telah disebutkan di array $d    
	// $s = str_replace('  ', ' ', $s); // Ganti dobel spasi dengan tanda -
	$s = str_replace('-', ' ', $s); // Ganti spasi dengan tanda - dan ubah hurufnya menjadi kecil semua
	
    return $s;
}

function cekseo($c) {    
    $b = array ('/','\\',',','.','#',':',';','\'','"','[',']','{','}',')','(','|','`','~','!','@','%','$','^','&','*','=','?','+','<','>');
	$c = strtolower($c);
    $c = str_replace($b, '', $c);
	$c = str_replace('  ', '', $c);
    $c = str_replace(' ', '-', $c);
    return $c;
}

function tgl_id($tanggal){
	$tanggal2 = substr($tanggal,8,2);
	$bulan = substr($tanggal,5,2);
	$tahun = substr($tanggal,0,4);
	return $tanggal2.'-'.$bulan.'-'.$tahun;		 
}

function tgl_en($tanggal){
	$tanggal2 = substr($tanggal,0,2);
	$bulan = substr($tanggal,3,2);
	$tahun = substr($tanggal,6,4);
	return $tahun.'-'.$bulan.'-'.$tanggal2;		 
}

function tgl_slash($tanggal){
    $tanggal2 = substr($tanggal,8,2);
    $bulan = substr($tanggal,5,2);
    $tahun = substr($tanggal,0,4);
    return $tanggal2.'/'.$bulan.'/'.$tahun;      
}

?>