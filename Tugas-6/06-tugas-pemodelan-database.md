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

# 5. Simulasi Normalisasi Database

## Unnormalized Form (UNF)

| NIM   | Nama Mahasiswa | Buku                        | Penerbit          | Tanggal Pinjam | Tanggal Kembali |
| ----- | -------------- | --------------------------- | ----------------- | -------------- | --------------- |
| 22001 | Andi           | Basis Data, Pemrograman Web | Informatika Press | 01-01-2026     | 07-01-2026      |

Permasalahan:

- Data buku memiliki nilai lebih dari satu.
- Terjadi pengulangan data.
- Struktur belum memenuhi bentuk normal pertama.

# First Normal Form (1NF)

| NIM   | Nama Mahasiswa | ID Buku | Judul Buku      | ID Penerbit |
| ----- | -------------- | ------- | --------------- | ----------- |
| 22001 | Andi           | B001    | Basis Data      | P001        |
| 22001 | Andi           | B002    | Pemrograman Web | P002        |

Perbaikan:

- Setiap atribut memiliki satu nilai.
- Kelompok data berulang sudah dihilangkan.

# Second Normal Form (2NF)

## Mahasiswa

| nim   | nama_mahasiswa |
| ----- | -------------- |
| 22001 | Andi           |

## Buku

| id_buku | judul_buku | id_penerbit |
| ------- | ---------- | ----------- |
| B001    | Basis Data | P001        |

## Transaksi

| id_transaksi | nim   | id_buku |
| ------------ | ----- | ------- |
| T001         | 22001 | B001    |

# Third Normal Form (3NF)

Pada tahap Third Normal Form dilakukan pemisahan atribut yang memiliki ketergantungan transitif.

Pada bentuk 2NF, data penerbit masih memiliki hubungan langsung dengan tabel buku sehingga perlu dibuat tabel penerbit tersendiri.

Pemisahan ini dilakukan agar setiap atribut non-primary key hanya bergantung pada primary key dalam tabelnya.

## Struktur Database Setelah 3NF

### Tabel Mahasiswa

Atribut:

- nim (Primary Key)
- nama_mahasiswa
- program_studi
- alamat
- no_telepon

### Tabel Penerbit

Atribut:

- id_penerbit (Primary Key)
- nama_penerbit
- alamat_penerbit
- no_telepon

### Tabel Buku

Atribut:

- id_buku (Primary Key)
- judul_buku
- tahun_terbit
- kategori
- stok
- id_penerbit (Foreign Key)

### Tabel Transaksi_Peminjaman

Atribut:

- id_transaksi (Primary Key)
- nim (Foreign Key)
- id_buku (Foreign Key)
- tanggal_pinjam
- tanggal_kembali
- status

# Rancangan Tabel Database Akhir

## Tabel mahasiswa

| Field          | Tipe Data    | Key |
| -------------- | ------------ | --- |
| nim            | VARCHAR(15)  | PK  |
| nama_mahasiswa | VARCHAR(100) |     |
| program_studi  | VARCHAR(50)  |     |
| alamat         | TEXT         |     |
| no_telepon     | VARCHAR(15)  |     |

## Tabel penerbit

| Field           | Tipe Data    | Key |
| --------------- | ------------ | --- |
| id_penerbit     | INT          | PK  |
| nama_penerbit   | VARCHAR(100) |     |
| alamat_penerbit | TEXT         |     |
| no_telepon      | VARCHAR(15)  |     |

## Tabel buku

| Field        | Tipe Data    | Key |
| ------------ | ------------ | --- |
| id_buku      | INT          | PK  |
| judul_buku   | VARCHAR(150) |     |
| tahun_terbit | YEAR         |     |
| kategori     | VARCHAR(50)  |     |
| stok         | INT          |     |
| id_penerbit  | INT          | FK  |

## Tabel transaksi_peminjaman

| Field           | Tipe Data   | Key |
| --------------- | ----------- | --- |
| id_transaksi    | INT         | PK  |
| nim             | VARCHAR(15) | FK  |
| id_buku         | INT         | FK  |
| tanggal_pinjam  | DATE        |     |
| tanggal_kembali | DATE        |     |
| status          | VARCHAR(20) |     |
