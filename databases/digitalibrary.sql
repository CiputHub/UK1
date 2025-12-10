-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 10, 2025 at 04:32 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `digitalibrary`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `BukuID` int NOT NULL,
  `Judul` varchar(255) NOT NULL,
  `Penulis` varchar(255) DEFAULT NULL,
  `Penerbit` varchar(255) DEFAULT NULL,
  `tahun_terbit` int DEFAULT NULL,
  `cover` varchar(255) DEFAULT NULL,
  `deskripsi` text,
  `Stok` int NOT NULL DEFAULT '0' COMMENT 'Jumlah buku tersedia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`BukuID`, `Judul`, `Penulis`, `Penerbit`, `tahun_terbit`, `cover`, `deskripsi`, `Stok`) VALUES
(1, 'Celengan Guru', 'putra', 'gramedia', 2022, '1758168799_celengan guru.jpg', 'Dengan uang celengannya, Ruru membeli stoples besar madu. Dia lalu membawanya ke rumah Piko, sahabatnya, yang sedang sakit.  Namun, ketika sore hari Ruru baru ingat. Sore ini dia akan pergi ke pasar swalayan. Dan Dia akan membeli baju baru dengan uang celengannya.  Apakah Ruru menyesal? Inilah kisah tentang persahabatan dan belajar berbagi!', 5),
(6, 'Seporsi Mie Ayam sebelum Mati', 'Brian Khrisna', 'Grasindo', 2025, '1758250643_seporsi mi ayam.jpg', 'Ale, seorang lelaki berusia 37 tahun yang didiagnosa mengidap depresi akut ingin mengakhiri hidupnya. Ale merasa tak pernah bisa memilih sesuatu atas kehendaknya sendiri. Namun sebelum mati, ia ingin makan seporsi mie ayam terakhirnya, setidaknya itu adalah keputusan yang ia ambil atas kehendaknya sendiri. Blurb: Seperti malam-malam lain, aku pulang selepas lembur. Orang-orang di kantor yang sudah menikah, mereka akan pulang ke keluarganya masing-masing. Sementara aku yang tidak punya siapa-siapa ini, sekarang masih duduk sendirian di parkiran mobil yang sudah lengang, bersama sebotol bir, rokok murah, dan sepotong kue ulang tahunku sendiri yang kubeli dari toko manisan dekat kantor.\r\n\r\nAku takut kalau ternyata selama ini aku tidak pernah berhasil menjalani hidup seperti sebagaimana seharusnya. Di kepalaku sekarang, pertanyaan ini semakin lama semakin membesar. “Pantaskah hidup ini kulanjutkan?”\r\n\r\nAku berdiri menatap ke langit malam. Kini tekadku sudah bulat. Aku akan bunuh diri 24 jam dari sekarang.Harga = 2000', 4),
(7, 'The Power Habits of Rasulullah', 'Umi Dilla', 'Yash Media', 2024, '1758250933_habits of rasul.avif', 'Rasulullah merupakan sosok yang sangat mulia, dan tidak diragukan lagi bahwa kebiasaannya dapat menjadi contoh bagi kita dalam menjalani kehidupan sehari-hari. Dengan membaca buku ini, Anda akan mengetahui setiap detail kebiasaan Rasulullah yang berdampak positif bagi kehidupan kita.\r\n\r\nDalam buku ini, Anda akan menemukan kebiasaan ibadah Rasulullah yang sangat tekun dan konsisten, seperti sholat malam, puasa sunnah, dan membaca Al-Quran setiap hari. Bukan hanya itu, kebiasaan umum Rasulullah seperti berpakaian sederhana, bermusyawarah, dan sabar dalam menghadapi ujian hidup juga akan Anda temukan dalam buku ini.\r\n\r\n', 2),
(8, 'The Habit Journal', 'James Clear', 'Gramedia Pustaka Utama', 2022, '1758250472_habit.jpg', 'Habit Journal adalah buku catatan berdasarkan buku mega bestseller Atomic Habits yang memungkinkan kita memaksimalkan terbentuknya kebiasaan baik.\r\n\r\nJurnal yang unik ini dilengkapi dengan 12 halaman Pelacak Kebiasaan yang bisa ditempel di lemari es, meja kerja, atau tempat mana pun yang kita suka. Selain itu, indeks dan bagian Satu Garis per Hari di jurnal ini akan memudahkan kita membentuk kebiasaan membuat jurnal harian.\r\n\r\nAda empat bagian dari jurnal ini yang menyediakan contoh dan desain, yaitu Perkakas Pelacak Kebiasaan, Perkakas Pembuatan Keputusan, Perkakas Produktivitas, dan Perkakas Kebugaran. Semua itu akan membantu kita melakukan perubahan-perubahan kecil yang mendatangkan hasil luar biasa.', 4),
(9, 'Filsafat Ilmu Akuntansi', 'Prof. Dr. Hj. Winwin Yadiati Dan Supriyati', 'Kencana', 2025, '1758251510_ekonomi.avif', 'Buku Filsafat Ilmu Akuntansi ini sebagai acuan mendalam yang mengungkapkan kompleksitas dan relevansi filsafat dalam konteks ilmu akuntansi. Dengan perjalanan yang mendalam, pembaca akan diajak untuk menjelajahi pertanyaan-pertanyaan filosofis yang mendasari praktik akuntansi.\r\n\r\nFilsafat Ilmu Akuntansi pertama-tama menjelaskan konsep-konsep dasar filsafat, konsep pengetahuan dan ilmu, epistemologi (pengetahuan), ontologi (keberadaan), dan aksiologi, serta dijelaskan juga konsep filsafat dalam pandangan islam. Melalui berbagai kajian kasus dan pemikiran filosofis yang mendalam, buku ini membantu pembaca memahami bahwa ilmu akuntansi bukan hanya sekadar serangkaian teknik dan aturan, tetapi juga memiliki dasar filosofis yang kuat yang membentuk cara kita memahami, mengkritisi, dan mengembangkan ilmu akuntansi.', 6),
(31, 'Petualangan Kuro : Jurasik Aquatik', 'Jester', 'cv. indonesia writing edu center (iwec) k1', 2025, '1758466781_jvik90kuau.avif', 'Di laut nan jauh, hiduplah bajak laut bernama Kuro, bersama dengan krunya dan seorang nelayan bernama Sailor. Suatu hari saat kapal Kuro sedang berlabuh di pantar, Sailor ingin pergi memancing ikan di tengah laut, jadi dia meminta izin ke Kuro dan pergi saat petang. Tapi hingga keesokan harinya Sailor tidak kunjung pulang dan sekoci yang Sailor pakai ditemukan mengapung di tengah laut.\r\nKuro dan teman-temannya memulai sebuah perjalanan seru ke dunia bawah laut yang penuh misteri. Tanpa diduga, mereka menemukan pintu gerbang menuju masa lalu, tepatnya ke zaman Jurasik—namun bukan di daratan, melainkan di samudra purba!', 6),
(32, 'Tadabbur Al-Quran untuk Anak', 'Muhamad Yasir. Lc', 'Al Kautsar Kids', 2025, '1758467236_ukrrbb-b0k.avif', 'Apakah anak-anak sudah bisa men-tadabburi Al-Qur’an?\r\nBagaimana caranya?\r\n\r\nMelalui ayat-ayat pilihan dan kisah-kisah yang menerangkannya, Tadabbur Al-Qur’an untuk Anak ini adalah salah satu cara mendekatkan anak-anak kita pada Al-Qur’an.\r\n\r\nBuku ini memadukan hikmah dan kisah dalam bahasa yang mudah dipahami, tulisan yang tidak panjang, sumber yang jelas, serta ilustrasi menarik. Di dalamnya terdapat banyak nilai kebaikan seperti aqidah, ibadah, akhlak, dan muamalah yang bisa diterapkan sehari-hari. Mulai dari sikap jujur, berbakti kepada orangtua, sedekah dan suka memberi, menjaga rasa malu, dan sebagainya.', 2),
(33, ' Arsitektur Rumah Jawa', 'Asti Musman', 'Anak Hebat Indonesia', 2024, '1758467400_38c3hkutp73iuonbm3sr5a.avif', 'Persepsi umum terhadap karakter orang Jawa seringkali dipandang sebagai individu yang hidup secara sederhana, tidak terlalu mengutamakan kenyamanan dalam kehidupannya. Ada pepatah Jawa yang mengatakan \"Urip mung mampir ngombe\" yang berarti kehidupan di dunia ini hanyalah sementara, seakan-akan menunjukkan ketidakpedulian orang Jawa terhadap materi dan kesenangan duniawi.\r\n\r\nNamun, pemikiran tersebut tidak sepenuhnya benar. Dalam kebudayaan Jawa, seorang pria dianggap telah menjalani hidup yang lengkap apabila ia memiliki lima hal esensial, yaitu rumah, kuda, burung, pasangan wanita, dan keris.', 9),
(34, 'Janji di Tanah Jawa', 'Agil Sri Rahayu ', 'Skuad', 2025, '1758467865_tnn4dz-a1a.avif', 'Jayamukti 1840, cinta dan dendam pernah berjalan beriringan. Manggala, anak yang terusir karena aib keluarga, kembali dengan misi rahasia darn hatí yang penuh luka. Kinanti, gadis bupati yang teguh dan berani, terjebak dalam pusaran fitnah dan tradisi.\r\n\r\nKetika konspirasi mengancam kehormatan dan nyawa, mereka dipaksa bersatu dalam pernikahan yang tak diinginkan. Namun, ketika cinta mulai tumbuh di tengah badai, mereka terpaksa harus memilih antara tetap menggenggam janji setia pada tanah kelahiran, atau merengkuh pelarian sebagai harga sebuah cinta.', 6),
(35, 'Filsafat Islam ', 'Dr. Musa Asy` Arie ', 'Lesfi', 2017, '1758469530_9789795670124C_9789795670124.jpg', 'Perbincangan tentang ilmu pengetahuan tentu saja tidak akan pernah ada habisnya. Salah satu ilmu pengetahuan yang populer adalah filsafat. Filsafat Islam itu sudah terang benderang dan memiliki pusat dari tradisi cara seorang Nabi Allah berfikir, dan juga merupakan sunnah Nabi Muhammad SAW dalam Berfikir yang sudah dijalankan bertahun-tahun dan berperan sebagai bentuk pandangan hidupnya, yang sudah seharusnya menjadi teladan bagi umatnya untuk membangun dan menjaga kebudayaan tetap berkembang diatas martabat kesusilaan dan spiritualitas kemanusiaan universal.\r\n\r\nFilsafat bukan anak haram Islam. Filsafat adalah anak kandung yang sah dari risalah kenabian. Ia adalah sunnah Nabi dalam berpikir, bukan bi\'dah dari Yunani, karena ia lahir dari kandungan kitab dan hikmah. Ungkapan ini adalah salah satu kesimpulan Prof. Dr. Musa Asy\'arie dalam buku ini setelah melakukan pengembaraan reflektif yang panjang dalam upaya menemukan sumber dan hakikat Filsafat Islam.', 10),
(36, 'Kamus Bahasa Jepang', 'Diramoti Benedict ', 'DAMIGO BOOKS', 2021, '1758469741_d1bbb8fd73b7cffb5ee193c2a213a138.avif', 'Buku ini memuat ribuan entri kosakata bahasa Jepang. Entri kosakata tersebut mencakup kosakata Jepang-Indonesia dan Indonesia-Jepang. Setiap kosakata Jepang, disertai tulisan kanji (Hiragana dan Katakana) dan cara membacanya dalam ejaan latinnya. Isi buku juga ditunjang oleh sejumlah bonus, yang bukan saja menarik tapi juga substantif dalam membantu proses pemahaman bahasa Jepang pembaca secara umum.\r\nBuku kamus ini memuat kosakata pilihan yang benar-benar relatif dibutuhkan oleh pembelajar pemula hingga cocok untuk pembelajar menengah. Dan yang membuatnya lebih spesial lagi adalah bahwa kamus ini tetap bisa digunakan untuk level ahli yang mana di dalam kamus terdapat kosakata khusus. Setiap kosakata Jepang juga dilengkapi dengan tulisan kanji (Hiragana dan Katakana) yang akan membantu dalam mempelajari tulisan kanji tersebut. Terdapat banyak bonus yang akan didapatkan pula, seperti E-Book Hiragana dan Katakana, E-Book 11 paket percakapan sehari-hari, dan E-Book 33 salam popular.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `kategoribuku`
--

CREATE TABLE `kategoribuku` (
  `KategoriID` int NOT NULL,
  `NamaKategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategoribuku`
--

INSERT INTO `kategoribuku` (`KategoriID`, `NamaKategori`) VALUES
(3, ' Pendidikan'),
(5, 'Agama'),
(7, 'Pengembangan Diri'),
(8, 'Komik & Novel'),
(9, 'Sejarah'),
(10, 'Kamus'),
(11, 'Biografi'),
(12, 'Filsafat');

-- --------------------------------------------------------

--
-- Table structure for table `kategoribuku_relasi`
--

CREATE TABLE `kategoribuku_relasi` (
  `KategoriBukuID` int NOT NULL,
  `BukuID` int DEFAULT NULL,
  `KategoriID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `kategoribuku_relasi`
--

INSERT INTO `kategoribuku_relasi` (`KategoriBukuID`, `BukuID`, `KategoriID`) VALUES
(2, 1, 8),
(3, 6, 3),
(4, 7, 7),
(6, 9, 3),
(7, 31, 8),
(9, 32, 5),
(10, 33, 9),
(11, 34, 11),
(12, 35, 12),
(13, 36, 10);

-- --------------------------------------------------------

--
-- Table structure for table `koleksipribadi`
--

CREATE TABLE `koleksipribadi` (
  `KoleksiID` int NOT NULL,
  `UserID` int DEFAULT NULL,
  `BukuID` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `koleksipribadi`
--

INSERT INTO `koleksipribadi` (`KoleksiID`, `UserID`, `BukuID`) VALUES
(18, 2, 6),
(23, 2, 1),
(24, 2, 9),
(29, 7, 7),
(30, 7, 6),
(31, 7, 36),
(32, 7, 35);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `PeminjamanID` int NOT NULL,
  `UserID` int DEFAULT NULL,
  `BukuID` int DEFAULT NULL,
  `TanggalPeminjaman` date DEFAULT NULL,
  `TanggalPengembalian` date DEFAULT NULL,
  `StatusPeminjaman` enum('dipinjam','dikembalikan') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'dipinjam'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`PeminjamanID`, `UserID`, `BukuID`, `TanggalPeminjaman`, `TanggalPengembalian`, `StatusPeminjaman`) VALUES
(3, 2, 7, '2025-09-18', '2025-09-20', 'dipinjam'),
(7, 2, 7, '2025-09-18', '2025-09-25', 'dipinjam'),
(8, 2, 7, '2025-09-18', '2025-09-25', 'dipinjam'),
(9, 7, 9, '2025-09-21', '2025-09-28', 'dipinjam'),
(10, 7, 8, '2025-09-21', '2025-09-22', 'dikembalikan'),
(11, 7, 7, '2025-09-21', '2025-09-21', 'dikembalikan'),
(12, 7, 35, '2025-09-21', '2025-09-28', 'dipinjam'),
(13, 7, 36, '2025-09-21', '2025-09-22', 'dikembalikan'),
(14, 7, 36, '2025-09-22', '2025-09-29', 'dipinjam');

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `PengembalianID` int NOT NULL,
  `PeminjamanID` int NOT NULL,
  `TanggalPengembalian` date NOT NULL,
  `KondisiBuku` enum('baik','rusak ringan','rusak berat') NOT NULL,
  `Dokumentasi` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pengembalian`
--

INSERT INTO `pengembalian` (`PengembalianID`, `PeminjamanID`, `TanggalPengembalian`, `KondisiBuku`, `Dokumentasi`) VALUES
(3, 14, '2025-09-24', 'rusak ringan', '1758712506_buku dikembalikan.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `ulasanbuku`
--

CREATE TABLE `ulasanbuku` (
  `UlasanID` int NOT NULL,
  `UserID` int DEFAULT NULL,
  `BukuID` int DEFAULT NULL,
  `Ulasan` text,
  `rating` tinyint(1) NOT NULL DEFAULT '5'
) ;

--
-- Dumping data for table `ulasanbuku`
--

INSERT INTO `ulasanbuku` (`UlasanID`, `UserID`, `BukuID`, `Ulasan`, `rating`) VALUES
(4, 2, 1, 'bagusss', 95),
(5, 2, 7, 'buku ini sangat menyenangkan', 99),
(6, 7, 6, 'sangat menyentuh hati dan sedihh ghuhhuhuhu ini buku sangat rekomended wajib kalian baca dan sekali seumur hidup', 100),
(7, 7, 9, 'ini buku sangat membantu finansial dan ekonomi saya, saya jadi suka investasi dan menabung untuk kepentingan ekonomi dan meningkatkan value saya', 96),
(8, 7, 35, 'bagusss', 96),
(9, 7, 35, 'keren', 5);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `NamaLengkap` varchar(255) DEFAULT NULL,
  `Alamat` text,
  `Role` enum('administrator','petugas','peminjam') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `Username`, `Password`, `Email`, `NamaLengkap`, `Alamat`, `Role`) VALUES
(2, 'Putra', '$2y$10$33O2n3Id9lqkmxLnS6lGouQPaz62Etsg3TJ5oebhubGvP3xCyj.OW', 'admin@gmail.com', 'inka afrian saputra', 'Jalan Dusun Sidamulya,RT11/RW3,Tambakreja, LAKBOK,KAB.CIAMIS,JAWA BARAT,ID 46385', 'administrator'),
(5, 'yanto', '$2y$10$8e6vKKxTwinMUrT/S5LhauuxApFnxMqBKwZYfFc3WKtRpSL4E7zKa', 'petugas@gmail.com', 'ciput cihuy', 'langen banjar', 'petugas'),
(7, 'dimas', '$2y$10$SaS5u90OqCX6J6.wuyI3TO2cyKURNLltSh9P2LgoNVa4spNh6t.xi', 'dimas@gmail.com', 'dimas prasatya', 'langen', 'peminjam'),
(9, 'Ciput', '$2y$10$HugKHGl.Cw5Q5MKz99iYL.R8tX9Ng39bFHB8rZwcHXDTvOlHyh1fS', 'peminjam@gmail.com', 'dika nugraha', 'langensari', 'peminjam');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`BukuID`);

--
-- Indexes for table `kategoribuku`
--
ALTER TABLE `kategoribuku`
  ADD PRIMARY KEY (`KategoriID`);

--
-- Indexes for table `kategoribuku_relasi`
--
ALTER TABLE `kategoribuku_relasi`
  ADD PRIMARY KEY (`KategoriBukuID`),
  ADD KEY `BukuID` (`BukuID`),
  ADD KEY `KategoriID` (`KategoriID`);

--
-- Indexes for table `koleksipribadi`
--
ALTER TABLE `koleksipribadi`
  ADD PRIMARY KEY (`KoleksiID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `BukuID` (`BukuID`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`PeminjamanID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `BukuID` (`BukuID`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`PengembalianID`),
  ADD KEY `PeminjamanID` (`PeminjamanID`);

--
-- Indexes for table `ulasanbuku`
--
ALTER TABLE `ulasanbuku`
  ADD PRIMARY KEY (`UlasanID`),
  ADD KEY `UserID` (`UserID`),
  ADD KEY `BukuID` (`BukuID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `BukuID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `kategoribuku`
--
ALTER TABLE `kategoribuku`
  MODIFY `KategoriID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `kategoribuku_relasi`
--
ALTER TABLE `kategoribuku_relasi`
  MODIFY `KategoriBukuID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `koleksipribadi`
--
ALTER TABLE `koleksipribadi`
  MODIFY `KoleksiID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `PeminjamanID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `PengembalianID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ulasanbuku`
--
ALTER TABLE `ulasanbuku`
  MODIFY `UlasanID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `kategoribuku_relasi`
--
ALTER TABLE `kategoribuku_relasi`
  ADD CONSTRAINT `kategoribuku_relasi_ibfk_1` FOREIGN KEY (`BukuID`) REFERENCES `buku` (`BukuID`) ON DELETE CASCADE,
  ADD CONSTRAINT `kategoribuku_relasi_ibfk_2` FOREIGN KEY (`KategoriID`) REFERENCES `kategoribuku` (`KategoriID`) ON DELETE CASCADE;

--
-- Constraints for table `koleksipribadi`
--
ALTER TABLE `koleksipribadi`
  ADD CONSTRAINT `koleksipribadi_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `koleksipribadi_ibfk_2` FOREIGN KEY (`BukuID`) REFERENCES `buku` (`BukuID`) ON DELETE CASCADE;

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`BukuID`) REFERENCES `buku` (`BukuID`) ON DELETE CASCADE;

--
-- Constraints for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `pengembalian_ibfk_1` FOREIGN KEY (`PeminjamanID`) REFERENCES `peminjaman` (`PeminjamanID`);

--
-- Constraints for table `ulasanbuku`
--
ALTER TABLE `ulasanbuku`
  ADD CONSTRAINT `ulasanbuku_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`) ON DELETE CASCADE,
  ADD CONSTRAINT `ulasanbuku_ibfk_2` FOREIGN KEY (`BukuID`) REFERENCES `buku` (`BukuID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
