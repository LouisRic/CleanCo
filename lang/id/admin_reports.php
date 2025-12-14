<?php

return [
    'title' => 'Laporan',
    'page_title' => 'Laporan Laundry',

    'table' => [
        'code' => 'Kode',
        'customer' => 'Pelanggan',
        'type' => 'Jenis',
        'order_date' => 'Tanggal Order',
        'weight' => 'Berat',
        'payment_status' => 'Status Pembayaran',
        'laundry_status' => 'Status Laundry',
        'pickup_status' => 'Status Pengambilan',
        'action' => 'Aksi',
        'details' => 'Detail',
    ],

    'status' => [
        'unpaid' => 'Belum Dibayar',
        'paid' => 'Sudah Dibayar',

        'process' => 'Diproses',
        'washed' => 'Dicuci',
        'ready' => 'Siap',
        'done' => 'Selesai',

        'pending' => 'Menunggu',
        'picked_up' => 'Diambil',
    ],
];
