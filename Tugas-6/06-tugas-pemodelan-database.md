# Perancangan Database E-Library Kampus

## Identitas Mahasiswa

Nama : Muh. An'amullah A.
NIM : D121241032

# 1. Deskripsi Sistem

E-Library Kampus merupakan sistem basis data yang digunakan untuk mengelola proses peminjaman dan pengembalian buku perpustakaan.

Sistem mencatat informasi mahasiswa sebagai pengguna perpustakaan, data buku, data penerbit, serta riwayat transaksi peminjaman dan pengembalian.

# 2. Tujuan Perancangan Database

Tujuan perancangan database ini adalah:

1. Membuat struktur penyimpanan data perpustakaan yang terorganisir.
2. Mengurangi redundansi data.
3. Menjaga hubungan antar tabel menggunakan Primary Key dan Foreign Key.
4. Mempersiapkan database agar dapat digunakan pada aplikasi berbasis web.

# 3. Kebutuhan Sistem

Berdasarkan studi kasus, sistem harus mampu menyimpan:

- Data mahasiswa.
- Data buku perpustakaan.
- Data penerbit buku.
- Data transaksi peminjaman.
- Data pengembalian buku.

# 4. Perancangan Entity Relationship Diagram

## Entitas Mahasiswa

| Atribut        | Keterangan       |
| -------------- | ---------------- |
| nim            | Primary Key      |
| nama_mahasiswa | Nama mahasiswa   |
| program_studi  | Program studi    |
| alamat         | Alamat mahasiswa |
| no_telepon     | Nomor telepon    |

## Entitas Buku

| Atribut      | Keterangan    |
| ------------ | ------------- |
| id_buku      | Primary Key   |
| judul_buku   | Judul buku    |
| tahun_terbit | Tahun terbit  |
| kategori     | Kategori buku |
| stok         | Jumlah buku   |
| id_penerbit  | Foreign Key   |

## Entitas Penerbit

| Atribut         | Keterangan    |
| --------------- | ------------- |
| id_penerbit     | Primary Key   |
| nama_penerbit   | Nama penerbit |
| alamat_penerbit | Alamat        |
| no_telepon      | Nomor telepon |

## Entitas Transaksi_Peminjaman

| Atribut         | Keterangan       |
| --------------- | ---------------- |
| id_transaksi    | Primary Key      |
| nim             | Foreign Key      |
| id_buku         | Foreign Key      |
| tanggal_pinjam  | Tanggal pinjam   |
| tanggal_kembali | Tanggal kembali  |
| status          | Status transaksi |
