<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Laporan Pemesanan Bulan {{nama_bulan($bulan)}} - {{$tahun}}</title>
        <body>
            <style type="text/css">
                .tg  {border-collapse:collapse;border-spacing:0;border-color:#ccc;width: 100%; }
                .tg td{font-family:Arial;font-size:12px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#fff;}
                .tg th{font-family:Arial;font-size:14px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#ccc;color:#333;background-color:#f0f0f0;}
                .tg .tg-3wr7{font-weight:bold;font-size:12px;font-family:"Arial", Helvetica, sans-serif !important;;text-align:center}
                .tg .tg-ti5e{font-size:10px;font-family:"Arial", Helvetica, sans-serif !important;;text-align:center}
                .tg .tg-rv4w{font-size:10px;font-family:"Arial", Helvetica, sans-serif !important;}
            </style>
  
            <div style="font-family:Arial; font-size:12px;">
                <center>
                    <h1>Wisata Alam Indonesia Tour Services</h1>
                    
                    <p align="center" style="margin-top: -10px;">Perum Gardenia Blok G29, Jl. S. Parman, Sobo<br/>Banyuwangi - Jawa Timur - Indonesia<br/>Telepon : +62 821 4296 1911<br/>Website: wisata-alam.com</p>
                    <hr>
                    <h2>Laporan Pemesanan Paket Wisata <br> Bulan {{nama_bulan($bulan)}} - {{$tahun}}</h2>
                </center>  
            </div>
            <br>
            <p align="right">Berdasarkan : {{karakter($filter)}}</p>
            <table class="tg">
              <tr>
                <th class="tg-3wr7">Tanggal Pemesanan</th>
                <th class="tg-3wr7">Tanggal Tour</th>
                <th class="tg-3wr7">Invoice</th>
                <th class="tg-3wr7">Nama</th>
                <th class="tg-3wr7">Paket</th>
                <th class="tg-3wr7">Kategori</th>
                <th class="tg-3wr7">Jumlah</th>
                <th class="tg-3wr7">Biaya Total</th>
              </tr>
             
                @php 
                    $i = 1;
                    $jumlah=0;
                    $jml_orang=0; 
                @endphp

                @foreach($reservasi as $r)

                    @php 
                        $dataPaket = DataPaket($r->paket_id); 
                        $dataKat = Kategori_detail($dataPaket->kategori_id); 
                    @endphp
                
                <tr>
                    <td class="tg-rv4w" width="10%">{{tgl_id($r->created_at)}}</td>
                    <td class="tg-rv4w" width="10%">{{tgl_id($r->tanggal_tour)}}</td>
                    <td class="tg-rv4w" width="10%">{{$r->invoice}}</td>
                    <td class="tg-rv4w" width="10%">{{$r->nama}}</td>
                    <td class="tg-rv4w" width="20%">{{$dataPaket->nama}}</td>
                    <td class="tg-rv4w" width="10%">{{$dataKat->nama}}</td>
                    <td class="tg-rv4w" width="10%">{{$r->jml_dewasa+$r->jml_anak}} Orang</td>
                    <td class="tg-rv4w" width="20%" style="text-align: right;">{{angkaRupiah($r->jumlah)}}</td>
                </tr>

                @php 
                    $i = $i+1; 
                    if($r->konfirmasi == 1){
                        $jumlah = $jumlah + $r->jumlah;
                    } else {
                        $jumlah = $jumlah + $r->dp;
                    }
                    $jml_orang = $jml_orang+$r->jml_dewasa+$r->jml_anak;
                @endphp

                @endforeach

                @php 
                    $jumlah2 = TotalKemarinJumlah($bulan,$tahun);
                    $jml_orang2 = TotalKemarinJml_orang($bulan,$tahun);

                    $total_orang = $jml_orang+$jml_orang2;
                    $total_biaya = $jumlah+$jumlah2;
                @endphp
                <tr>
                    <td colspan="6">Total Bulan {{nama_bulan($bulan)}}</td>
                    <td>{{$jml_orang}} Orang</td>
                    <td style="text-align: right;">{{angkaRupiah($jumlah)}}</td>
                </tr>
                <tr>
                    <td colspan="6">Total Bulan Kemarin</td>
                    <td>{{$jml_orang2}} orang</td>
                    <td style="text-align: right;">{{angkaRupiah($jumlah2)}}</td>
                </tr>
                <tr>
                    <td colspan="6">Total Akhir</td>
                    <td>{{$total_orang}} orang</td>
                    <td style="text-align: right;">{{angkaRupiah($total_biaya)}}</td>
                </tr>

            </table>
        </body>
    </head>
</html>