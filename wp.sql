/*
 Navicat Premium Data Transfer

 Source Server         : mpampam
 Source Server Type    : MySQL
 Source Server Version : 50532
 Source Host           : localhost:3306
 Source Schema         : wp

 Target Server Type    : MySQL
 Target Server Version : 50532
 File Encoding         : 65001

 Date: 21/07/2019 23:50:52
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for category
-- ----------------------------
DROP TABLE IF EXISTS `category`;
CREATE TABLE `category`  (
  `id_category` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `delete` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0',
  `created_at` datetime NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_category`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of category
-- ----------------------------
INSERT INTO `category` VALUES (9, 'Bitcoin', '0', '2019-07-17 09:43:19', '2019-07-17 09:43:36');
INSERT INTO `category` VALUES (10, 'Indonesia', '0', '2019-07-17 09:45:19', NULL);
INSERT INTO `category` VALUES (11, 'IDea', '0', '2019-07-17 09:45:41', NULL);
INSERT INTO `category` VALUES (12, 'Project 2019', '0', '2019-07-18 02:24:08', '2019-07-18 02:24:38');

-- ----------------------------
-- Table structure for groups
-- ----------------------------
DROP TABLE IF EXISTS `groups`;
CREATE TABLE `groups`  (
  `id_groups` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  PRIMARY KEY (`id_groups`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of groups
-- ----------------------------
INSERT INTO `groups` VALUES (8, 'superadmin', 'superadmin');
INSERT INTO `groups` VALUES (12, 'Operator', 'Operator');

-- ----------------------------
-- Table structure for groups_menus
-- ----------------------------
DROP TABLE IF EXISTS `groups_menus`;
CREATE TABLE `groups_menus`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_groups` int(11) NOT NULL,
  `id_menus` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `id_menus`(`id_menus`) USING BTREE,
  INDEX `id_groups`(`id_groups`) USING BTREE,
  CONSTRAINT `groups_menus_ibfk_1` FOREIGN KEY (`id_groups`) REFERENCES `groups` (`id_groups`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `groups_menus_ibfk_2` FOREIGN KEY (`id_menus`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 355 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of groups_menus
-- ----------------------------
INSERT INTO `groups_menus` VALUES (102, 12, 1);
INSERT INTO `groups_menus` VALUES (339, 8, 1);
INSERT INTO `groups_menus` VALUES (340, 8, 20);
INSERT INTO `groups_menus` VALUES (341, 8, 21);
INSERT INTO `groups_menus` VALUES (342, 8, 23);
INSERT INTO `groups_menus` VALUES (343, 8, 28);
INSERT INTO `groups_menus` VALUES (344, 8, 29);
INSERT INTO `groups_menus` VALUES (345, 8, 33);
INSERT INTO `groups_menus` VALUES (346, 8, 32);
INSERT INTO `groups_menus` VALUES (347, 8, 31);
INSERT INTO `groups_menus` VALUES (348, 8, 10);
INSERT INTO `groups_menus` VALUES (349, 8, 11);
INSERT INTO `groups_menus` VALUES (350, 8, 22);
INSERT INTO `groups_menus` VALUES (351, 8, 15);
INSERT INTO `groups_menus` VALUES (352, 8, 30);
INSERT INTO `groups_menus` VALUES (353, 8, 8);
INSERT INTO `groups_menus` VALUES (354, 8, 18);

-- ----------------------------
-- Table structure for media_foto
-- ----------------------------
DROP TABLE IF EXISTS `media_foto`;
CREATE TABLE `media_foto`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `image` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of media_foto
-- ----------------------------
INSERT INTO `media_foto` VALUES (1, 'ameforest is a Bootstrap Gaming theme. Build your own gaming theme with gameforest and you will love to use it.', '11072019034449_56273998_216942_media_foto.jpg', '', '2019-07-11 03:45:45', NULL);
INSERT INTO `media_foto` VALUES (2, 'dwa', '11072019034537_cb73326a-58de-4_media_foto.jpg', '', '2019-07-11 04:00:32', NULL);

-- ----------------------------
-- Table structure for media_video
-- ----------------------------
DROP TABLE IF EXISTS `media_video`;
CREATE TABLE `media_video`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `slug` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `url` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `keterangan` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `update_at` datetime NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of media_video
-- ----------------------------
INSERT INTO `media_video` VALUES (3, 'Tutorial cara membuat link Tutorial cara membuat link video video Tutorial cara membuat link video', 'tutorial-cara-membuat-link-video', 'https://www.youtube.com/watch?v=LGjt291COa0', 'gfdgdf', '2019-06-21 03:42:41', '2019-06-21 11:03:35');

-- ----------------------------
-- Table structure for menu_public
-- ----------------------------
DROP TABLE IF EXISTS `menu_public`;
CREATE TABLE `menu_public`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `url` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `type` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `is_parent` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 16 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of menu_public
-- ----------------------------
INSERT INTO `menu_public` VALUES (4, 'Home', 'home', 'Home', '', 0, 1, 1);
INSERT INTO `menu_public` VALUES (5, 'Article', 'news', 'Article', '', 0, 1, 4);
INSERT INTO `menu_public` VALUES (7, 'Galery', '#', 'Galery', '', 0, 1, 6);
INSERT INTO `menu_public` VALUES (8, 'Photos', 'foto', 'Photos', '', 7, 1, 7);
INSERT INTO `menu_public` VALUES (9, 'Videos', 'video', 'Videos', '', 7, 1, 8);
INSERT INTO `menu_public` VALUES (10, 'About', '#', 'About', '', 0, 1, 2);
INSERT INTO `menu_public` VALUES (12, 'Contact', 'kontak', 'Contact', '', 0, 1, 15);
INSERT INTO `menu_public` VALUES (13, 'Team', '#', 'Team', '', 0, 1, 13);
INSERT INTO `menu_public` VALUES (15, 'Project', '#', 'Project', '', 0, 1, 10);

-- ----------------------------
-- Table structure for menus
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `url` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `icon` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `description` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `is_parent` int(11) NOT NULL,
  `sort` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 34 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES (1, 'Home', 'home', 'fa fa-home', 'Home', 0, 1, 1);
INSERT INTO `menus` VALUES (2, 'settings', 'pengaturan', 'fa fa-cogs', 'settings', 0, 16, 1);
INSERT INTO `menus` VALUES (8, 'Manajemen Menu', 'menus', 'fa fa-file-text-o', 'Manajemen Menu', 2, 19, 1);
INSERT INTO `menus` VALUES (9, 'Admin', '#', 'fa fa-users', 'Admin', 0, 12, 1);
INSERT INTO `menus` VALUES (10, 'admin', 'users', 'fa fa-circle', 'admin', 9, 13, 1);
INSERT INTO `menus` VALUES (11, 'Groups', 'groups', 'fa fa-circle', 'Groups', 9, 14, 1);
INSERT INTO `menus` VALUES (15, 'Settings', 'pengaturan', 'fa fa-circle', 'Settings', 2, 17, 1);
INSERT INTO `menus` VALUES (18, 'crud generator', 'mpampam-crud', 'fa fa-file-code-o', 'crud generator', 0, 20, 0);
INSERT INTO `menus` VALUES (19, 'Article', 'news', 'fa fa-file-text-o', 'Article', 0, 2, 1);
INSERT INTO `menus` VALUES (20, 'Post', 'news', 'fa fa-circle', 'Post', 19, 3, 1);
INSERT INTO `menus` VALUES (21, 'Category', 'category', 'fa fa-circle', 'Category', 19, 4, 1);
INSERT INTO `menus` VALUES (22, 'file manager', 'file_manager', 'fa fa-window-restore', 'file manager', 0, 15, 0);
INSERT INTO `menus` VALUES (23, 'Pages', 'page', 'fa fa-newspaper-o', 'Pages', 0, 5, 1);
INSERT INTO `menus` VALUES (27, 'Media', '#', 'fa fa-file-photo-o', 'Media', 0, 6, 1);
INSERT INTO `menus` VALUES (28, 'Photos', 'Media_foto', 'fa fa-circle', 'Photos', 27, 7, 1);
INSERT INTO `menus` VALUES (29, 'Videos', 'media_video', 'fa fa-circle', 'Videos', 27, 8, 1);
INSERT INTO `menus` VALUES (30, 'Managament Menu', 'menu_public', 'fa fa-navicon', 'Managament Menu', 2, 18, 1);
INSERT INTO `menus` VALUES (31, 'Contact', '#', 'fa fa-envelope-o', 'Contact', 0, 11, 1);
INSERT INTO `menus` VALUES (32, 'Testimonial', '#', 'fa fa-podcast', 'Testimonial', 0, 10, 1);
INSERT INTO `menus` VALUES (33, 'Team', 'Team', 'fa fa-handshake-o', 'Team', 0, 9, 0);

-- ----------------------------
-- Table structure for news
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news`  (
  `id_news` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `slug` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `description` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `image` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  PRIMARY KEY (`id_news`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1682 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of news
-- ----------------------------
INSERT INTO `news` VALUES (1676, 'Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting.', 'lorem-ipsum-adalah-contoh-teks-atau-dummy-dalam-industri-percetakan-dan-penataan-huruf-atau-typesetting', '<p class=\"MsoNormal\" [removed] justify; \">Lorem Ipsum adalah contoh teks atau dummy dalam\r\nindustri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah\r\nmenjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang\r\ntidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi\r\nsebuah buku contoh huruf. Ia tidak hanya bertahan selama 5 abad, tapi juga\r\ntelah beralih ke penataan huruf elektronik, tanpa ada perubahan apapun. Ia\r\nmulai dipopulerkan pada tahun 1960 dengan diluncurkannya lembaran-lembaran\r\nLetraset yang menggunakan kalimat-kalimat dari Lorem Ipsum, dan seiring\r\nmunculnya perangkat lunak Desktop Publishing seperti Aldus PageMaker juga\r\nmemiliki versi Lorem Ipsum.<o:p></o:p></p>', '17072019023822_shutterstock_16_news.jpg', '2019-07-17 09:46:51', '2019-07-17 09:49:13');
INSERT INTO `news` VALUES (1677, 'Lorem Ipsum adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting.', 'lorem-ipsum-adalah-contoh-teks-atau-dummy-dalam-industri-percetakan-dan-penataan-huruf-atau-typesetting', 'Sudah merupakan fakta bahwa seorang pembaca akan terpengaruh oleh isi tulisan dari sebuah halaman', '17072019023750_downloadjpg_news.jpg', '2019-07-17 09:51:04', '2019-07-17 09:51:41');
INSERT INTO `news` VALUES (1678, 'Sudah merupakan fakta bahwa seorang pembaca akan terpengaruh oleh isi tulisan dari sebuah halaman', 'sudah-merupakan-fakta-bahwa-seorang-pembaca-akan-terpengaruh-oleh-isi-tulisan-dari-sebuah-halaman', '<p class=\"MsoNormal\">Sudah merupakan fakta bahwa seorang pembaca akan terpengaruh\r\noleh isi tulisan dari sebuah halaman saat ia melihat tata letaknya. Maksud\r\npenggunaan Lorem Ipsum adalah karena ia kurang lebih memiliki penyebaran huruf\r\nyang normal, ketimbang menggunakan kalimat seperti \"Bagian isi disini,\r\nbagian isi disini\", sehingga ia seolah menjadi naskah Inggris yang bisa\r\ndibaca. Banyak paket Desktop Publishing dan editor situs web yang kini\r\nmenggunakan Lorem Ipsum sebagai contoh teks. Karenanya pencarian terhadap\r\nkalimat \"Lorem Ipsum\" akan berujung pada banyak situs web yang masih\r\ndalam tahap pengembangan. Berbagai versi juga telah berubah dari tahun ke\r\ntahun, kadang karena tidak sengaja, kadang karena disengaja (misalnya karena\r\ndimasukkan unsur humor atau semacamnya)<o:p></o:p></p>', '', '2019-07-17 09:53:00', '2019-07-17 09:56:40');
INSERT INTO `news` VALUES (1679, 'Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf.', 'lorem-ipsum-telah-menjadi-standar-contoh-teks-sejak-tahun-1500an-saat-seorang-tukang-cetak-yang-tidak-dikenal-mengambil-sebuah-kumpulan-teks-dan-mengacaknya-untuk-menjadi-sebuah-buku-contoh-huruf', '<p class=\"MsoNormal\">Tidak seperti anggapan banyak orang, Lorem Ipsum bukanlah\r\nteks-teks yang diacak. Ia berakar dari sebuah naskah sastra latin klasik dari\r\nera 45 sebelum masehi, hingga bisa dipastikan usianya telah mencapai lebih dari\r\n2000 tahun. Richard McClintock, seorang professor Bahasa Latin dari\r\nHampden-Sidney College di Virginia, mencoba mencari makna salah satu kata latin\r\nyang dianggap paling tidak jelas, yakni consectetur, yang diambil dari salah\r\nsatu bagian Lorem Ipsum. Setelah ia mencari maknanya di di literatur klasik, ia\r\nmendapatkan sebuah sumber yang tidak bisa diragukan. Lorem Ipsum berasal dari\r\nbagian 1.10.32 dan 1.10.33 dari naskah \"de Finibus Bonorum et\r\nMalorum\" (Sisi Ekstrim dari Kebaikan dan Kejahatan) karya Cicero, yang\r\nditulis pada tahun 45 sebelum masehi. BUku ini adalah risalah dari teori etika\r\nyang sangat terkenal pada masa Renaissance. Baris pertama dari Lorem Ipsum,\r\n\"Lorem ipsum dolor sit amet..\", berasal dari sebuah baris di bagian\r\n1.10.32.<o:p></o:p></p>', '17072019023808_imagesjpg_news.jpg', '2019-07-17 09:55:09', NULL);
INSERT INTO `news` VALUES (1680, 'berakar dari sebuah naskah sastra latin klasik dari era 45 sebelum masehi', 'berakar-dari-sebuah-naskah-sastra-latin-klasik-dari-era-45-sebelum-masehi', '<p class=\"MsoNormal\"><o:p> </o:p></p><p class=\"MsoNormal\">Tidak seperti anggapan banyak orang, Lorem Ipsum bukanlah\r\nteks-teks yang diacak. Ia berakar dari sebuah naskah sastra latin klasik dari\r\nera 45 sebelum masehi, hingga bisa dipastikan usianya telah mencapai lebih dari\r\n2000 tahun. Richard McClintock, seorang professor Bahasa Latin dari\r\nHampden-Sidney College di Virginia, mencoba mencari makna salah satu kata latin\r\nyang dianggap paling tidak jelas, yakni consectetur, yang diambil dari salah\r\nsatu bagian Lorem Ipsum. Setelah ia mencari maknanya di di literatur klasik, ia\r\nmendapatkan sebuah sumber yang tidak bisa diragukan. Lorem Ipsum berasal dari\r\nbagian 1.10.32 dan 1.10.33 dari naskah \"de Finibus Bonorum et\r\nMalorum\" (Sisi Ekstrim dari Kebaikan dan Kejahatan) karya Cicero, yang\r\nditulis pada tahun 45 sebelum masehi. BUku ini adalah risalah dari teori etika\r\nyang sangat terkenal pada masa Renaissance. Baris pertama dari Lorem Ipsum,\r\n\"Lorem ipsum dolor sit amet..\", berasal dari sebuah baris di bagian\r\n1.10.32.<o:p></o:p></p><p class=\"MsoNormal\"><o:p> </o:p></p><p class=\"MsoNormal\">Bagian standar dari teks Lorem Ipsum yang digunakan sejak\r\ntahun 1500an kini di reproduksi kembali di bawah ini untuk mereka yang\r\ntertarik. Bagian 1.10.32 dan 1.10.33 dari \"de Finibus Bonorum et\r\nMalorum\" karya Cicero juga di reproduksi persis seperti bentuk aslinya,\r\ndiikuti oleh versi bahasa Inggris yang berasal dari terjemahan tahun 1914 oleh\r\nH. Rackham.<o:p></o:p></p><p>\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\n</p><p class=\"MsoNormal\">Dari mana saya bisa mendapatkannya?<o:p></o:p></p>', '17072019023800_images-1jpg_news.jpg', '2019-07-17 09:58:13', '2019-07-17 09:59:17');
INSERT INTO `news` VALUES (1681, 'New Project 2019 -Dana Idea', 'new-project-2019-dana-idea', '<p>Merupakan project 2019 dari IDEA DIGITAL INDONESIA dengan konsep market place yang mempertemukan orang yang ingin mendanai para mitra UKM yang bekerjasama dengan IDEA DIGITAL INDONESIA dengan konsep IMBAL HASIL. berbasis peer to peer landing IDEA DIGITAL INDONESIA akan mengeluarkan sebuah konsep platform dan aplikasi yang memberikan kemudahan para ukm dan investor untuk berinteraksi tanpa dibatasi oleh waktu dan jarak.<br></p>', '', '2019-07-18 02:22:31', NULL);

-- ----------------------------
-- Table structure for page
-- ----------------------------
DROP TABLE IF EXISTS `page`;
CREATE TABLE `page`  (
  `id_halaman` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `slug` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `deskripsi` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL,
  `image` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `delete` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0',
  PRIMARY KEY (`id_halaman`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of page
-- ----------------------------
INSERT INTO `page` VALUES (1, 'Mappabukaq bsok d sni d rmh smbil hakikah. Coba kreno mappabuka', 'mappabukaq-bsok-d-sni-d-rmh-smbil-hakikah-coba-kreno-mappabuka', '<p>sdasda</p>', '240519021700.jpg', '2019-05-24 02:17:07', '2019-05-25 09:40:10', '1');
INSERT INTO `page` VALUES (2, 'HTML DOM cloneNode Method - W3Schoolsss', 'html-dom-clonenode-method-w3schoolsss', '<p [removed]=\"text-align: justify;\"><span [removed]=\"font-size: inherit;\">How to use document.createElement() to create an element, and wrap it around each selected element </span><span [removed]=\"font-size: inherit;\">Using a function to specify what to wrap around each selected element.</span></div></p><p [removed]=\"text-align: justify;\"><span [removed]=\"text-align: justify;\"><span [removed] inherit;\">How to toggle between wrapping and unwrapping an element.</span></div></p>', '240519021700.jpg', '2019-05-25 09:41:42', '2019-05-25 09:42:24', '1');
INSERT INTO `page` VALUES (3, 'Good Morning Everyone - Tunggu Aku (Official Music Video)', 'good-morning-everyone-tunggu-aku-official-music-video', '<p>Official Music Video for Good Morning Everyone newest single \" Tunggu Aku\"\r\n\r\nNow Available on </p><p>Spotify : <a href=\"http://spoti.fi/2kofeCI\" target=\"_blank\">http://spoti.fi/2kofeCI</a></p><p>\r\niTunes & Apple Music : <a class=\"yt-simple-endpoint style-scope yt-formatted-string\" spellcheck=\"false\" href=\"https://www.youtube.com/redirect?q=http://apple.co/2AUUIQU&redir_token=k2jILGBlYYc0mkoo-WkkAXLczqZ8MTU1OTE0MTIwM0AxNTU5MDU0ODAz&event=video_description&v=LGymNBRdx5s\" rel=\"nofollow\" target=\"_blank\" spellcheck=\"false\" href=\"https://www.youtube.com/redirect?q=http://bit.ly/2jTdFZD&redir_token=k2jILGBlYYc0mkoo-WkkAXLczqZ8MTU1OTE0MTIwM0AxNTU5MDU0ODAz&event=video_description&v=LGymNBRdx5s\" rel=\"nofollow\" target=\"_blank\">http://bit.ly/2jTdFZD</a>\r\n</p><p>\r\n\r\nSong and Lyric : Yuli Perkasa\r\nProducer : Good Morning Everyone\r\n</p><p>Recorded at : GME studio and 4wd </p><p>studio\r\nMixing : Erwin Hadinata on GME Studio\r\nMastering: Randy Merrill, Sterling Sound, New York, USA\r\n\r\nMusic </p><p>Video : \r\nDirector : Ezra McGaiver\r\n</p><p>Director Of Photography : Ezra </p><p>McGaiver\r\nEditor : Ezra </p><p>McGaiver\r\nCast : Mochamad Al Ichsan & Tasya Clara<br></p>', '', '2019-05-28 10:46:35', '2019-05-29 12:49:30', '0');
INSERT INTO `page` VALUES (4, 'Visi & Misi', 'visi-misi', '<p>Visi & Misi</p>', '', '2019-05-29 12:50:29', NULL, '0');
INSERT INTO `page` VALUES (5, 'Data Penduduk', 'data-penduduk', '<p>Data Penduduk</p>', '', '2019-05-29 12:51:07', NULL, '0');
INSERT INTO `page` VALUES (6, 'Tentang', 'tentang', '<p>Tentang</p>', 'page_310519120857.jpg', '2019-05-29 12:53:10', '2019-05-31 12:09:10', '0');

-- ----------------------------
-- Table structure for setting
-- ----------------------------
DROP TABLE IF EXISTS `setting`;
CREATE TABLE `setting`  (
  `id` int(11) NOT NULL,
  `title` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `domain` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `telepon` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `alamat` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `kabupaten` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `provinsi` varchar(200) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `logo` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `meta_seo` longtext CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of setting
-- ----------------------------
INSERT INTO `setting` VALUES (999, 'IDEA DIGITAL INDONESIA', 'ww.ideadigitalindonesia.com', 'mpampam5@gmail.com', '(0411) 3662100', 'Jalan. Toddopuli x , Kota Makassar . Sulawesi Selatan', 'Makassar', 'Sulawesi-selatan', 'logo_280619094322.png', '<meta property=\"og:title\" content=\"European Travel Destinations\"><meta property=\"og:description\" content=\"Offering tour packages for individuals or groups.\"><meta property=\"og:image\" content=\"http://euro-travel-example.com/thumbnail.jpg\"><meta property=\"og:url\" content=\"http://euro-travel-example.com/index.htm\">\r\n<script>alert(\'mpampam\')</script>');

-- ----------------------------
-- Table structure for trans_news_category
-- ----------------------------
DROP TABLE IF EXISTS `trans_news_category`;
CREATE TABLE `trans_news_category`  (
  `id_news_category` int(11) NOT NULL AUTO_INCREMENT,
  `id_category` int(11) NULL DEFAULT NULL,
  `id_news` int(11) NULL DEFAULT NULL,
  `headline` int(11) NULL DEFAULT 0,
  `delete` enum('0','1') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT '0',
  PRIMARY KEY (`id_news_category`) USING BTREE,
  INDEX `id_news`(`id_news`) USING BTREE,
  INDEX `id_category`(`id_category`) USING BTREE,
  CONSTRAINT `trans_news_category_ibfk_1` FOREIGN KEY (`id_news`) REFERENCES `news` (`id_news`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `trans_news_category_ibfk_2` FOREIGN KEY (`id_category`) REFERENCES `category` (`id_category`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB AUTO_INCREMENT = 1682 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of trans_news_category
-- ----------------------------
INSERT INTO `trans_news_category` VALUES (1676, 10, 1676, 0, '1');
INSERT INTO `trans_news_category` VALUES (1677, 9, 1677, 0, '0');
INSERT INTO `trans_news_category` VALUES (1678, 10, 1678, 0, '0');
INSERT INTO `trans_news_category` VALUES (1679, 11, 1679, 0, '0');
INSERT INTO `trans_news_category` VALUES (1680, 9, 1680, 0, '0');
INSERT INTO `trans_news_category` VALUES (1681, 11, 1681, 0, '0');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id_users` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `last_name` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `email` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `username` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `password` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `key` varchar(20) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `token_activation` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `last_login` datetime NULL DEFAULT NULL,
  `created_at` datetime NULL DEFAULT NULL,
  `update_at` datetime NULL DEFAULT NULL,
  `active` enum('y','n') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'y',
  PRIMARY KEY (`id_users`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (6, 'Muhammad', 'Irfan ibnu', 'mpampam@mail.com', '39843890432', 'admin', '$2y$10$OiKFc5yEnsVuYl7OdphZauWkdhtP7kb3iYdt2nPlCpwaWjKfM7ISC', '20190311221640', NULL, '2019-07-18 09:42:49', '2019-03-11 22:16:40', '2019-06-22 02:17:09', 'y');
INSERT INTO `users` VALUES (8, 'sang', 'operator', 'operator@mail.com', '872873827832', 'operator', '$2y$10$U0AwKvpSHAe2uWIJ7MkD8u.kGt6izIRZ/Kj6GeidFvCaH/ql1kOQO', '20190313222009', NULL, '2019-06-22 02:19:52', '2019-03-13 22:20:10', '2019-06-22 02:22:33', 'n');

-- ----------------------------
-- Table structure for users_groups
-- ----------------------------
DROP TABLE IF EXISTS `users_groups`;
CREATE TABLE `users_groups`  (
  `id_users_groups` int(11) NOT NULL AUTO_INCREMENT,
  `id_users` int(11) NOT NULL,
  `id_groups` int(11) NOT NULL,
  PRIMARY KEY (`id_users_groups`) USING BTREE,
  INDEX `id_users`(`id_users`) USING BTREE,
  INDEX `id_groups`(`id_groups`) USING BTREE,
  CONSTRAINT `users_groups_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `users_groups_ibfk_2` FOREIGN KEY (`id_groups`) REFERENCES `groups` (`id_groups`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users_groups
-- ----------------------------
INSERT INTO `users_groups` VALUES (3, 6, 8);
INSERT INTO `users_groups` VALUES (5, 8, 12);

SET FOREIGN_KEY_CHECKS = 1;
