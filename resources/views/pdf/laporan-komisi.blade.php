<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Laporan Pembayaran Komisi Bulan {{nama_bulan($bulan)}} - {{$tahun}}</title>
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
                    <h2>Laporan Pembayaran Komisi <br> Bulan {{nama_bulan($bulan)}} - {{$tahun}}</h2>
                </center>  
            </div>
            <br>
            <table class="tg">
              <tr>
                <th class="tg-3wr7">No</th>
                <th class="tg-3wr7">Tanggal Pembayaran</th>
                <th class="tg-3wr7">Member</th>
                <th class="tg-3wr7">Jumlah</th>
              </tr>
             
                @php 
                    $i = 1;
                    $total_pembayaran=0;
                @endphp

                @foreach($pembayaran as $p)

                @php $referral = Referral($p->referral_id) @endphp
                
                <tr>
                    <td class="tg-rv4w" width="10%">{{$i}}</td>
                    <td class="tg-rv4w" width="10%">{{tgl_id($p->created_at)}}</td>
                    <td class="tg-rv4w" width="60%">{{$referral->name}}</td>
                    <td class="tg-rv4w" width="20%" style="text-align: right;">{{angkaRupiah($p->jumlah)}}</td>
                </tr>

                @php 
                    $i = $i+1; 
                    $total_pembayaran = $total_pembayaran+$p->jumlah;
                @endphp

                @endforeach

                <tr>
                    <td colspan="3">Total</td>
                    <td style="text-align: right;">{{angkaRupiah($total_pembayaran)}}</td>
                </tr>
            </table>
        </body>
    </head>
</html>