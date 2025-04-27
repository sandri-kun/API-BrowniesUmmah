<?php
// Set header untuk file CSV
header('Content-Type: text/csv');
header('Content-Disposition: attachment;filename="laporan_bulanan_maret_2025.csv"');

// Membuka file untuk output
$output = fopen('php://output', 'w');

// Menulis header kolom ke file CSV
fputcsv($output, ['No', 'Tanggal', 'Pendapatan', 'Pengeluaran', 'Saldo']);

// Menambahkan data laporan bulanan
$dataLaporan = [
    [1, '2025-03-01', 1000000, 500000, 500000],
    [2, '2025-03-02', 1200000, 600000, 600000],
    [3, '2025-03-03', 1100000, 450000, 650000],
    // Tambahkan data lainnya sesuai kebutuhan
];

// Menulis data laporan ke file CSV
foreach ($dataLaporan as $laporan) {
    fputcsv($output, $laporan);
}

// Menutup file
fclose($output);
exit;
?>
