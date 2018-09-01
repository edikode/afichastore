@extends('emails.layouts.template')

@section('judul', 'Email detail Pemesanan')

@section('main')

<?php

$style = [
    /* Layout ------------------------------ */

    'body' => 'margin: 0; padding: 0; width: 100%; background-color: #F2F4F6;',
    'email-wrapper' => 'width: 100%; margin: 0; padding: 0; background-color: #F2F4F6;',

    /* Masthead ----------------------- */

    'email-masthead' => 'padding: 25px 0; text-align: center;',
    'email-masthead_name' => 'font-size: 16px; font-weight: bold; color: #2F3133; text-decoration: none; text-shadow: 0 1px 0 white;',

    'email-body' => 'width: 100%; margin: 0; padding: 0; border-top: 1px solid #EDEFF2; border-bottom: 1px solid #EDEFF2; background-color: #FFF;',
    'email-body_inner' => 'width: auto; max-width: 570px; margin: 0 auto; padding: 0;',
    'email-body_cell' => 'padding: 35px;',

    'email-footer' => 'width: auto; max-width: 570px; margin: 0 auto; padding: 0; text-align: center;',
    'email-footer_cell' => 'color: #AEAEAE; padding: 35px; text-align: center;',

    /* Body ------------------------------ */

    'body_action' => 'width: 100%; margin: 30px auto; padding: 0; text-align: center;',
    'body_sub' => 'margin-top: 25px; padding-top: 25px; border-top: 1px solid #EDEFF2;',

    /* Type ------------------------------ */

    'anchor' => 'color: #3869D4;',
    'header-1' => 'margin-top: 0; color: #2F3133; font-size: 19px; font-weight: bold; text-align: left;',
    'paragraph' => 'margin-top: 0; color: #74787E; font-size: 16px; line-height: 1.5em;',
    'paragraph-sub' => 'margin-top: 0; color: #74787E; font-size: 12px; line-height: 1.5em;',
    'paragraph-center' => 'text-align: center;',

    /* Buttons ------------------------------ */

    'button' => 'display: block; display: inline-block; width: 200px; min-height: 20px; padding: 10px;
                 background-color: #3869D4; border-radius: 3px; color: #ffffff; font-size: 15px; line-height: 25px;
                 text-align: center; text-decoration: none; -webkit-text-size-adjust: none;',

    'button--green' => 'background-color: #22BC66;',
    'button--red' => 'background-color: #dc4d2f;',
    'button--blue' => 'background-color: #3869D4;',
];
?>

<?php $fontFamily = 'font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;'; ?>

<tr>
    <td style="{{ $style['email-body'] }}" width="100%">
        <table style="{{ $style['email-body_inner'] }}" align="center" width="570" cellpadding="0" cellspacing="0">
            <tr>
                <td style="{{ $fontFamily }} {{ $style['email-body_cell'] }}">
                    <!-- Greeting -->
                    <h1 style="{{ $style['header-1'] }}">
                        Detail Pemesanan
                    </h1>
                    <table border="0" cellpadding="0" cellspacing="0">
                        <tr style="height:25px;">
                            <td>
                                <b>Tanggal Pemesanan</b>
                            </td>
                            <td style='width:15px; text-align:center'>:</td>
                            <td>{{$tanggal_pesan}}</td>
                        </tr>
                        <tr style="height:25px;">
                            @php $pelanggan = Pelanggan($pelanggan_id) @endphp
                            <td>
                                <b>Nama Pelanggan</b>
                            </td>
                            <td style='width:15px; text-align:center'>:</td>
                            <td>{{$pelanggan->nama}}</td>
                        </tr>
                        <tr style="height:25px;">
                            <td>
                                <b>Email</b>
                            </td>
                            <td style='width:15px; text-align:center'>:</td>
                            <td>{{$pelanggan->email}}</td>
                        </tr>
                        <tr style="height:25px;">
                            <td>
                                <b>Telepon</b>
                            </td>
                            <td style='width:15px; text-align:center'>:</td>
                            <td>{{$pelanggan->telepon}}</td>
                        </tr>
                        <tr style="height:25px;">
                            @php $produkbelanja = ProdukBelanja($pemesanan_id) @endphp
                            <td>
                                <b>Produk</b>
                            </td>
                            <td style='width:15px; text-align:center'>:</td>
                            <td>@php echo $produkbelanja @endphp</td>
                        </tr>
                        <tr style="height:25px;">
                            <td>
                                <b>Jumlah Produk</b>
                            </td>
                            <td style='width:15px; text-align:center'>:</td>
                            <td>{{$jumlah}} Pcs</td>
                        </tr>
                        <tr style="height:25px;">
                            <td>
                                <b>Total + Ongkir</b>
                            </td>
                            <td style='width:15px; text-align:center'>:</td>
                            <td>Rp. {{angkaRupiah($total+$ongkir)}}</td>
                        </tr>
                        <tr style="height:25px;">
                            <td>
                                <b>Kurir</b>
                            </td>
                            <td style='width:15px; text-align:center'>:</td>
                            <td>{{$kurir}} / {{$layanan}}</td>
                        </tr>
                        <tr style="height:25px;">
                            <td>
                                <b>Cek Pemesanan</b>
                            </td>
                            <td style='width:15px; text-align:center'>:</td>
                            <td><a href="{{url('admin/pemesanan/'.$pemesanan_id)}}">Klik Disini</a></td>
                        </tr>
                    </table>
                    
                    <br>
                    <p style="{{ $style['paragraph'] }}">
                        Admin,<br>Aficha Store
                    </p>
                </td>
            </tr>
        </table>
    </td>
</tr>

@endsection