-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 17, 2025 at 04:51 AM
-- Server version: 8.0.30
-- PHP Version: 8.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u-productive`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `article_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(255) DEFAULT 'pending',
  `user_id` int DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `category_id` int DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`article_id`, `title`, `content`, `created_at`, `status`, `user_id`, `modified_at`, `category_id`, `image`, `is_active`) VALUES
(19, 'Pentingnya Menjaga Kesehatan Mental', 'Kesehatan mental seringkali terabaikan dalam kehidupan modern yang penuh dengan tekanan dan tuntutan. Namun, kesehatan mental merupakan komponen yang sangat penting dalam kehidupan kita. Tanpa kesehatan mental yang baik, kita akan mengalami berbagai masalah seperti stres, kecemasan, depresi, dan bahkan gangguan mental yang lebih serius.\r\n\r\nKesehatan mental mencakup banyak aspek, di antaranya kemampuan untuk mengelola emosi, berpikir jernih, membangun hubungan yang sehat dengan orang lain, dan merasakan kebahagiaan serta kepuasan dalam hidup. Ketika kesehatan mental kita terganggu, kita akan merasa tidak berdaya, kehilangan motivasi, dan sulit untuk menjalani kehidupan sehari-hari dengan baik.\r\n\r\nAda beberapa cara yang dapat kita lakukan untuk menjaga kesehatan mental, antara lain:\r\n\r\n1. Olahraga Teratur: Olahraga tidak hanya baik untuk kesehatan fisik, tetapi juga dapat membantu meningkatkan suasana hati, mengurangi stres, dan meningkatkan rasa percaya diri.\r\n\r\n2. Pola Tidur yang Sehat: Tidur yang cukup dan berkualitas sangat penting untuk kesehatan mental. Kurang tidur dapat menyebabkan kelelahan, mudah tersinggung, dan sulit berkonsentrasi.\r\n\r\n3. Nutrisi yang Seimbang: Makanan yang sehat dan bergizi dapat membantu menjaga keseimbangan kimia di otak, yang berperan penting dalam kesehatan mental.\r\n\r\n4. Manajemen Stres: Belajar cara mengelola stres dengan baik, seperti melakukan meditasi, yoga, atau aktivitas relaksasi lainnya, dapat membantu mencegah dampak negatif dari stres yang berkepanjangan.\r\n\r\n5. Hubungan Sosial yang Sehat: Memiliki hubungan sosial yang positif dan dukungan dari orang-orang terdekat dapat memberikan kenyamanan emosional dan meningkatkan rasa bahagia.\r\n\r\n6. Mencari Bantuan Profesional: Jika mengalami masalah kesehatan mental yang serius, jangan ragu untuk mencari bantuan dari profesional seperti psikolog atau psikiater.\r\n\r\n \r\n\r\nKesehatan mental adalah aspek yang sangat penting dalam kehidupan kita. Dengan menjaga kesehatan mental, kita dapat meningkatkan kualitas hidup, produktivitas, dan hubungan interpersonal yang lebih baik. Jangan pernah menganggap remeh kesehatan mental, karena kesehatan mental yang baik adalah kunci untuk hidup yang lebih bahagia dan bermakna. (by Arwin)', '2024-11-08 05:05:10', 'approved', 18, '2024-12-03 15:10:00', 21, 'images/igZY5YBdyidCsgvIxiVsjNIBW2Yp5ifuc3nb82aY.jpg', 1),
(20, 'ARTIKEL POPULER \"PERAN MAHASISWA DALAM DUNIA KAMPUS\"', 'Mahasiswa memang menjadi topik yang baik buat dibicarakan, banyak orang awam dan masyarakat menilai bahwa mahasiswa sekarang memiliki tingkah laku yang kurang baik , bersikap semaunya, mahasiswa datang kekampus dan pulang semaunya. Mahasiswa memang dianggap dapat mencerminkan sikap seseorang, banyak orang yang tidak tau bagaimana kehidupan mahasiswa yang sebenarnya baik dikampus maupun diluar kampus. kehidupan Mahasiswa memang sangat sulit ditebak dimana mahasiswa cenderung mengekspresikan kehidupannya dikampus dibandingkan di masyarakat luas, mungkin ada sebagian besar mahasiswa yang terjun langsung ke masyarakat karna tuntutan mata kuliah yang harus di capai.\r\nSalah satu contoh kehidupan kampus adalah menjadi aktivis dalam berbagai organisasi yang berjalan di kampus. Bagi aktivis, kampus adalah hidupnya dimana mereka sering melakukan berbagai kegiatan, berorganisasi dan membentuk suatu forum kerja sama yang baik antar sesama mahasiswa. Menurut saya kehidupan kampus itu sangat unik, saya sebagai mahasiswa merasa kampus memang kehidupan yang benar- benar nyata, kita dapat saling mengenal satu sama lain, memiliki banyak teman bahkan kenalan baru, dapat menghargai bagaimana yang dikatakan bekerja sama dan dapat berbagi ilmu yang bermanfaat.\r\nSalah satu peran yang paling utama yang dapat dilakukan oleh seorang mahasiswa yaitu menaati segala peraturan yang berjalan dikampus, mengamalkan ilmu yang telah kita peroleh dari ibu dan bapak dosen sehingga dapat menerapkannya dalam masyarakat diluar lingkungan kampus dan menaati segala kebijakan- kebijakan yang diterapkan kampus dengan begitu kamu sudah setengah berperan sebagai mahasiswa.\r\n\r\nDefinisi Mahasiswa/i\r\nMahasiswa dapat merupakan suatu komunitas yang berada di masyarakat, dengan sedikit potensi dan kesempatan yang dimilikinya. Mahasiswa memiliki definisi yaitu sesuatu yang dimiliki oleh seseorang yang sedang belajar diperguruan tinggi baik itu di universitas, institut ataupun akademi yang diharapkan nantinya dapat berguna bagi bangsa dan negaranya. Berikut definisi mahasiswa menurut para ahli :\r\n\r\n• Menurut Knopfemacher : Mahasiswa adalah seorang calon sarjana yang terlibat dalam perguruan tinggi yang di didik dan diharapkan dapat menjadi calon-calon yang intelektual.\r\n\r\nDari definisi mahasiswa yang dipaparkan oleh seorang ahli diatas, kita dapat mengetahui bagaimana yang disebut sebagai mahasiswa. Peran Mahasiswa dikampus tidak hanya mempelajari masalah teori saja tetapi juga teori yang dapat di praktekkan dalam kehidupan nyata. Kampus merupakan tempat mahasiswa untuk membenahi diri , mengetahui bakat apa yang ada pada dirinya, dan minat apa yang akan dikembangkan kedepannya, tetapi jika semua itu hanya didasarkan pada teori saja maka sulit bagi seseorang menemukan bakat dan minat itu pada dirinya.\r\n\r\nPeran Mahasiswa/i dikampus\r\nPeran memiliki arti fungsi atau perilaku seseorang, yang memiliki status atau kedudukan tertentu. Peran mahasiswa dikampus dapat dilihat dari seberapa aktif dan tidaknya mahasiswa tersebut dikampus, dalam dunia kampus mahasiswa diharuskan dapat memajukan kampus baik itu melalui organisasi – organisasi yang berjalan dikampus maupun mengikuti perlombaan yang berjalan dikampus. Generasi yang inovatif dan kreatif sangat diperlukan, dimana mahasiswa harus memiliki sifat yang tangguh, menjaga nilai-nilai masyarakat, jujur, adil begitupun dalam kehidupan bermasyarakat, mahasiswa dituntut berfikir secara ilmiah dan nantinya dapat menerapkan segala ilmu yang telah diperoleh dalam perkuliahan.\r\nDidunia kampus banyak ditemukan beragam gaya hidup mahasiswa dimana ada yang nongkrong dihalaman kampus saat habis jam perkuliahan, ada yang duduk di kantin, melakukan kerja kelompok, membuat tugas, berbincang, bediskusi dan yang sering kita temui yaitu berorganisasi. Nongkrong merupakan gaya hidup yang paling banyak dilakukan oleh mahasiswa dilingkungan kampus, hal ini disebabkan karna tidak ada lagi kegiatan yang dilakukan diwaktu senggang sehingga mereka merasa bosan dan memilih untuk berkumpul bersama teman – teman. Banyak orang menganggap bahwa kegiatan ini hanya membuang – buang waktu dan tidak bermanfaat, tetapi bagi mereka yang sering nongkrong malah menganggap bahwa disaat inilah mereka bisa membagi waktu bersama teman, beristirahat, bahkan adapula yang berdiskusi dan membagi pegetahuan walaupun tidak berhubungan dengan perkuliahan. Bagi mahasiswa yang duduk dikantin juga tidak jauh beda dari kata nongkrong, bedanya ada yang makan, ada yang wi-fian sambil ngerjain tugas kampus dan ada juga ngobrol sambil menunggu jam kuliah dimulai kembali. Sedangkan bagi mahasiswa yang aktif dalam organisasi mereka cenderung sibuk dengan organisasi yang dijalaninya, mereka umumnya juga melakukan diskusi, kerja sama setelah jam perkuliahan, bedanya mereka mempunyai ruangan sendiri dalam berdiskusi.\r\nPeran organisasi sangat utama dalam suatu kampus, dimana dengan adanya organisasi yang berjalan dikampus maka mahasiswa dapat berperan lebih aktif di kampus dalam mengutarakan pendapat dan mengarahkan mahasiswa lain untuk lebih aktif, dapat menyalurkan minat dan hobi juga memperluas pengetahuan. Oleh karena itu, mahasiswa harus dapat memberikan bukti kepada masyarakat bagaimana perannya dikampus bahkan dimasyarakat. Sehingga masyarakat tidak berfikir bahwa mahasiswa hanya pergi dan pulang sesukanya dan tidak mentaati peraturan yang berlaku di lingkungan kampus.\r\n\r\nSimpulan\r\nMahasiswa memiliki peranan penting dalam dunia kampus, peran mahasiswa tidak hanya sebagai pelajar tetapi juga aktif dalam berbagai kegiatan kampus dan organisasi yang berjalan dikampus. Mahasiswa yang inovatif dan kreatif sangat diperlukan dalam kemajuan suatu kampus dimana mahasiswa harus mampu menerapkan segala yang diperoleh dibangku perkuliahan dan dapat terjun langsung kedalam masyarakat.', '2024-11-08 05:07:04', 'approved', 18, '2024-11-08 05:30:35', 23, 'images/RCDX92Crx8wUElKqsAAMYdSZc78X5Sbj4mBlDA7o.jpg', 1),
(21, 'Self Values :Fondasi Utama untuk Kepemimpinan yang Inspiratif dan Efektif', 'Di era digital yang penuh dengan persaingan dan perubahan cepat, menjadi seorang pemimpin yang efektif tidak lagi hanya tentang memiliki keterampilan teknis atau posisi yang tinggi. Kepemimpinan sejati kini menuntut keberanian, integritas, dan kesadaran diri yang kuat—semua berakar dari kemampuan seorang pemimpin untuk menghargai nilai dirinya, atau yang disebut self value. Tanpa nilai diri yang kokoh, seorang manajer akan kesulitan membangun kepercayaan dan motivasi, baik dalam dirinya maupun dalam tim yang dipimpinnya.\r\n\r\nSekarang, coba bayangkan Anda berada di tengah situasi penuh tekanan, di mana keputusan sulit harus segera diambil, dan tim Anda menunggu arah yang jelas. Pada saat seperti inilah self value seorang pemimpin diuji.', '2024-11-10 06:49:56', 'approved', 18, '2024-12-23 12:55:31', 20, 'images/yxqwEYTICiMHWexNlObgdcrB9NURsOSeyepvWBwP.jpg', 1),
(22, '10 Tips Kuliah untuk Mahasiswa Baru, Atur Strategi Belajarmu!', '1. Persiapkan mental\r\nHal pertama yang perlu Sobat Miku persiapkan adalah mental yang kuat. Dunia kuliah sama sekolah itu beda banget loh. Kita dituntut untuk menjadi mandiri mengatur waktu hingga mencari informasi. Makanya mandiri ini jadi kunci utama mahasiswa, so pastiin kamu menjadi “anak kuliahan” yang aktif mencari ilmu dan berinisiatif tinggi. \r\nBaca juga: 10 Rekomendasi Universitas Terbaik di Yogyakarta\r\n2. Atur Waktu Sesuai Skala Prioritas\r\nKalau udah jadi mahasiswa, penting banget nih bisa atur waktu dan skala prioritas dengan baik. Jadwal kuliah bisa berubah-ubah, dari pagi hingga sore. Makanya, penting bagi Miku untuk belajar mengatur waktu untuk kuliah, tugas, ikut kegiatan, hingga waktu istirahat. Ini juga membantu kamu memahami mana yang lebih dulu dikerjakan dan mana yang dapat ditunda. \r\n3. Pahami Jurusan dan Kampus\r\nSebelum mulai kuliah, kenalilah baik jurusan dan struktur kampus. Cari tahu akreditasi program studi serta riset kurikulum dan mata kuliah. Eksplorasi fasilitas kampus dan organisasi mahasiswa agar lebih cepat beradaptasi.\r\n4. Belajar Mandiri\r\nSebagai mahasiswa baru, kamu seharusnya cepat mencari informasi yang dibutuhkan. Coba deh cari materi pembelajaran yang sesuai, bikin rangkuman, kemudian atur strategi belajar yang efektif. \r\n5. Mencari Relasi dan Koneksi\r\nMasa orientasi dan ikut organisasi adalah waktu tepat buat Sobat Miku untuk kenalan dengan teman seangkatan dan senior. Relasi yang kamu dapatkan ini dapat membantu menciptakan lingkungan sosial yang positif. Teman seangkatan dapat menjadi support system yang buat kamu jadi kuat, sementara senior bisa jadi mentor bagi kamu untuk memahami kehidupan kampus.\r\n6. Persiapan Perlengkapan \r\nJangan lupa persiapkan segala hal yang berhubungan dengan jurusan untuk menunjukan produktivitas. Pilih perlengkapan yang sesuai dengan jurusan. Misalnya, laptop, tablet, atau perangkat khusus lainnya. Pastikan juga punya akses ke software dan aplikasi yang diperlukan sesuai dengan jurusan Sobat Miku ya!\r\n7. Kelola Keuangan dengan Bijak\r\nMengatur keuangan itu penting banget loh, khususnya untuk anak kuliah perantauan. Selalu catatan biaya anggaran untuk biaya kuliah, transportasi, makanan, dan kebutuhan lainnya agar kondisi keuangan kamu tetap sehat. Kamu juga belajar menabung dan bijak dalam pengeluaran bisa bantu mengatasi tantangan finansial.\r\n8. Adaptasi dengan Lingkungan Baru\r\nKadang kali bagi Sobat Miku yang kuliah di luar kota akan akan mungkin merindukan rumah. Sehingga kamu harus mempersiapkan diri untuk adaptasi dengan lingkungan sosial budaya. \r\nSelalu berkomunikasi rutin dengan keluarga agar membantu kamu untuk tidak merasa kesepian. Oh ya, kamu juga bisa aktif di kehidupan sosial kampus untuk mengurangi rasa kesepian.\r\n9. Sering Konsultasi dengan Dosen Pembimbing Akademik (PA)\r\nSelama di dunia kuliah, Sobat Miku perlu banget nih komunikasi yang aktif dengan pembimbing akademik. Jangan sungkan untuk menghubungi mereka terkait masalah perkuliahan karena mereka panduan soal kuliah, program studi, dan rencana akademik kamu.\r\n10. Mengetahui Layanan Bantuan Konseling\r\nAda berbagai kasus terkait mahasiswa baru yang sulit beradaptasi, maka selain menyiapkan mental, Sobat Miku juga perlu mencari tahu bantuan layanan. Di beberapa perguruan tinggi, biasanya menyediakan layanan konseling dengan psikolog untuk membantu mahasiswa. Tapi, Miku yakin kok Sobat Miku bisa melewati fase menjadi mahasiswa baru dengan kuat!', '2024-11-13 07:04:01', 'approved', 18, '2024-12-05 06:25:22', 30, 'images/h8122lSCynlCjlgK3XxU4Dhu5veSouKC3xxShUa1.jpg', 1),
(23, 'Pengembangan Kualitas Diri untuk Masa Depan yang Cerah', 'Pernahkah kamu merasa stuck dengan kemampuan diri sendiri? Pernahkah kamu mencoba untuk melakukan pengembangan diri atau self development?\r\n\r\nSelf development atau pengembangan diri adalah sebuah upaya yang bisa kamu lakukan untuk meningkatkan kemampuan diri guna mencapai cita-cita atau tujuan.\r\n\r\nMeningkatkan kemampuan atau skill dalam diri adalah salah satu hal yang penting untuk mencapai kesuksesan. Kamu tidak akan bisa maju jika hanya stuck dengan kemampuanmu yang sekarang ini.\r\n\r\nSeberapa pentingkah melakukan pengembangan diri, kapan harus mulai mengembangkan diri dan bagaimana caranya? Semua pertanyaan ini akan terjawab di sini.\r\nPentingnya Pengembangan Diri untuk Mencapai Kesuksesan Pribadi\r\n\r\nSelf development merupakan salah satu cara mencapai kesuksesan pribadi. Dengan melakukan pengembangan diri kamu bisa mencapai next level dalam kehidupan.\r\n\r\nTentunya kamu ingin mempunyai kepribadian yang lebih baik dari sekarang, bukan? Untuk bisa mencapainya, kamu perlu melakukan pengembangan diri.\r\n\r\nPengembangan diri ini bisa berupa pengembangan kemampuan atau skill dan pengembangan kepribadian. Untuk melakukan pengembangan diri ini Anda harus terus berlatih dan belajar.\r\n\r\nDengan terus berlatih dan belajar, tentunya kamu bisa mendapatkan banyak pengetahuan dan pengalaman. Pengetahuan dan pengalaman inilah yang menjadi dasar untuk mencapai kesuksesan. Dengan modal dasar ini, kamu harus berani mengambil action untuk terus melangkah guna mencapai cita-cita.\r\n\r\nLalu siapa yang membutuhkan pengembangan diri? Setiap manusia yang ingin maju dan sukses masih membutuhkannya. Terutama bagi kamu yang masih atau baru lulus kuliah, wajib terus melakukan pengembangan diri.\r\n\r\nJalan kehidupan yang akan kamu lalui masih panjang. Apalagi zaman cepat berubah, banyak bermunculan teknologi-teknologi baru. Kamu wajib terus melakukan pengembangan diri agar tetap up to date dan bisa sukses seiring perubahan zaman.', '2024-12-03 14:42:10', 'approved', 18, '2024-12-05 06:35:40', 20, 'images/SO2SUjZ42fWgtkerXwdh0jz3KFYEYwHwSjEoSS0d.jpg', 0),
(29, 'Karir dan Magang untuk Mahasiswa: Langkah Awal Menuju Sukses', 'Bagi mahasiswa, masa perkuliahan adalah waktu yang tepat untuk mempersiapkan diri menghadapi dunia kerja. Salah satu cara efektif untuk melakukannya adalah melalui magang. Program magang memberikan pengalaman langsung di dunia profesional, memungkinkan mahasiswa memahami budaya kerja, membangun koneksi, dan mengasah keterampilan praktis.\r\n\r\nMagang juga membuka peluang untuk menjelajahi karir yang sesuai dengan minat dan bidang studi. Selain itu, pengalaman magang sering menjadi nilai tambah dalam CV, yang membuat lulusan lebih kompetitif di pasar kerja.\r\n\r\nSebagai langkah awal, mahasiswa disarankan untuk aktif mencari informasi tentang program magang, menghadiri seminar karir, dan memanfaatkan layanan pusat karir di kampus. Dengan persiapan yang matang, magang dapat menjadi pintu gerbang menuju karir impian.\r\n\r\nSemangat dan keberanian untuk mencoba adalah kunci utama!', '2024-12-23 12:37:30', 'approved', 45, '2024-12-23 12:50:46', 22, 'images/Y3Q8DUaTWwd2QzwCLbwtozteVpxXhUyGzwcvCDvp.jpg', 1),
(30, 'Kelola Waktu dengan Teknik Pomodoro', 'Teknik Pomodoro adalah metode manajemen waktu yang membantu mahasiswa tetap fokus dan produktif dalam mengerjakan tugas. Metode ini melibatkan sesi kerja intens selama 25 menit, diikuti dengan istirahat singkat selama 5 menit. Setelah empat sesi (atau empat \"pomodoro\"), ambil istirahat lebih panjang sekitar 15-30 menit. Teknik ini efektif karena memberikan waktu untuk fokus sepenuhnya pada tugas tanpa terganggu oleh burnout atau rasa lelah.\r\n\r\nSelain itu, teknik Pomodoro dapat dikombinasikan dengan perencanaan tugas yang terorganisir. Sebelum memulai sesi, tulis daftar tugas yang ingin diselesaikan dan tetapkan prioritas. Dengan cara ini, Anda dapat mengelola energi lebih baik dan menyelesaikan lebih banyak pekerjaan dalam waktu yang relatif singkat.', '2024-12-23 12:39:42', 'rejected', 45, '2024-12-23 12:50:50', 30, 'images/ZY3STG3Cro0dMchO1zKkZNJKGEABmsHh8Y3zTVAG.jpg', 1),
(31, 'Manfaatkan Aplikasi Produktivitas', 'Di era digital, memanfaatkan aplikasi produktivitas dapat menjadi solusi untuk mengatur jadwal dan tugas sehari-hari. Aplikasi seperti Trello, Notion, atau Todoist memungkinkan mahasiswa untuk mencatat tugas-tugas mereka secara terstruktur. Anda bisa membuat daftar harian, mingguan, atau bahkan bulanan, lengkap dengan pengingat otomatis agar tidak ada pekerjaan yang terlewatkan.\r\n\r\nAplikasi ini juga mendukung pengelompokan tugas berdasarkan kategori, seperti akademik, organisasi, atau kegiatan pribadi. Hal ini membantu Anda untuk tetap fokus pada prioritas dan menghindari multitasking yang tidak produktif. Misalnya, Anda dapat mengatur tugas berdasarkan deadline, sehingga pekerjaan yang mendesak mendapatkan perhatian lebih dulu.\r\n\r\nKeunggulan lain dari aplikasi produktivitas adalah visualisasinya yang intuitif. Anda dapat melihat progres tugas secara keseluruhan melalui fitur seperti papan kanban atau kalender interaktif. Dengan cara ini, Anda tidak hanya menjadi lebih terorganisir, tetapi juga merasa termotivasi ketika melihat hasil kerja yang telah selesai.', '2024-12-23 12:41:19', 'pending', 45, '2024-12-23 12:41:19', 30, 'images/jMfxMDqdfwJezD16pj9wJ7mmBJMY6aMMZtmst1FY.jpg', 1),
(32, 'Optimalkan Lingkungan Belajar', 'Lingkungan belajar yang nyaman sangat penting untuk meningkatkan fokus dan produktivitas. Pastikan ruang belajar Anda bersih dan terorganisir, dengan meja kerja yang memiliki pencahayaan yang cukup dan bebas dari gangguan seperti ponsel atau televisi. Ruang yang tertata rapi akan membantu menciptakan suasana yang kondusif untuk belajar.\r\n\r\nAnda juga bisa menambahkan elemen dekoratif untuk meningkatkan kenyamanan, seperti tanaman kecil, lilin aromaterapi, atau poster motivasi. Selain itu, pilih kursi yang ergonomis untuk menjaga postur tubuh selama berjam-jam belajar. Hal sederhana ini dapat mencegah rasa lelah dan nyeri tubuh yang sering mengganggu konsentrasi.\r\n\r\nSelain lingkungan fisik, suasana mental juga perlu diperhatikan. Hindari tempat yang terlalu bising, atau gunakan headphone dengan musik instrumental jika itu membantu Anda fokus. Dengan menciptakan ruang belajar yang ideal, Anda akan lebih mudah menyelesaikan tugas-tugas secara efisien dan merasa lebih termotivasi setiap harinya.', '2024-12-23 12:52:42', 'approved', 46, '2024-12-23 12:54:49', 18, 'images/5oivdMSiVCTynmKG3WTx8mdP0LWzqVvLS7TAhe9S.jpg', 1),
(33, 'Cara Menjaga Kesehatan Mental', 'Untuk menjaga kesehatan mental, mahasiswa perlu mengambil langkah-langkah preventif. Berikut beberapa tips yang dapat diterapkan:\r\n\r\n    Kelola Waktu dengan Baik: Buatlah jadwal yang seimbang antara belajar, istirahat, dan aktivitas sosial. Jangan lupa sisihkan waktu untuk hobi atau kegiatan yang menyenangkan.\r\n    Berolahraga Secara Teratur: Aktivitas fisik dapat meningkatkan produksi endorfin, hormon yang membantu mengurangi stres dan meningkatkan suasana hati.\r\n    Cari Dukungan Sosial: Jangan ragu untuk berbicara dengan teman, keluarga, atau konselor jika merasa terbebani. Dukungan dari orang-orang terdekat sangat penting untuk mengurangi rasa kesepian.\r\n    Latih Mindfulness dan Relaksasi: Teknik seperti meditasi atau latihan pernapasan dapat membantu mengurangi kecemasan dan meningkatkan fokus.', '2024-12-23 12:54:25', 'approved', 46, '2024-12-24 02:20:09', 21, 'images/elb6sIp9xO2IBakK8SRTE1c6vSgdHMvu92f0y3AR.jpg', 1),
(34, 'Karir dan Magang: Langkah Awal Menuju Sukses', 'Karir merupakan perjalanan profesional seseorang yang melibatkan pengalaman, pencapaian, dan perkembangan di dunia kerja. Dalam membangun karir yang sukses, salah satu langkah awal yang penting adalah magang. Magang adalah kesempatan bagi mahasiswa atau pencari pengalaman kerja untuk belajar dan mendapatkan wawasan langsung di lingkungan kerja nyata.\r\nPentingnya Magang\r\nMagang memberikan kesempatan untuk:\r\n1.Meningkatkan Keterampilan Praktis: Anda dapat mengaplikasikan teori yang dipelajari di bangku kuliah ke dalam praktik.\r\n2.Memperluas Jaringan Profesional: Bertemu dengan para profesional di bidang yang diminati dapat membuka peluang karir di masa depan.\r\n3.Mengenali Dunia Kerja: Magang membantu memahami dinamika lingkungan kerja, termasuk etika dan budaya perusahaan.\r\nMenentukan Karir\r\nSaat memulai karir, penting untuk:\r\n1.Mengenal Minat dan Bakat: Pilihlah bidang yang sesuai dengan passion dan kemampuan Anda.\r\n2.Mencari Peluang: Manfaatkan situs pencari kerja, acara job fair, dan jaringan alumni untuk menemukan posisi yang diinginkan.\r\n3.Mengasah Keterampilan: Pelajari keterampilan yang relevan dengan pekerjaan yang diminati, seperti kemampuan komunikasi, teknologi, atau bahasa asing.\r\nKesimpulan\r\nMagang adalah pintu gerbang menuju karir yang sukses. Dengan pengalaman magang yang baik, Anda dapat membangun kepercayaan diri, memperkaya portofolio, dan meningkatkan peluang diterima di pekerjaan impian. Karir yang sukses tidak hanya ditentukan oleh gelar akademik, tetapi juga oleh kemauan untuk terus belajar dan beradaptasi dengan perubahan.\r\nMulailah langkah Anda sekarang, karena perjalanan ribuan mil dimulai dengan satu langkah kecil.', '2024-12-24 02:09:20', 'approved', 45, '2024-12-24 02:19:39', 22, 'images/kXEpfcUflGqezwwGHOc2lHmpOG0hrbOGjs2C9QEf.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `prodi_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `created_at`, `updated_at`, `prodi_id`) VALUES
(7, 'Web Programming', '2024-11-06 07:40:54', '2024-11-06 07:40:54', 1),
(8, 'Jaringan Komputer', '2024-11-06 07:40:54', '2024-11-06 07:40:54', 1),
(9, 'GIS', '2024-11-06 07:40:54', '2024-11-06 07:40:54', 1),
(10, 'Drainase', '2024-11-06 07:40:54', '2024-11-06 07:40:54', 2),
(11, 'Struktur Beton', '2024-11-06 07:40:54', '2024-11-06 07:40:54', 2),
(13, 'Robotika', '2024-11-06 07:40:54', '2024-11-06 07:40:54', 3),
(18, 'Teknik Belajar', '2024-11-07 21:53:55', '2024-11-07 21:53:55', NULL),
(19, 'Penulisan Akademik', '2024-11-07 21:54:34', '2024-11-07 21:54:34', NULL),
(20, 'Pengembangan Diri', '2024-11-07 21:54:44', '2024-11-07 21:54:44', NULL),
(21, 'Kesehatan Mental', '2024-11-07 21:55:21', '2024-11-07 21:55:21', NULL),
(22, 'Karir & Magang', '2024-11-07 21:55:43', '2024-11-07 21:55:43', NULL),
(23, 'Organisasi Kampus', '2024-11-07 21:55:52', '2024-11-07 21:55:52', NULL),
(24, 'Jalan', '2024-11-07 21:58:18', '2024-11-07 21:58:18', 2),
(25, 'Keselamatan Kerja (K3)', '2024-11-07 21:58:32', '2024-11-07 21:58:32', 2),
(26, 'Struktur Bangunan', '2024-11-07 21:58:56', '2024-11-07 21:58:56', 2),
(27, 'Machine Learning', '2024-11-07 22:00:25', '2024-11-07 22:00:25', 3),
(28, 'Kecerdasan Buatan', '2024-11-07 22:00:41', '2024-11-07 22:00:41', 3),
(29, 'Internet Of Things (IoT)', '2024-11-07 22:01:16', '2024-11-07 22:01:16', 3),
(30, 'Tips and Hack', '2024-11-07 22:09:12', '2024-11-07 22:09:12', NULL),
(31, 'searching', '2024-11-13 00:13:09', '2024-11-13 00:13:09', 2),
(32, 'relativitas', '2024-12-21 01:06:04', '2024-12-21 01:06:04', 2),
(34, 'testting', '2024-12-23 19:18:35', '2024-12-23 19:18:35', 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('approved','rejected') DEFAULT 'rejected',
  `user_id` int DEFAULT NULL,
  `post_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `content`, `created_at`, `status`, `user_id`, `post_id`) VALUES
(25, 'akan dirilis pada 26 Desember 2024. Musim ini diproduksi oleh Netflix. Musim ini dibintangi oleh Lee Jung-jae, Wi Ha-joon, dan Lee Byung-hun', '2024-11-08 07:10:30', 'rejected', 18, 6),
(26, 'yy', '2024-11-10 07:00:08', 'rejected', 18, 6),
(27, 'semangaat', '2024-11-13 07:08:40', 'rejected', 18, 8),
(29, 'mnmnmnmnmn', '2024-12-07 05:45:26', 'rejected', 18, 9),
(30, 'yeyyyyyyyy', '2024-12-21 09:02:42', 'rejected', 45, 9),
(31, 'testt123', '2024-12-21 09:11:05', 'rejected', 45, 9),
(32, 'wahhhhh!!! makasii kak wita untuk tipssnya, kayanyaaa bakal bergunaa dehhh', '2024-12-23 13:01:50', 'rejected', 46, 11),
(33, 'samaa samaa ka disaa', '2024-12-23 13:06:07', 'rejected', 45, 11),
(34, 'kadang udah ga megang hp malah pikiran kemana-mana, siapa disini yg suka mikirin mau makan apa pdhal masi jam perlajaran pertama?? hhuhuuu -_-', '2024-12-23 13:12:18', 'rejected', 18, 11),
(35, 'wahhh ka tassya123 kayanya pikirannya makanan mulu dehhh :>', '2024-12-23 13:13:11', 'rejected', 45, 11),
(36, 'mwheheheh iyaaaa niiii kaaa 🤣🤣🤣🤣', '2024-12-23 13:35:20', 'rejected', 18, 11),
(37, 'iyaa niiih', '2024-12-24 02:14:02', 'rejected', 45, 11);

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `favorite_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `article_id` int DEFAULT NULL,
  `video_id` int DEFAULT NULL,
  `post_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`favorite_id`, `user_id`, `article_id`, `video_id`, `post_id`, `created_at`, `updated_at`, `modified_at`) VALUES
(9, 18, NULL, NULL, 7, NULL, NULL, NULL),
(11, 18, NULL, NULL, 8, NULL, NULL, NULL),
(15, 18, NULL, NULL, 11, '2024-12-23 06:14:34', '2024-12-23 06:14:34', NULL),
(16, 45, NULL, NULL, 13, '2024-12-23 19:14:39', '2024-12-23 19:14:39', NULL),
(18, 18, NULL, NULL, 13, '2024-12-23 20:01:50', '2024-12-23 20:01:50', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `forum_post`
--

CREATE TABLE `forum_post` (
  `post_id` int NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `is_lecturer` tinyint(1) DEFAULT '0',
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `forum_post`
--

INSERT INTO `forum_post` (`post_id`, `content`, `created_at`, `is_lecturer`, `user_id`) VALUES
(6, 'Diterjemahkan dari bahasa Inggris-Musim kedua serial televisi thriller bertahan hidup distopia Korea Selatan Squid Game, yang dikembangkan untuk televisi oleh penulis dan produser televisi Korea Hwang Dong-hyuk, akan dirilis pada 26 Desember 2024. Musim ini diproduksi oleh Netflix. Musim ini dibintangi oleh Lee Jung-jae, Wi Ha-joon, dan Lee Byung-hun', '2024-11-08 07:08:51', 0, 18),
(7, 'akan dirilis pada 26 Desember 2024. Musim ini diproduksi oleh Netflix. Musim ini dibintangi oleh Lee Jung-jae, Wi Ha-joon, dan Lee Byung-hun', '2024-11-08 07:11:45', 0, 18),
(8, 'memanfaatkan waktu dengan belajaer', '2024-11-13 07:07:41', 0, 18),
(9, 'hallo semuaaa', '2024-12-03 14:44:33', 0, 18),
(10, 'yeyyyy', '2024-12-21 09:10:53', 0, 45),
(11, 'ada ga disini yang kesulitan untuk fokus saat kuliahhh?? aku punya beberapa tips nihhh\r\n1. yang paling pentingg klian harus selalu jaga kesehatan fisik maupun mentall ya\r\n2. teruss waktu lagi sesi pembelajaran catat point-point penting agar ga ketinggalan pelajarab\r\n3. ilangin gangguan kaya ponsel dll, jauhin dlu klw memang ga perluu\r\n\r\nsemangatttt selalu pejuang sarjanaaa!!!~~', '2024-12-23 13:00:47', 0, 45),
(12, 'o_o  Lollllll, 2k25 menuju semproooooo!!!!', '2024-12-23 13:14:25', 0, 18),
(13, 'pliss baru tauu ternyata bisa nambahin emottttt, pake windows + . (titik) ✌🤣🤣🤣😍😍😍😍', '2024-12-23 13:36:42', 0, 18),
(14, 'lagii sidaang niicctthhh😉😉', '2024-12-24 02:13:31', 0, 45);

-- --------------------------------------------------------

--
-- Table structure for table `histories`
--

CREATE TABLE `histories` (
  `history_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `article_id` int DEFAULT NULL,
  `video_id` int DEFAULT NULL,
  `viewed_at` timestamp NULL DEFAULT NULL,
  `ts_id` int DEFAULT NULL,
  `tk_id` int DEFAULT NULL,
  `if_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `histories`
--

INSERT INTO `histories` (`history_id`, `user_id`, `article_id`, `video_id`, `viewed_at`, `ts_id`, `tk_id`, `if_id`) VALUES
(6, 18, 20, NULL, '2024-11-07 22:09:30', NULL, NULL, NULL),
(7, 18, 19, NULL, '2024-11-07 22:09:46', NULL, NULL, NULL),
(8, 18, 19, NULL, '2024-11-07 22:12:16', NULL, NULL, NULL),
(9, 18, 20, NULL, '2024-11-07 22:12:32', NULL, NULL, NULL),
(10, 18, 19, NULL, '2024-11-07 22:12:45', NULL, NULL, NULL),
(11, 18, NULL, NULL, '2024-11-07 22:29:43', NULL, NULL, 8),
(12, 18, NULL, NULL, '2024-11-07 22:30:03', NULL, NULL, 8),
(13, 18, 20, NULL, '2024-11-07 22:30:54', NULL, NULL, NULL),
(14, 18, 19, NULL, '2024-11-07 22:31:17', NULL, NULL, NULL),
(15, NULL, 21, NULL, '2024-11-12 23:59:24', NULL, NULL, NULL),
(16, NULL, 19, NULL, '2024-11-13 00:00:10', NULL, NULL, NULL),
(17, NULL, NULL, 15, '2024-11-13 00:00:39', NULL, NULL, NULL),
(18, NULL, NULL, NULL, '2024-11-13 00:01:56', NULL, NULL, 14),
(19, 18, NULL, NULL, '2024-11-13 00:06:49', NULL, NULL, 15),
(20, 18, 20, NULL, '2024-11-13 00:24:24', NULL, NULL, NULL),
(21, 18, NULL, 16, '2024-11-28 23:43:42', NULL, NULL, NULL),
(22, 18, NULL, NULL, '2024-11-28 23:45:02', 8, NULL, NULL),
(23, 18, NULL, NULL, '2024-11-28 23:45:50', NULL, 8, NULL),
(24, NULL, NULL, NULL, '2024-11-29 01:04:58', NULL, 8, NULL),
(25, NULL, 22, NULL, '2024-12-03 07:30:41', NULL, NULL, NULL),
(26, NULL, NULL, 16, '2024-12-03 07:32:16', NULL, NULL, NULL),
(27, NULL, NULL, NULL, '2024-12-03 07:33:22', NULL, NULL, 16),
(28, NULL, NULL, NULL, '2024-12-03 07:34:05', 8, NULL, NULL),
(29, 18, NULL, 16, '2024-12-03 07:46:58', NULL, NULL, NULL),
(30, 18, 19, NULL, '2024-12-03 07:49:45', NULL, NULL, NULL),
(31, 18, NULL, 16, '2024-12-04 23:46:16', NULL, NULL, NULL),
(32, 18, NULL, NULL, '2024-12-05 00:45:26', 8, NULL, NULL),
(33, 18, NULL, NULL, '2024-12-05 00:45:54', 9, NULL, NULL),
(34, 18, NULL, NULL, '2024-12-05 00:46:54', NULL, 8, NULL),
(35, 18, NULL, NULL, '2024-12-05 00:47:37', NULL, 8, NULL),
(36, 14, 25, NULL, '2024-12-05 03:03:17', NULL, NULL, NULL),
(37, 14, 25, NULL, '2024-12-05 03:03:35', NULL, NULL, NULL),
(38, 14, 21, NULL, '2024-12-05 03:03:54', NULL, NULL, NULL),
(39, 14, 21, NULL, '2024-12-05 03:04:52', NULL, NULL, NULL),
(40, 14, 21, NULL, '2024-12-05 03:05:17', NULL, NULL, NULL),
(41, 14, 22, NULL, '2024-12-05 03:05:31', NULL, NULL, NULL),
(42, 14, NULL, 18, '2024-12-05 03:09:53', NULL, NULL, NULL),
(43, 14, NULL, 18, '2024-12-05 03:10:47', NULL, NULL, NULL),
(44, 14, NULL, 18, '2024-12-05 03:12:00', NULL, NULL, NULL),
(45, 14, 26, NULL, '2024-12-06 23:16:50', NULL, NULL, NULL),
(46, 14, NULL, 19, '2024-12-06 23:17:11', NULL, NULL, NULL),
(47, 14, 26, NULL, '2024-12-12 00:49:37', NULL, NULL, NULL),
(48, 14, 22, NULL, '2024-12-12 00:50:51', NULL, NULL, NULL),
(49, 14, NULL, 18, '2024-12-12 00:54:47', NULL, NULL, NULL),
(50, 14, 26, NULL, '2024-12-12 01:00:33', NULL, NULL, NULL),
(51, 14, 20, NULL, '2024-12-12 01:00:38', NULL, NULL, NULL),
(52, 14, NULL, 18, '2024-12-12 01:01:16', NULL, NULL, NULL),
(53, 14, NULL, 16, '2024-12-12 01:01:26', NULL, NULL, NULL),
(54, NULL, 22, NULL, '2024-12-21 01:40:00', NULL, NULL, NULL),
(55, NULL, 22, NULL, '2024-12-21 01:41:20', NULL, NULL, NULL),
(56, NULL, NULL, 18, '2024-12-21 01:41:24', NULL, NULL, NULL),
(57, NULL, NULL, NULL, '2024-12-21 01:41:36', NULL, NULL, 17),
(58, 14, 25, NULL, '2024-12-21 01:46:59', NULL, NULL, NULL),
(59, NULL, 22, NULL, '2024-12-21 02:05:41', NULL, NULL, NULL),
(60, NULL, NULL, 16, '2024-12-21 02:06:06', NULL, NULL, NULL),
(61, NULL, NULL, NULL, '2024-12-21 02:06:45', NULL, NULL, 16),
(62, 18, NULL, NULL, '2024-12-21 02:09:30', NULL, NULL, 16),
(63, 45, 27, NULL, '2024-12-21 02:15:00', NULL, NULL, NULL),
(64, 46, 32, NULL, '2024-12-23 05:52:50', NULL, NULL, NULL),
(65, 18, 33, NULL, '2024-12-23 06:14:51', NULL, NULL, NULL),
(66, 18, NULL, NULL, '2024-12-23 06:15:28', NULL, NULL, 13),
(67, 45, NULL, NULL, '2024-12-23 06:17:06', NULL, NULL, 18),
(68, 14, 31, NULL, '2024-12-23 08:09:56', NULL, NULL, NULL),
(69, 14, 31, NULL, '2024-12-23 08:10:02', NULL, NULL, NULL),
(70, 14, NULL, 21, '2024-12-23 08:12:57', NULL, NULL, NULL),
(71, 14, 32, NULL, '2024-12-23 08:41:16', NULL, NULL, NULL),
(72, 18, NULL, 19, '2024-12-23 17:44:55', NULL, NULL, NULL),
(73, NULL, 33, NULL, '2024-12-23 18:59:00', NULL, NULL, NULL),
(74, NULL, NULL, 20, '2024-12-23 19:00:54', NULL, NULL, NULL),
(75, NULL, NULL, 20, '2024-12-23 19:00:55', NULL, NULL, NULL),
(76, NULL, NULL, 20, '2024-12-23 19:01:40', NULL, NULL, NULL),
(77, NULL, NULL, NULL, '2024-12-23 19:02:34', NULL, NULL, 18),
(78, 45, NULL, NULL, '2024-12-23 19:11:45', NULL, NULL, 19),
(79, 14, 34, NULL, '2024-12-23 19:19:31', NULL, NULL, NULL),
(80, 18, NULL, NULL, '2024-12-23 19:44:31', NULL, NULL, 19),
(81, 18, NULL, NULL, '2024-12-23 19:46:10', NULL, NULL, 19),
(82, 18, NULL, NULL, '2024-12-23 19:47:46', NULL, NULL, 19),
(83, NULL, 34, NULL, '2024-12-23 19:48:24', NULL, NULL, NULL),
(84, NULL, NULL, NULL, '2024-12-23 19:49:15', NULL, NULL, 19),
(85, 18, NULL, NULL, '2024-12-23 19:50:51', NULL, NULL, 18);

-- --------------------------------------------------------

--
-- Table structure for table `informatics`
--

CREATE TABLE `informatics` (
  `if_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category_id` int NOT NULL,
  `file_pdf` varchar(255) NOT NULL,
  `thumbnail` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `informatics`
--

INSERT INTO `informatics` (`if_id`, `title`, `create_at`, `user_id`, `modified_at`, `category_id`, `file_pdf`, `thumbnail`) VALUES
(8, 'ANALISIS KINERJA APLIKASI ABSENSI PEGAWAI SDN 21 PAYAKUMBUH MENGGUNAKAN METODE USER ACCEPTANCE TESTING', '2024-11-08 05:26:23', 18, '2024-11-08 05:26:23', 7, 'file_pdfs/MFxsqOUGKuNTslDZn1FZxWuGs74qvnaGxZvnCHS3.pdf', NULL),
(9, 'ANALISIS KINERJA APLIKASI ABSENSI PEGAWAI SDN 21 PAYAKUMBUH MENGGUNAKAN METODE USER ACCEPTANCE TESTING', '2024-11-08 05:27:00', 18, '2024-11-08 05:27:00', 8, 'file_pdfs/5QxpXkibMkXWxmYiKOMDQzI2FAjwNqWpLUqOl8op.pdf', NULL),
(10, 'PROPOSAL ENTREPRENEURSHIP AWARDS “P’Loved FTY” USAHA BAJU BEKAS BERKUALITAS DENGAN HARGA  TERJANGKAU', '2024-11-08 05:27:38', 18, '2024-11-08 05:27:38', 9, 'file_pdfs/K31PNWBmj81ToJwlbb321QIuyHXO6j1AWmloKHAe.pdf', NULL),
(11, 'PENGARUH PENGGUNAAN APLIKASI SISTEM INFORMASI ABSENSI ONLINE TERHADAP  KINERJA PEGAWAI DINAS SOSIAL KABUPATEN SUMBAWA BARAT', '2024-11-08 05:28:14', 18, '2024-11-08 05:28:14', 7, 'file_pdfs/WUIKn3LWTprWOpsCmr8kU00pqtjcpqQfiJLlkoG6.pdf', NULL),
(12, 'Analisis Kualitas Pengalaman Pengguna Aplikasi Absensi Menggunakan  Metode User Experience Questionnaire', '2024-11-08 05:28:36', 18, '2024-11-08 05:28:36', 7, 'file_pdfs/APU7xCWoWpDjwLCCQsSe8JgxDmeh1qPxYs8HDnEp.pdf', NULL),
(13, 'ANALISIS ABSENSI ONLINE BERBASIS ANDROID PADA  PENINGKATAN KEDISIPLINAN DAN KINERJA PEGAWAI DI BALAI  PENGEMBANGAN KOMPETENSI PUPR WILAYAH I MEDAN', '2024-11-08 05:29:04', 18, '2024-11-08 05:29:04', 8, 'file_pdfs/EILIkLtOD6SUchja2SNMgZgRKcTGFZsoAysRtzJT.pdf', NULL),
(14, 'ANALISIS PENGGUNAAN APLIKASI KEHADIRAN PEGAWAI BERBASIS  ANDROID MENGGUNAKAN METODE SYSTEM USABILITY SCALE', '2024-11-08 05:29:30', 18, '2024-11-08 05:29:30', 9, 'file_pdfs/Y91ExWkpoZRlOnSwCbtO4u5KrcSwHh6fWWOI5jyu.pdf', NULL),
(15, 'tugas akhirr website', '2024-11-13 07:06:42', 18, '2024-11-13 07:06:42', 7, 'file_pdfs/jw3d50BkX3NJ4AlEBrMDZwWtDsvK2VdGC950magL.pdf', NULL),
(16, 'ANALISIS KINERJA APLIKASI ABSENSI PEGAWAI SDN 21 PAYAKUMBUH MENGGUNAKAN METODE USER ACCEPTANCE TESTING', '2024-12-03 13:57:25', 18, '2024-12-03 13:57:25', 7, 'file_pdfs/XIfmJlnWQYVjvKiVKb2D5B2DrVeDq7vNYfi8U3Cc.pdf', NULL),
(17, 'ANALISIS KINERJA APLIKASI ABSENSI PEGAWAI SDN 21 PAYAKUMBUH MENGGUNAKAN METODE USER ACCEPTANCE TESTING', '2024-12-03 14:43:51', 18, '2024-12-03 14:43:51', 7, 'file_pdfs/PmIuCDaftnRMKqVYiTQSs7UUUJyL9b1PVuJy0v3D.pdf', NULL),
(18, 'Penerapan Data Mining Untuk Mengetahui Minat Siswa Pada Pelajaran  IPA Mengunakan Metode K-Means Clustering', '2024-12-23 13:16:40', 45, '2024-12-23 13:16:40', 7, 'file_pdfs/unPHvQUEpR9Hpxj71OfyGWmPzgB2JecTKRFfvxh7.pdf', NULL),
(19, 'test tuggas akhir', '2024-12-24 02:11:41', 45, '2024-12-24 02:11:41', 7, 'file_pdfs/OkZiKHdKazfVvxrfC8w0JWYF0fK0VhzlYj3aviRL.pdf', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `prodis`
--

CREATE TABLE `prodis` (
  `prodi_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `prodis`
--

INSERT INTO `prodis` (`prodi_id`, `name`, `slug`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Teknik Informatika', 'teknik-informatika', 'Program studi yang mempelajari tentang teknologi komputer dan pemrograman', '2024-11-04 07:29:54', '2024-11-04 07:29:54'),
(2, 'Teknik Sipil', 'teknik-sipil', 'Program studi yang mempelajari tentang perencanaan dan pembangunan infrastruktur', '2024-11-04 07:29:54', '2024-11-04 07:29:54'),
(3, 'Teknik Komputer', 'teknik-komputer', 'Program studi yang mempelajari tentang perangkat keras komputer dan jaringan', '2024-11-04 07:29:54', '2024-11-04 07:29:54');

-- --------------------------------------------------------

--
-- Table structure for table `teknik_computers`
--

CREATE TABLE `teknik_computers` (
  `tk_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category_id` int NOT NULL,
  `file_pdf` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `teknik_computers`
--

INSERT INTO `teknik_computers` (`tk_id`, `title`, `create_at`, `user_id`, `modified_at`, `category_id`, `file_pdf`) VALUES
(8, 'aaaaaa', '2024-11-08 08:53:03', 18, '2024-11-08 08:53:03', 13, 'file_pdfs/VdRF1H07D0k4Wo9j0nv82PxZomB31ORf1FqPFPf4.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `teknik_sipils`
--

CREATE TABLE `teknik_sipils` (
  `ts_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category_id` int NOT NULL,
  `file_pdf` varchar(255) NOT NULL,
  `thumbnail` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `teknik_sipils`
--

INSERT INTO `teknik_sipils` (`ts_id`, `title`, `create_at`, `user_id`, `modified_at`, `category_id`, `file_pdf`, `thumbnail`) VALUES
(8, 'mn', '2024-11-08 08:52:47', 18, '2024-11-08 08:52:47', 10, 'file_pdfs/AwWcpiAQFaRPUwcVCzj5RExsMRhouvyQ32wpQlPn.pdf', NULL),
(9, 'test', '2024-12-05 07:45:51', 18, '2024-12-05 07:45:51', 24, 'file_pdfs/MAQYkgMK9zoA2Ag4EzRmuTZnHzQ4GyoHvVNEc2Sw.pdf', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('mahasiswa','dosen','admin') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `profile_picture` varchar(255) DEFAULT NULL,
  `identifier` int DEFAULT NULL,
  `indentifikasi` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `role`, `created_at`, `modified_at`, `profile_picture`, `identifier`, `indentifikasi`) VALUES
(14, 'adminn', 'admin@gmail.com', '$2y$12$.xFM.8DweaVGjGESwWMDxeHk0X0gEafbpEbmdHtJMP6aG/nxtwvpq', 'admin', '2024-08-26 20:14:29', '2024-08-26 20:14:29', NULL, NULL, NULL),
(18, 'tassya123', 'aaaaaaa@gmail.com', '$2y$12$vV4ITgv1oFHgzsshEUr65eTVfdpDtXbS1QlLvylKuGKlkj6ADWEwW', 'mahasiswa', '2024-09-25 02:00:52', '2024-12-23 06:11:12', 'images/VawjvHB6a1qczA2nArFQpWHsfPJDEehQ3M9EWXGf.jpg', NULL, NULL),
(44, 'admin3', 'admin3@gmail.com', '$2y$12$p/THbjESdMAbp1a3dn9fPeVJgX7BdidQb5TA8gF6tolYGDx13Jfle', 'admin', '2024-12-21 01:01:58', '2024-12-21 01:01:58', NULL, NULL, NULL),
(45, 'wita01', 'wita01@gmail.com', '$2y$12$ZP3ywWoSeKxup/IQ1srgk.ShjcnqB54QFzs0s39ZWJQ0qtLJxxHrS', 'mahasiswa', '2024-12-21 01:10:22', '2024-12-23 05:57:56', 'images/ApqA8djEKdphcxKU9TmkGSgC17oTgvEMuBZ1aVCX.jpg', NULL, NULL),
(46, 'disa02', 'disaa@gmail.com', '$2y$12$QMat/BICJsDR3Tl.gXYSue.XJ4uVTqFb11U42Tm.Vt9VzYKdgYKaq', 'mahasiswa', '2024-12-21 01:11:06', '2024-12-21 01:11:06', NULL, NULL, NULL),
(48, 'kembang', 'kembang@gmail.com', '$2y$12$CnubQ4/FvffCyrwC9Lr0u.bMAyy6bqOdd5yRbC9D/oXcEkMxzGXHK', 'mahasiswa', '2024-12-23 05:30:32', '2024-12-23 05:30:32', NULL, NULL, NULL),
(49, 'baru', 'baru@gmail.com', '$2y$12$wZuoDSz3z8lEJ7I2CVRcXe0OT/YTBLhGGeE4Rtha5Q8g92uEWXRRu', 'admin', '2024-12-23 08:06:11', '2024-12-23 08:06:11', NULL, NULL, NULL),
(50, 'admin4', 'adminn4@gmail.com', '$2y$12$hSu2pfxKWyNsQ/r1Mm5l2.d331WJmR6Wr0.jFleGMVbEi9mek5rDu', 'admin', '2024-12-23 19:17:15', '2024-12-23 19:17:15', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `video_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('approved','rejected','pending') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'pending',
  `user_id` int DEFAULT NULL,
  `modified_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `category_id` int DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` text,
  `thumbnail_url` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`video_id`, `title`, `url`, `created_at`, `status`, `user_id`, `modified_at`, `category_id`, `updated_at`, `description`, `thumbnail_url`, `is_active`) VALUES
(12, 'study hacks ala maudy ayunda', 'https://www.youtube.com/watch?v=OIa5zbXbiqo', '2024-11-10 06:54:15', 'approved', 18, '2024-12-05 06:47:01', 30, NULL, 'Selamat Hari Pendidikan Nasional! 🤍 Setelah banyak di request, akhirnya aku bisa sharing juga sama kalian study hacks yang sangat membantu aku pas sekolah dan kuliah! For me, the key is to identify and prioritise. And I used to do these 3 hacks for most of my exams karena motto aku \"study smarter instead of harder\".  Siapa yang kayak aku jugaa? 🤪\r\n\r\nKalau kalian cara belajarnya kayak gimana? Share dong di kolom komentar! \r\n\r\n#maudyayunda #studyhacks', 'https://img.youtube.com/vi/OIa5zbXbiqo/hqdefault.jpg', 1),
(13, 'Ini Dia CARAKU BELAJAR buat BEASISWA dan NILAI BAGUS!📚', 'https://www.youtube.com/watch?v=jTBy1ujJuUE', '2024-11-10 06:54:59', 'approved', 18, '2024-11-10 06:56:08', 18, NULL, 'the STUDY GUIDE yang ditunggu-tunggu! yang jujur ngebantu aku ngejaga nilai2ku biar tetep stabil dan juga efektif🌝\r\n\r\n00:00 Introduction\r\n00:54 1) Pomodoro Technique\r\n03:06 2) Journaling\r\n04:33 3) Short but frequent rewards\r\n05:11 4) Nyicil is Power\r\n06:23 5) Ganti Suasana\r\n07:28 6) Hari Kreatif\r\n08:23 7) Habit kecil yang buat kamu fokus\r\n09:36 - Session 2: Tipe2 Metode Pembelajaran\r\n09:54 - Metode 1: Pemahaman Konsep\r\n11:25 - Metode 2: Problem Solving\r\n13:19 - Metode 3: Penghafalan', 'https://img.youtube.com/vi/jTBy1ujJuUE/hqdefault.jpg', 1),
(14, 'Gimana Caranya Berpikir Kritis? | Beropini eps. 53', 'https://www.youtube.com/watch?v=BIV9ZlEqd-k', '2024-11-10 06:55:58', 'approved', 18, '2024-11-10 06:56:05', 20, NULL, 'WELCOME TO MY YOUTUBE CHANNEL! \r\nNama gue Gita Savitri Devi. Gue orang Indonesia yang tinggal di Hamburg, Jerman. Terima kasih udah mampir ke video gue. Jangan lupa subscribe, like, dan komen. \r\nNew video every Tuesday (PagiPagi & Beropini) and Friday (anything else) :)\r\n\r\n\r\nSOCIAL MEDIA: \r\nPersonal blog: http://www.gitasav.com/\r\nInstagram:   / gitasav  \r\n\r\n\r\nBUY MY MERCH:\r\nhttps://shopee.co.id/hello.gigitaga\r\n  / hello.gigitaga  \r\n\r\n\r\nCHECK OUT MY HIJAB BRAND: \r\nhttps://shopee.co.id/tesavaraofficial\r\n  / tesavara', 'https://img.youtube.com/vi/BIV9ZlEqd-k/hqdefault.jpg', 1),
(16, 'Cara Belajar Efektif untuk MaBa | Cocok Buat Maba yang Masih Bingung sama Dunia Perkuliahan', 'https://www.youtube.com/watch?v=i3QsjMcTrqA', '2024-11-13 07:05:52', 'approved', 18, '2024-11-13 07:06:08', 19, NULL, 'Transisi kehidupan sekolah dengan kehidupan kuliah paling ekstrim dirasakan ketika masih menjadi mahasiswa baru (maba). Yaps, belajar di dunia perkuliahan tidak sefleksibel ketika kuliah, karena belajar di sekolah cenderung kaku, monoton dan tidak terlalu menantang (menurut penilaian subjektif aku). Nah kalau di perkuliahan tentunga akan lebih menantang, apalagi jam belajar yang fleksibel, dan sistem belajar yang bervariasi. Tapi dengan adanya jam belajar yang fleksibel, secara tidak langsung kita harus pandai menggunakan waktu dengan sebaik-baiknya. Okedeh gk usah banyak cerita di sini, langsung tonton videonya sampai habis yahhh.', 'https://img.youtube.com/vi/i3QsjMcTrqA/hqdefault.jpg', 1),
(18, 'yeyyy', 'https://www.youtube.com/watch?v=OIa5zbXbiqo', '2024-12-05 06:46:43', 'approved', 18, '2024-12-05 06:46:53', 21, NULL, 'asdasd', 'https://img.youtube.com/vi/OIa5zbXbiqo/hqdefault.jpg', 1),
(19, 'Kumpulan Ost Drama Korea Populer Part. 1', 'https://www.youtube.com/watch?v=Ag6WLB70y48', '2024-12-07 06:15:29', 'approved', 18, '2024-12-07 06:17:07', 23, NULL, 'adasd', 'https://img.youtube.com/vi/Ag6WLB70y48/hqdefault.jpg', 1),
(20, 'Self Development (cara untuk meningkatkan kualitas diri)', 'https://www.youtube.com/watch?v=zckqurf5KX8', '2024-12-23 12:43:59', 'approved', 45, '2024-12-23 12:50:58', 20, NULL, 'Banyak orang yang ingin jadi Rafathar yaitu anak dari Raffi Ahmad yang merupakan salah seorang artis terkaya di Indonesia. Menurut Raffi Ahmad, untuk sampai di posisinya saat ini bukanlah hal yang mudah. Apalagi kalau kamu kerjaannya cuman rebahan dan scroll media sosial aja, jangan harap bisa sukses kaya Raffi Ahmad dengan instan apalagi jadi Rafathar.\r\n\r\n\r\nTemukan Luarsekolah di : \r\nWebsite https://luarsekolah.com \r\nInstagram   / luarsekolah   \r\nTiktok https://vt.tiktok.com/ZSd19Xycm/ \r\n\r\nTentang Kami\r\nLuarsekolah adalah platform marketplace edukasi vokasi dan pengembangan diri berbasis online yang dapat diakses kapan saja dan di mana saja untuk mendampingi generasi muda Indonesia #sampaijadibisa\r\n\r\nUntuk kerja sama dan partnership, silakan kirim surel ke :\r\ntegar@luarsekolah.com', 'https://img.youtube.com/vi/zckqurf5KX8/hqdefault.jpg', 1),
(21, 'Aku Baca 100 Buku Pengembangan Diri - Ini Kesimpulannya', 'https://www.youtube.com/watch?v=Mg4q_u_4OTI', '2024-12-23 12:44:52', 'rejected', 45, '2024-12-23 12:51:01', 20, NULL, '🏆 Top 3 New Podcast of the Year 2023\r\nDengarkan Podcast \"Udah Jumat Lagi\" di Spotify: https://open.spotify.com/show/7AfvTJd...\r\n\r\n00:00 Intro\r\n00:21 Bias terhadap ________\r\n03:23 Fokus menentukan ________\r\n09:55 Berdiri untuk ________\r\n13:03 Tahu kapan harus ________\r\n\r\nSocial Media:\r\nInstagram:   / zahidibr​  \r\n\r\n📩 Apabila ingin bekerja sama, silakan hubungi surel: halo[at]zahidibr.com (hanya kepentingan bisnis)\r\n\r\nTerima kasih sudah menonton video ini! Di antara media yang lain, aku paling aktif berkomunikasi dengan subscribers di kolom komentar. Silakan tinggalkan komentarmu di bawah :)\r\n\r\nVideo di-edit oleh @maamunn', 'https://img.youtube.com/vi/Mg4q_u_4OTI/hqdefault.jpg', 1),
(22, 'Manajemen Waktu (Bangkitkan Motivasi Produktif)', 'https://www.youtube.com/watch?v=zC-6glEA4oU', '2024-12-24 02:10:46', 'pending', 45, '2024-12-24 02:10:46', 22, NULL, 'Perseners! siapa nih yang sehari punya waktu 24 jam tapi rasanya masih kurang? rasanya susah banget buat fokus ngerjain dan akhirnya setelah stuck berjam-jam dan masih belum seleasi juga. Gimana sih caranya membangkitkan motivasi supaya lebih produktif? Di video ini, Satu Persen membahas cara-cara membuat kamu lebih produktif dalam manajemen wa', 'https://img.youtube.com/vi/zC-6glEA4oU/hqdefault.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`article_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `fk_categories_prodi` (`prodi_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`favorite_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `article_id` (`article_id`),
  ADD KEY `video_id` (`video_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `forum_post`
--
ALTER TABLE `forum_post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `histories`
--
ALTER TABLE `histories`
  ADD PRIMARY KEY (`history_id`);

--
-- Indexes for table `informatics`
--
ALTER TABLE `informatics`
  ADD PRIMARY KEY (`if_id`);

--
-- Indexes for table `prodis`
--
ALTER TABLE `prodis`
  ADD PRIMARY KEY (`prodi_id`),
  ADD UNIQUE KEY `unique_slug` (`slug`),
  ADD KEY `idx_name` (`name`),
  ADD KEY `idx_created_at` (`created_at`);

--
-- Indexes for table `teknik_computers`
--
ALTER TABLE `teknik_computers`
  ADD PRIMARY KEY (`tk_id`);

--
-- Indexes for table `teknik_sipils`
--
ALTER TABLE `teknik_sipils`
  ADD PRIMARY KEY (`ts_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`video_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `article_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `favorite_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `forum_post`
--
ALTER TABLE `forum_post`
  MODIFY `post_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `histories`
--
ALTER TABLE `histories`
  MODIFY `history_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `informatics`
--
ALTER TABLE `informatics`
  MODIFY `if_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `prodis`
--
ALTER TABLE `prodis`
  MODIFY `prodi_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teknik_computers`
--
ALTER TABLE `teknik_computers`
  MODIFY `tk_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `teknik_sipils`
--
ALTER TABLE `teknik_sipils`
  MODIFY `ts_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `video_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `articles_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `fk_categories_prodi` FOREIGN KEY (`prodi_id`) REFERENCES `prodis` (`prodi_id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `forum_post` (`post_id`);

--
-- Constraints for table `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`article_id`) REFERENCES `articles` (`article_id`),
  ADD CONSTRAINT `favorites_ibfk_3` FOREIGN KEY (`video_id`) REFERENCES `videos` (`video_id`),
  ADD CONSTRAINT `favorites_ibfk_4` FOREIGN KEY (`post_id`) REFERENCES `forum_post` (`post_id`);

--
-- Constraints for table `forum_post`
--
ALTER TABLE `forum_post`
  ADD CONSTRAINT `forum_post_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `videos`
--
ALTER TABLE `videos`
  ADD CONSTRAINT `videos_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `videos_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
