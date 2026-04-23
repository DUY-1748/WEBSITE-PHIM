-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th4 23, 2026 lúc 05:19 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `lang_phim_db`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment_history`
--

CREATE TABLE `comment_history` (
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `tmdb_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `overview` text DEFAULT NULL,
  `poster_path` varchar(255) DEFAULT NULL,
  `backdrop_path` varchar(255) DEFAULT NULL,
  `release_date` date DEFAULT NULL,
  `rating` decimal(3,1) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `video_key` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `movies`
--

INSERT INTO `movies` (`id`, `tmdb_id`, `title`, `overview`, `poster_path`, `backdrop_path`, `release_date`, `rating`, `created_at`, `video_key`) VALUES
(1, 1226863, 'Phim Super Mario Thiên Hà', 'Nối tiếp thành công của phần phim đầu tiên, Mario và Luigi dấn thân vào một cuộc phiêu lưu ngoài sức tưởng tượng khi họ bị cuốn vào không gian sâu thẳm. Lần này, họ gặp gỡ Rosalina, người bảo vệ các vì sao và là \"mẹ\" của những sinh vật Luma đáng yêu. Cả nhóm phải hợp sức để ngăn chặn âm mưu thôn tính toàn bộ vũ trụ của Bowser, khi hắn đang thu thập các Grand Stars để xây dựng một đế chế thiên hà hùng mạnh. Phim hứa hẹn mang đến những màn rượt đuổi nghẹt thở giữa các hành tinh với trọng lực siêu thực và hình ảnh rực rỡ.', '/h1FlxHYiVcZVkIE5XW599ZkV6Sr.jpg', '/kxQiIJ4gVcD3K6o14MJ72p5yRcE.jpg', '2026-04-01', 6.8, '2026-04-23 15:08:32', 'En5QZmL5R1s'),
(2, 1523145, 'Твоё сердце будет разбито', '', '/iGpMm603GUKH2SiXB2S5m4sZ17t.jpg', '/1x9e0qWonw634NhIsRdvnneeqvN.jpg', '2026-03-26', 6.9, '2026-04-23 15:08:33', NULL),
(3, 980431, 'Huyền Thoại Aang: Tiết Khí Sư Cuối Cùng', '', '/gf7EeEQe22Zu1u55wRT8EAnav93.jpg', '/sS3zGYFPcfM5pArVNWl6qLyaSmU.jpg', '2026-10-09', 0.0, '2026-04-23 15:08:34', NULL),
(4, 1198994, 'Cứu', 'Hai đồng nghiệp trở thành những người sống sót duy nhất sau một vụ rơi máy bay và bị mắc kẹt trên một hòn đảo hoang. Tại đây, họ buộc phải gạt bỏ những mâu thuẫn trong quá khứ để hợp tác sinh tồn. Nhưng càng kéo dài, cuộc chiến không chỉ còn là chống chọi với thiên nhiên khắc nghiệt — mà trở thành màn đấu trí và đấu ý chí, nơi chỉ những người đủ tỉnh táo và quyết liệt mới có cơ hội thoát ra sống sót.', '/hu5J1hJYToOxjceeqyXogq5nRwt.jpg', '/gCmfeKmEAZBP5gcXpiqb0gii9rS.jpg', '2026-01-22', 7.0, '2026-04-23 15:08:35', 'cOmnmFz_Uzs'),
(5, 83533, 'Avatar: Lửa và Tro Tàn', 'Sau cuộc chiến tàn khốc với RDA và nỗi mất mát to lớn khi đứa con trai cả hy sinh, Jake Sully và Neytiri phải đối mặt với một mối đe dọa mới trên Pandora: tộc Tro Tàn — một nhóm Na\'vi hung bạo và khát khao quyền lực, do thủ lĩnh tàn nhẫn Varang dẫn dắt. Gia đình Jake buộc phải chiến đấu để sinh tồn và bảo vệ tương lai của Pandora, trong một cuộc xung đột đẩy họ đến giới hạn cuối cùng cả về thể xác lẫn tinh thần.', '/w6DBmG260sCHBQdGzkBIVn9gAQZ.jpg', '/u8DU5fkLoM5tTRukzPC31oGPxaQ.jpg', '2025-12-17', 7.4, '2026-04-23 15:08:36', 'wIiASgAkk7g'),
(6, 1613798, 'Venganza', '', '/ggJGx8fwwy21gEIXYusIlHcUn8z.jpg', '/jJmlCFi5EjpH5vHmOczRiVDm0qS.jpg', '2026-02-26', 6.7, '2026-04-23 15:08:37', 'w5ImAc3jMsE'),
(7, 687163, 'Thoát Khỏi Tận Thế', 'Mất trí nhớ và lạc lõng trên một con tàu vũ trụ, một phi hành gia khám phá ra rằng anh là hy vọng duy nhất của nhân loại trước bờ vực tuyệt chủng. Một liên minh bất ngờ được hình thành, nắm giữ vận mệnh của tất cả.', '/7NzV9SN5ocWzMrdQw9fFDgLYVJC.jpg', '/8Tfys3mDZVp4tNoH2ktm06a0Tau.jpg', '2026-03-15', 8.2, '2026-04-23 15:08:38', 'NKYea63tQmI'),
(8, 1470130, 'Trợ lý nhà xác', 'Rebecca Owens, một sinh viên mới tốt nghiệp ngành khoa học nhà xác, nhận công việc ca đêm tại nhà xác River Fields. Ban đầu, công việc có vẻ đơn giản — ướp xác, hoàn thành giấy tờ và giữ gìn vệ sinh. Nhưng khi Rebecca bắt đầu làm ca đêm, mọi chuyện bắt đầu trở nên tăm tối.', '/72AoFPC5TY4DfJwXXS9rPwPeReD.jpg', '/gM1kQRPwOVW1Eos5tVWqcYmHR5S.jpg', '2026-02-13', 5.5, '2026-04-23 15:08:39', 'IU6q_BwYz2k'),
(9, 1290821, 'Kẻ Ẩn Dật', 'Michael Mason, một cựu sát thủ chính phủ đang sống ẩn dật trên một hòn đảo hẻo lánh tại Scotland, tình cờ cứu mạng một cô bé tên Jessie sau một cơn bão dữ dội. Hành động nghĩa hiệp này vô tình khiến tung tích của anh bị lộ, buộc Mason phải đối đầu với những bóng ma từ quá khứ và các đặc vụ MI6 đang truy đuổi gắt gao. Để bảo vệ đứa trẻ, anh phải từ bỏ cuộc sống yên bình, vận dụng mọi kỹ năng sinh tồn và chiến đấu để thoát khỏi vòng vây của những kẻ thù nguy hiểm.', '/mucESEbFFqk3ilVpNxEF53IHIVT.jpg', '/nHxWyy18SvAZ8jJeemtS8k1UNjM.jpg', '2026-01-28', 6.8, '2026-04-23 15:08:40', 'auHiLFjaIc0'),
(10, 1327819, 'Hoppers: Cú Nhảy Kỳ Diệu', 'Các nhà khoa học đã khám phá ra cách \"nhảy\" ý thức con người vào những con vật robot sống động như thật, cho phép con người giao tiếp với động vật dưới hình dạng động vật! Nhờ công nghệ mới này, Mabel sẽ khám phá những bí ẩn trong thế giới động vật vượt xa mọi điều cô từng tưởng tượng.', '/1A7WxXAYddDCrO9dTCEdSzQKU9d.jpg', '/u53UYu5XG2hNgWGvs3xGhAVzypl.jpg', '2026-03-04', 7.6, '2026-04-23 15:08:41', 'PypDSyIRRSs'),
(11, 1084577, 'Balls Up', '', '/xwvJ3WzdJ1OCuDoY8LAxBUlQyig.jpg', '/jRsjWwZzI39bTm44FNhRtiICd9k.jpg', '2026-04-15', 5.7, '2026-04-23 15:08:42', 'zgzxY4RtxBg'),
(12, 840464, 'Thảm Họa Thiên Thạch 2: Đại Di Cư', 'Sau ngày tận thế, gia đình Garrity rời boong-ke an toàn ở Greenland, mạo hiểm tất cả để bước vào một hành trình đầy hiểm nguy, băng qua vùng đất hoang tàn của châu Âu nhằm tìm kiếm một mái nhà mới.', '/o3mnfe0nJuD5oBBbGebN3xGYzaK.jpg', '/wns4x1GyxCudgOZRyhXKjXVJf3T.jpg', '2026-01-07', 6.5, '2026-04-23 15:08:43', 'hiD3zk0ZRFg'),
(13, 1290417, 'Cá Mập Săn Người', 'Dòng nước lũ dữ dội nhuộm đỏ máu khi cư dân mắc kẹt ở thị trấn ven biển chiến đấu để sinh tồn trước cơn siêu bão tàn khốc và bầy cá mập đói khát theo bão kéo đến.', '/adk8weka3O5648g3de4z3y4aE7G.jpg', '/3ooXDVaz4xHKtwe4lkmF1gNopOC.jpg', '2026-04-10', 6.0, '2026-04-23 15:08:45', 'hzyOsNyDkbM'),
(14, 1304313, 'Xác Ướp', 'Con gái nhỏ của một nhà báo biến mất không dấu vết giữa sa mạc. Tám năm sau, gia đình tan vỡ của họ bàng hoàng khi cô bé bất ngờ được đưa trở về — nhưng cuộc đoàn tụ tưởng chừng hạnh phúc nhanh chóng biến thành một cơn ác mộng sống.', '/fIbu9GsLv7j8uWA8OiAEtpNEDsZ.jpg', '/zc08qkHtWfZ2cQGQBK1S5yafJmR.jpg', '2026-04-15', 6.9, '2026-04-23 15:08:46', '6wbMsDmJLCs'),
(15, 1171145, 'Tội Phạm 101', 'Lấy bối cảnh thành phố Los Angeles đầy nắng và bụi đường, Tội Phạm 101 kể về một tên trộm nữ trang bí ẩn (Chris Hemsworth) với hàng loạt phi vụ táo bạo khiến cảnh sát phải đau đầu. Trong lúc chuẩn bị cho phi vụ lớn nhất của mình, hắn gặp gỡ một nữ nhân viên bảo hiểm (Halle Berry), người cũng đang vật lộn với những lựa chọn trong đời mình. Trong khi đó, một thanh tra (Mark Ruffalo) đã tìm ra quy luật trong chuỗi các vụ án và đang ráo riết truy đuổi tên trộm, khiến cuộc chơi trở nên căng thẳng hơn bao giờ hết. Khi phi vụ định mệnh đến gần, ranh giới giữa kẻ săn đuổi và con mồi dần trở nên mờ nhạt và cả ba buộc phải đối mặt với những lựa chọn khó khăn và không còn cơ hội để quay đầu lại. Bộ phim được chuyển thể từ tiểu thuyết ngắn nổi tiếng cùng tên của Don Winslow, do Bart Layton (tác giả của American Animals, The Imposter) viết kịch bản và đạo diễn. Dàn diễn viên có sự tham gia của Barry Keoghan, Monica Barbaro, Corey Hawkins, Jennifer Jason Leigh và Nick Nolte.', '/2i7DfVMYX7DyjmQiX64Le8uK45K.jpg', '/vG42HeYtoTFflqwP42wYD7tBuNr.jpg', '2026-02-11', 7.0, '2026-04-23 15:08:47', 'KeEHsuZ4Ja4'),
(16, 1010755, 'Sát Nhân Giấu Mặt: Chương 3', 'Bị trói chặt bởi một kết cục đáng sợ, Maya và những kẻ xa lạ bị cuốn vào quỹ đạo va chạm không thể tránh khỏi — tàn nhẫn và không khoan nhượng. Cuộc đối đầu cuối cùng ấy phơi bày một sự thật rõ ràng: họ đã không còn là những người xa lạ từ lâu.', '/yPHwX78mcwJw3I6YOJ9qh2wQBFr.jpg', '/fPfDB0IHOqvmKIzFP9CA51OOS1N.jpg', '2026-02-05', 5.7, '2026-04-23 15:08:48', 'B2fZEIHamVs'),
(17, 1641319, 'Xạ Thủ Bắn Tỉa: Vô Tổ Quốc', 'Brandon Beckett và Đặc vụ Zero dẫn đầu một nhiệm vụ giải cứu ở Venezuela khi bạn bè của họ bị bắt làm con tin.', '/tUmARo0TZEK1EaSuS6dU35FhDyU.jpg', '/7lizs4SuEU2ihkkAa0SZ66NtHbl.jpg', '2026-04-07', 6.2, '2026-04-23 15:08:49', '-smVu1cxPm8'),
(18, 1297842, 'Tuyển Thủ Dê: \"Mùi\" Vị Chiến Thắng', 'Will là một chú dê nhỏ với những ước mơ lớn, người có được cơ hội duy nhất trong đời để gia nhập các vận động viên chuyên nghiệp và thi đấu môn rugebol — một môn thể thao cường độ cao, pha trộn và đối kháng toàn diện, nơi các loài động vật nhanh nhất và hung dữ nhất thế giới thống trị. Những đồng đội mới của Will không mấy hào hứng khi có một chú dê nhỏ trong đội hình, nhưng Will quyết tâm tạo nên một cuộc cách mạng cho môn thể thao này và chứng minh một lần và mãi mãi rằng: “Nhỏ bé cũng biết chơi!”', '/wZRJ3Q2XRJHov1SS80sTXbfjkz9.jpg', '/tq3h43fZy0H80vzf47MAY7R9Mxo.jpg', '2026-02-11', 7.9, '2026-04-23 15:08:50', 'kmY-rYS7yng'),
(19, 1311031, 'Thanh Gươm Diệt Quỷ: Vô Hạn Thành', 'Khi các thành viên của Sát Quỷ Đoàn và Trụ Cột tham gia vào chương trình đặc huấn để chuẩn bị cho trận chiến sắp với lũ quỷ, Kibutsuji Muzan xuất hiện tại Dinh thự Ubuyashiki. Khi thủ lĩnh của Sát Quỷ Đoàn gặp nguy hiểm, Tanjiro và các Trụ Cột trở về trụ sở Thế nhưng, Muzan bất ngờ kéo toàn bộ Sát Quỷ Đoàn đến hang ổ cuối cùng của lũ quỷ là Vô Hạn Thành, mở màn cho trận đánh cuối cùng của cả hai phe.', '/nV99ACeAa8fFFso0tQZ3HktEf5X.jpg', '/1RgPyOhN4DRs225BGTlHJqCudII.jpg', '2025-07-18', 7.7, '2026-04-23 15:08:51', 'EpAlHmuA2YM'),
(20, 1480387, 'tần số ngầm', 'Người dẫn một podcast nổi tiếng về hiện tượng siêu nhiên bắt đầu bị ám ảnh bởi những bản ghi âm kinh hoàng được gửi đến cô một cách bí ẩn. Khi càng đào sâu vào nguồn gốc của các đoạn ghi ấy, ranh giới giữa công việc và nỗi sợ cá nhân dần sụp đổ.', '/4mDfScBru6CozdrnV6As3lnvj3Z.jpg', '/qXxFWyur7jFkg2aQgENcXuyYeHF.jpg', '2026-03-12', 6.6, '2026-04-23 15:08:52', '1fCZhJMkBaY'),
(21, 1352874, 'The Crucifix: Blood of the Exorcist', '', '/uLXxpWRfoIPfB2fwM8hsAMIjSWf.jpg', '/be5T7oHxmDG4ytEimwPdmDHZD9N.jpg', '2025-01-09', 6.6, '2026-04-23 15:08:54', 'PkuXT8GSz9Y'),
(22, 502356, 'Anh Em Super Mario', 'The Super Mario Bros. Movie xoay quanh cuộc phiêu lưu ở thế giới Vương quốc Nấm của anh em thợ sửa ống nước Mario và Luigi. Sau khi tình cờ bước tới vùng đất lạ từ một ống nước, Luigi đã bị chia tách với Mario và rơi vào tay quái vật rùa xấu xa Bowser, hắn đang âm mưu độc chiếm thế giới. Trong lúc cố gắng tìm kiếm người anh em của mình, Mario đã chạm mặt anh bạn nấm Toad và công chúa Peach. Từ đây họ sát cánh bên nhau trên hành trình ngăn chặn thế lực hắc ám.', '/gRlfFcpPdjREQ3lgeuAuB10gfbR.jpg', '/9n2tJBplPbgR2ca05hS5CKXwP2c.jpg', '2023-04-05', 7.6, '2026-04-23 15:08:54', 'UGO_i2tf1BM'),
(23, 1159559, 'Tiếng Thét 7', 'Sidney Evans (Neve Campbell), nạn nhân sống sót của một vụ thảm sát nhiều năm trước, giờ đang sống hạnh phúc cùng chồng và con gái ở một thị trấn khác thì tên sát nhân Ghostface mới lại xuất hiện. Những nỗi sợ hãi đen tối nhất của cô trở thành hiện thực khi con gái cô Tatum Evans (Isabel May) trở thành mục tiêu tiếp theo. Quyết tâm bảo vệ gia đình, Sidney buộc phải đối mặt với những kinh hoàng trong quá khứ để chấm dứt cuộc đổ máu một lần và mãi mãi.', '/nXXpliMy4Y0mwRa4OlhOb6GyOEE.jpg', '/t9J2HXaDuJR7bvIG9XF7mttn4VY.jpg', '2026-02-25', 6.1, '2026-04-23 15:08:55', '4g8OciWNJn4'),
(24, 1084242, 'Phi Vụ Động Trời 2', 'Trong bộ phim \"Zootopia 2 - Phi Vụ Động Trời 2\" từ Walt Disney Animation Studios, hai thám tử Judy Hopps (lồng tiếng bởi Ginnifer Goodwin) và Nick Wilde (lồng tiếng bởi Jason Bateman) bước vào hành trình truy tìm một sinh vật bò sát bí ẩn vừa xuất hiện tại Zootopia và khiến cả vương quốc động vật bị đảo lộn. Để phá được vụ án, Judy và Nick buộc phải hoạt động bí mật tại những khu vực mới lạ của thành phố – nơi mối quan hệ đồng nghiệp của họ bị thử thách hơn bao giờ hết.', '/5wXpOF9WPUKliIzNBdAqwAStLHU.jpg', '/lgotja3xMoJZbynwHfcQcJAEMWH.jpg', '2025-11-26', 7.6, '2026-04-23 15:08:56', '4iWVnVg33Pc'),
(25, 350, 'Yêu Nữ Thích Hàng Hiệu', 'Một sinh viên tốt nghiệp thông minh nhưng nhạy cảm mới làm nghề trợ lý cho Miranda Priestly, tổng biên tập tạp chí thời trang cao cấp. Liệu cô ấy có thể hoàn thành công việc cho Miranda khó tính không?', '/d4nV102c3QLA5T77tjfq9tcCvmi.jpg', '/CpLAfXgSNeNRRbRzPrTuzKmIHO.jpg', '2006-06-29', 7.4, '2026-04-23 15:08:57', '6ZOZwUQKu3E'),
(26, 1419406, 'Bổ Phong Truy Ảnh', 'Wong Tak-Chung, một cựu chuyên gia giám sát được biết đến với khả năng phân tích dữ liệu và truy vết bậc thầy, bị cảnh sát Ma Cao mời trở lại hợp tác điều tra sau khi xuất hiện hàng loạt vụ cướp quy mô lớn do một tổ chức tội phạm công nghệ cao thực hiện.', '/5LGUvRBXoXHsMZsZrCGBOVmwOVd.jpg', '/4BtL2vvEufDXDP4u6xQjjQ1Y2aT.jpg', '2025-08-16', 7.2, '2026-04-23 15:08:58', 'xvmADAJOoCg'),
(27, 1193501, 'Tiếng Còi Tử Thần', 'Một nhóm học sinh trung học lạc lõng tình cờ phát hiện một chiếc còi tử thần cổ xưa của người Aztec. Họ sớm nhận ra rằng mỗi khi thổi chiếc còi này, âm thanh kinh hoàng phát ra sẽ triệu hồi chính cái chết trong tương lai của họ quay lại săn lùng. Khi số người thiệt mạng ngày càng tăng, cả nhóm buộc phải lần theo nguồn gốc của di vật chết chóc ấy, trong nỗ lực tuyệt vọng nhằm chấm dứt chuỗi sự kiện kinh hoàng mà chính họ đã vô tình khởi động.', '/eGxPyseSnEZBMJaopGfRUO9HSYx.jpg', '/yJi6g0CnsqANLNuVaRX28tZxeHX.jpg', '2026-01-20', 6.0, '2026-04-23 15:08:59', '-O5DgGQJeks'),
(28, 848116, 'रॉकी और रानी की प्रेम कहानी', '', '/vTQIqlxUkOuyf2UKhlM2OUaFGKz.jpg', '/61RYedFgX1K07xgVIvdJzukSR4g.jpg', '2023-07-28', 6.1, '2026-04-23 15:09:01', 'Ah_AMkoaLWA'),
(29, 1368166, 'Cô Hầu Gái', 'Từ đạo diễn Paul Feig, một thế giới hỗn loạn sẽ mở ra, nơi sự hoàn hảo chỉ là ảo giác và mọi thứ dường như đều đang che đậy một bí mật đằng sau. Để chạy trốn khỏi quá khứ, Millie (Sydney Sweeney) trở thành bảo mẫu cho gia đình Nina (Amanda Seyfried) và Andrew (Brandon Sklener), một cặp đôi giàu có. Nhưng ngay khi cô chuyển vào sống chung và bắt đầu công việc \"trong mơ\", sự thật dần được hé lộ - đằng sau vẻ ngoài xa hoa lộng lẫy là mối nguy lớn hơn bất cứ thứ gì Millie có thể tưởng tượng. Một trò chơi đầy cám dỗ của bí mật và quyền lực sắp bắt đầu.', '/vpHLCt2bwYmmkGH4soqJNIFLOUQ.jpg', '/zTnAnYIn0Iv3cn0ZHlzLhou3ybm.jpg', '2025-12-18', 7.2, '2026-04-23 15:09:02', 'BqWH0KDqm3U'),
(30, 1418657, 'The Yeti', '', '/zaqEfoKcWkVni2eONhJ7DRhMO8Q.jpg', '/1ytf7rzkZ7RLlMnBdGggQ0ENe6z.jpg', '2026-04-04', 6.8, '2026-04-23 15:09:03', '7rXJdyv5cRQ'),
(31, 1265609, 'Cỗ máy chiến tranh', 'Trong nhiệm vụ cuối cùng của khóa huấn luyện Biệt kích Lục quân, một kỹ sư chiến đấu phải dẫn dắt đơn vị chống lại một cỗ máy giết người khổng lồ đến từ thế giới khác.', '/n1IwU8lLbvPZXqjfO7PYKzsmNXe.jpg', '/6yeVcxFR0j08vlv2OlL6zbewm4D.jpg', '2026-02-12', 7.2, '2026-04-23 15:09:04', 'AFuE1LRxm80'),
(32, 680493, 'Đồi Câm Lặng: Ác Mộng Trong Sương', 'Khi James nhận được một bức thư bí ẩn từ Mary — người yêu đã mất của mình — anh bị kéo trở lại Silent Hill, thị trấn quen thuộc một thời nay đã chìm trong bóng tối. Trong hành trình tìm kiếm cô, James phải đối mặt với những sinh vật quái dị và dần hé lộ một sự thật kinh hoàng, thứ sẽ đẩy anh đến bờ vực của sự tỉnh táo.', '/146wZtwet4MhwlREVD7aJjB4DUf.jpg', '/v0NEB75SZjxY8GS3ho8WeEvjIT3.jpg', '2026-01-21', 5.2, '2026-04-23 15:09:05', 'z10cMFhKbW8'),
(33, 1511057, 'Bạn cùng phòng', 'Khi tân sinh viên nhút nhát Devon mời cô nàng sành điệu Celeste ở cùng phòng, tình bạn mới chớm nở dần hóa thành cuộc chiến ngầm đầy gay gắt.', '/eW1s6omXIfVkTlmKVe9y9Dwwt4u.jpg', '/hpEjnTB0gAhMCBN42CJZawRfWuv.jpg', '2026-04-13', 6.4, '2026-04-23 15:09:06', 'PF3dDdeSIVc'),
(34, 936075, 'Michael', 'Michael là bức chân dung điện ảnh khắc họa cuộc đời và di sản của một trong những nghệ sĩ có sức ảnh hưởng lớn nhất mà thế giới từng biết đến. Bộ phim kể về cuộc đời của Michael Jackson ngoài âm nhạc, theo dấu hành trình từ khi tài năng phi thường của ông được phát hiện trong vai trò giọng ca chính của nhóm Jackson Five, cho đến khi ông trở thành một nghệ sĩ có tầm nhìn xa, với khát vọng sáng tạo không ngừng để vươn tới danh hiệu “ngôi sao giải trí vĩ đại nhất thế giới”. Cho thấy cuộc sống phía sau hào quang sân khấu lẫn những màn trình diễn mang tính biểu tượng nhất trong giai đoạn đầu sự nghiệp solo, bộ phim mang đến cho khán giả một góc nhìn chân thực hơn bao giờ hết về Michael Jackson. Đây chính là nơi câu chuyện của ông bắt đầu.', '/sXP7VzpnHQIThf5v6b64XaczEK2.jpg', '/xBT0oNq6rsTFv4SxG5uGRIEOrq6.jpg', '2026-04-22', 7.2, '2026-04-23 15:09:07', '4k_D-gngvd4'),
(35, 755898, 'Cuộc Chiến Giữa Các Thế Giới', 'Will Radford — chuyên gia phân tích an ninh mạng hàng đầu của Bộ An ninh Nội địa — chuyên theo dõi các mối đe dọa đến an ninh quốc gia thông qua một chương trình giám sát diện rộng. Nhưng một cuộc tấn công bất ngờ từ một thực thể bí ẩn đã khiến anh bắt đầu nghi ngờ: phải chăng chính phủ đang che giấu điều gì đó… không chỉ với anh mà với toàn thế giới?', '/3e6GQvCA9hguxqfqA75BDvG7Vvp.jpg', '/iZLqwEwUViJdSkGVjePGhxYzbDb.jpg', '2025-07-29', 4.1, '2026-04-23 15:09:08', 'd9erkpdh5o0'),
(36, 1084187, 'Khá nguy hiểm', 'Một đoàn vũ công ba lê phải chiến đấu để sinh tồn khi cố gắng trốn thoát khỏi một quán trọ hẻo lánh sau khi xe buýt của họ bị hỏng trên đường đến một cuộc thi khiêu vũ.', '/znTPnXCK3lEQJgqXCvP7e5FUz6f.jpg', '/z3bzhmC0CPikWeerUkLO73YvGrC.jpg', '2026-03-13', 6.8, '2026-04-23 15:09:09', 'MpNobYCw0mg'),
(37, 1526650, 'Oán Thai Đòi Mẹ', 'Khi phát triển trò chơi kinh dị, Húc Xuyên vô tình mang con búp bê đất sét bị vỡ từ chỗ làm về nhà, không hay biết rằng nó chứa một linh hồn oán hận đang khao khát được giải thoát.', '/onlPWcpVAwuZAki2kAcWUxJkhcT.jpg', '/pmGkvEWKFDapogIzkG7TqB0aeYE.jpg', '2025-10-09', 6.9, '2026-04-23 15:09:10', 'I--CxbFKzPA'),
(38, 1659087, '180', 'Khi vụ va chạm bất ngờ do cơn giận sau tay lái khiến con trai anh nguy kịch, người bố phẫn nộ lao vào con đường đen tối của hỗn loạn cảm xúc và thù hận.', '/9ISjrhA38HpSSGtfiCk8lpziC3K.jpg', '/iQSXJs6RbTumcwxMjCedDoK99rx.jpg', '2026-04-16', 5.7, '2026-04-23 15:09:11', 'jHtGZS-TFOI'),
(39, 1601797, '¿Quieres Ser Mi Novia?', '', '/oscW8xV8EhRYj7iAhyVlBohKqxo.jpg', '/1ZruuRXztqC3QQybbgbVxVrdNjv.jpg', '2026-02-12', 8.0, '2026-04-23 15:09:12', 'ajV6r8Z-mlU'),
(40, 1234731, 'Đụng Độ Siêu Trăn', 'Một nhóm bạn thân đang khủng hoảng tuổi trung niên quyết định lên đường vào rừng rậm để làm lại bộ phim yêu thích thời trẻ. Nhưng hành trình hoài niệm nhanh chóng biến thành cuộc chiến sinh tồn dữ dội, khi họ phải đối mặt với thiên tai, rắn khổng lồ, và cả những tên tội phạm nguy hiểm.', '/4N2cVrDQ0T8LIvA5rjPefBTxqcL.jpg', '/swxhEJsAWms6X1fDZ4HdbvYBSf9.jpg', '2025-12-24', 5.9, '2026-04-23 15:09:14', 'LFLyvzIZjK4'),
(41, 1107166, 'Sát Nhân Điên Loạn', 'Sau vụ sát hại dã man của người chồng, một nữ cảnh sát tuần tra đường cao tốc bang Kansas bắt đầu hành trình truy tìm hung thủ. Càng tiến sâu vào cuộc săn lùng, cô dần nhận ra kẻ đứng sau tội ác không chỉ là một tên sát nhân hàng loạt tàn bạo, mà còn là một kẻ biến thái bệnh hoạn với mức độ suy đồi tâm trí và âm mưu đen tối vượt xa mọi tưởng tượng.', '/5xgxxmLivJXL8aF0HdZfpx8aAIo.jpg', '/kt9p1cS4O72aSeFRGQzlLuI1mY4.jpg', '2026-02-19', 5.6, '2026-04-23 15:09:16', 'pwq8gwdVxts'),
(42, 662707, 'Starbright', '', '/m1Zl07DNYeSyNcz9hf8hDsS2oB5.jpg', '/tZiRd4IpoNiaoLXr2o2YfhTMjE2.jpg', '2026-02-27', 7.0, '2026-04-23 15:09:18', 'hBxMbl2V3ZA'),
(43, 1159831, 'Cô Dâu!', 'Một cách tiếp cận táo bạo, phá vỡ mọi khuôn mẫu đối với một trong những câu chuyện hấp dẫn nhất thế giới. Bộ phim theo chân Frankenstein cô đơn (do Chrisitian Bale thủ vai) lên đường đến Chicago những năm 1930 để tìm đến nhà khoa học Dr. Euphronious (Annette Bening – 5 lần đề cử Oscar thủ vai), với hy vọng bà có thể tạo ra một người bạn đồng hành cho mình. Cả hai hồi sinh một cô gái trẻ đã bị sát hại, và Cô Dâu (Buckley thủ vai) đã ra đời. Những gì xảy ra sau đó đã vượt xa mọi tưởng tượng của họ: những vụ giết người, sự chiếm hữu, một phong trào văn hóa hoang dại và cấp tiến cũng như mối tình ngoài vòng pháp luật đầy cuồng nhiệt và bùng nổ!', '/60PGmrPEUId7KJQb17AAMsItMMJ.jpg', '/l8rKKMU2M9dDULO9CEtDNdWAEUJ.jpg', '2026-03-04', 6.3, '2026-04-23 15:09:19', 'QyLhkoGeSl4'),
(44, 7451, 'Điệp Viên xXx', 'Xander xXx Cage vốn nổi tiếng là một người say mê các trò mạo hiểm chết người và cho đến nay vẫn chưa từng bị luật pháp sờ gáy. Nhưng nhân viên tình báo Augustus Gibbons đã buộc xXx cộng tác với chính phủ bằng cách xâm nhập vào một tổ chức tội phạm của Nga. Nhiệm vụ của anh là thu thập thông tin về âm mưu tàn phá trái đất của nhóm phi chính phủ do Yorgi cầm đầu, đổi lại xXx sẽ không phải chôn chân trong nhà đá. Ông tìm cách đưa xXx lọt vào thế giới ngầm của bọn tội phạm mà không bị chúng phát giác. Với lòng dũng cảm và tài năng, anh phải vượt qua một đối thủ “khó nhằn” hơn bất kỳ thử thách nào anh từng đối mặt...', '/xeEw3eLeSFmJgXZzmF2Efww0q3s.jpg', '/2OHa6ukEq3Hce7Pc2kvu8wkmMFY.jpg', '2002-08-09', 6.0, '2026-04-23 15:09:21', 'NgPdDDzVhkA'),
(45, 1242898, 'Quái Thú Vô Hình: Vùng Đất Chết Chóc', 'Trong tương lai, tại một hành tinh hẻo lánh, một Predator non nớt - kẻ bị chính tộc của mình ruồng bỏ - tìm thấy một đồng minh không ngờ tới là Thia và bắt đầu hành trình sinh tử nhằm truy tìm kẻ thù tối thượng. Bộ phim do Dan Trachtenberg - đạo diễn của Prey chỉ đạo và nằm trong chuỗi thương hiệu Quái Thú Vô Hình Predator.', '/6aPy2tMgQLVz2IcifrL1Z2Q9u1t.jpg', '/82lM4GJ9uuNvNDOEpxFy77uv4Ak.jpg', '2025-11-05', 7.7, '2026-04-23 15:09:22', 'LkBqjfg8TGM'),
(46, 1367642, 'Điều Gợi Nhớ Về Anh', '', '/7L6rceYgzQ0NeHD7PRDNrRoQ291.jpg', '/5rxEnsgriw8z065q51lrvPKYmCL.jpg', '2026-03-11', 7.2, '2026-04-23 15:09:23', 'i36Zw32GfRQ'),
(47, 1268127, 'Humint', 'Trong khi truy quét đường dây ma túy ở Nga, đặc vụ Hàn Quốc nọ phải hợp tác với một đặc vụ Triều Tiên, rồi tình yêu với người đó thử thách lòng trung thành của anh.', '/f7sCSLEPRfV2fWQ0RYOtHhnHXuG.jpg', '/5KFThZkdBEQkp9gPWWWNb5CI5yD.jpg', '2026-02-11', 7.2, '2026-04-23 15:09:24', 'n6scQ_ds0x8'),
(48, 1115544, 'Mike & Nick & Nick & Alice', '', '/7F0jc75HrSkLVcvOXR2FXAIwuEv.jpg', '/uNToXatdunyvWXyXMrTI1nLvh6r.jpg', '2026-03-14', 6.7, '2026-04-23 15:09:25', 'pI-2t18TXqs'),
(49, 1049471, 'Nhân Quả - Outcome', 'Reef Hawk, \"đứa con cưng\" trên các tấm áp phích của Hollywood từ năm sáu tuổi, đang không ổn chút nào. Khi biết mình bị tống tiền liên quan đến một đoạn video bí ẩn, Reef chủ động thực hiện hành trình chuộc lỗi để sửa chữa sai lầm, đối mặt với bóng ma tâm lý và tránh bị tẩy chay.', '/2Iyn6muxMXAEO87yCA2eUXklW1C.jpg', '/avwIERZtWiWa34qShf5biDzAVaF.jpg', '2026-04-06', 5.3, '2026-04-23 15:09:26', 'NQQqInahTAM'),
(50, 329505, 'Il peccato di Lola', '', '/iQt9Kydd8yn9xfBvYeKec56glyv.jpg', '/tId87yE7JnQsQsqOpnGXjz9PoEe.jpg', '1984-05-04', 7.0, '2026-04-23 15:09:27', NULL),
(51, 879945, 'L\'homme inconnu', '', '/4TpBhdaSl5ALHbgeaYOLF8Q3haz.jpg', '/7uXzE0ZBkbAeKylOz7cUQF4Yw75.jpg', '2021-10-16', 7.3, '2026-04-23 15:09:29', 'W7x1EJvXHd4'),
(52, 157336, 'Hố Đen Tử Thần', 'Interstellar nói về chuyến hành trình đi tìm một hành tinh mới cho loài người trú ngụ khi mà Trái Đất dần dần không còn là nơi an toàn và sự sống thì đang chết dần với những dịch bệnh trên các loại cây lương thực, đe dọa đến sự tồn tại của loài người một cách mạnh mẽ. Chúng ta sẽ đi theo hành trình của phi hành đoàn gồm Copper, Amelia cùng các thành viên khác trong việc giải cứu các phi hành gia khác đã lên đường khám phá các hành tinh mới để tìm ra hành tinh mới cho loài người trú ngụ', '/if4TI9LbqNIrzkoOgWjX5PZYDYe.jpg', '/2ssWTSVklAEc98frZUQhgtGHx7s.jpg', '2014-11-05', 8.5, '2026-04-23 15:09:29', 'QqSp_dwslro'),
(53, 24428, 'Avengers 1:Biệt Đội Siêu Anh Hùng', 'The Avengers là bộ phim giả tưởng kể về một nhóm siêu anh hùng với những khả năng đặc biệt, họ bao gồm: Người Sắt, Thor, Đội trưởng Mỹ, và Người Khổng Lồ Xanh Hulk cùng tham gia với tổ chức bảo vệ thế giới SHIELD. Mục đích của SHIELD là nhằm bảo vệ Trái Đất khỏi âm mưu hủy hoại của những thế lực xấu từ ngoài địa cầu mà kẻ cầm đầu là Loki.', '/rX46P5ZwcHOvrkhtYDYhnNf46Bo.jpg', '/9BBTo63ANSmhC4e6r62OJFuK2GL.jpg', '2012-04-25', 8.0, '2026-04-23 15:09:30', 'hIR8Ar-Z4hw'),
(54, 1316092, '“Đồi Gió Hú”', 'Một chuyện tình say đắm và đầy giông bão, diễn ra giữa khung cảnh hoang dã của vùng đồng hoang Yorkshire, khắc họa mối quan hệ mãnh liệt nhưng đầy hủy diệt giữa Heathcliff và Catherine Earnshaw.', '/hMcz9mWJU1bPOWsL6ShQaFLwhbv.jpg', '/vSQSYd2zZTqc0zmHImwWEGGluMI.jpg', '2026-02-11', 6.5, '2026-04-23 15:09:31', '3fLCdIYShEQ'),
(55, 440249, 'After Porn Ends 2', '', '/rfItXrtDGILwsCdmgVxX79phFuI.jpg', '/3Sq9c1Lxh75neQ2BC9thaTO74FZ.jpg', '2017-03-28', 5.3, '2026-04-23 15:09:33', 'T9fLBBxjAgM'),
(56, 1168190, 'Biệt Đội Đập Phá', 'Hai anh em cùng cha khác mẹ Jonny và James đoàn tụ sau cái chết bí ẩn của cha họ. Khi họ tìm kiếm sự thật, những bí mật bị chôn giấu tiết lộ một âm mưu đe dọa chia cắt gia đình họ.', '/yQ8wtSr156Jli2so4rIA0mViT8m.jpg', '/cz4vLJrmaV1zJlRYbxqtvLzeLWB.jpg', '2026-01-28', 6.9, '2026-04-23 15:09:34', 'v8R0xDczERo'),
(57, 1272837, '28 Năm Sau: Ngôi Đền Tử Thần', 'Mở rộng thế giới do Danny Boyle và Alex Garland xây dựng trong loại phim 28 Năm Sau nhưng đồng thời đảo ngược hoàn toàn mọi trật tự vốn có trong thế giới ấy. Nia DaCosta đảm nhận vai trò đạo diễn bộ phim 28 Năm Sau: Thánh Địa Xương. Tiếp nối câu chuyện, bác sĩ Kelson (Ralph Fiennes) bất ngờ rơi vào một mối quan hệ mới đầy bất ngờ, có khả năng làm thay đổi cả thế giới mà ta từng biết. Trong khi đó, cuộc chạm trán của Spike (Alfie Williams) với Jimmy Crystal (Jack O\'Connell) lại biến thành một cơn ác mộng không lối thoát của cậu bé. Trong thế giới của Thánh Địa Xương, những kẻ bị nhiễm bệnh không còn là mối đe dọa sinh tồn lớn nhất mà chính sự vô nhân tính của những kẻ sống sót mới là thứ quái lạ và đáng sợ hơn.', '/dGTV0DVizaRh5fAsrtB95FnGSlf.jpg', '/hHDNOlATHhre4eZ7aYz5cdyJLik.jpg', '2026-01-14', 7.1, '2026-04-23 15:09:35', 'rl_DJZCyEH4'),
(58, 1646787, 'Sundutan', '', '/2neZgVuY7prWIak5hhNKT53Hk0N.jpg', '/zYm62AouAahA71AoOWHE5Qb0FYH.jpg', '2026-03-06', 4.0, '2026-04-23 15:09:36', 'iVOyYHzvbKc'),
(59, 1610418, 'The House on Haunted Grounds', '', '/750RNSHr25GQcCr2Ws8iSGrHJA9.jpg', '/r9aYDDP7tHpwCvQbOxcfhZFBT63.jpg', '2026-01-09', 5.8, '2026-04-23 15:13:41', 'uXHjb8_z9bE'),
(60, 1108427, 'Hành Trình Của Moana', '', '/lwqKqiBsGVBtQBZF9ZTunthBCyI.jpg', '/lniL0aoEvuWxfZOcZss7vWQfi1x.jpg', '2026-07-08', 0.0, '2026-04-23 15:13:42', 'n7f6hlKsxxo'),
(61, 875828, 'Bóng ma Anh Quốc: Người bất tử', 'Sau khi cậu con trai xa cách bị cuốn vào một âm mưu của Đức Quốc xã, trùm tội phạm sống lưu vong Tommy Shelby buộc phải trở lại Birmingham để cứu gia đình và bảo vệ đất nước.', '/kS9AeG0KHfTgze3CkYuhv1vl8EU.jpg', '/aouxo2EaR7QSGBBUNTITuW0lj4z.jpg', '2026-03-05', 7.2, '2026-04-23 15:13:44', 'lcvUGs3xaDM'),
(62, 1110034, 'Quái Vật Biển', 'Bối cảnh đặt vào thời Chiến tranh Lạnh, một tàu ngầm tên lửa Nga biến mất bí ẩn trên Biển Greenland. Đại úy Viktor Voronin (Alexander Petrov) — người em của chỉ huy tàu mất tích — dẫn đầu chiến dịch cứu hộ. Trong khi đó, một căn cứ địa chất ở Bắc Cực vô tình đánh thức con Kraken—một quái vật biển sâu khổng lồ với khả năng ngụy trang siêu việt và trí thông minh đáng sợ. Khi nhóm cứu hộ tiếp cận khu vực tàu ngầm mất tích, họ cũng phải đối mặt với sinh vật huyền thoại đang nổi lên từ đáy đại dương', '/8ExwomWgJoXBdY3u1Otiw2zY9wZ.jpg', '/xcBlMEvzuaHoWANKYn5PGvcW4OC.jpg', '2026-02-06', 6.0, '2026-04-23 15:13:46', 'EUTatY1-oBI'),
(63, 1658216, 'Stepdaddy', '', '/oZxNblisKuDzSUW5g18FERjyJs9.jpg', '/nyW8YdrnSYtmTE9hgrpmGqkKw5b.jpg', '2026-04-04', 5.0, '2026-04-23 15:13:47', 'HKeFNJTKuws'),
(64, 1088434, 'Lửa Địa Ngục', 'Một kẻ lang thang với quá khứ bí ẩn đến một thị trấn nhỏ và phát hiện ra cư dân nơi đây đang bị một ông trùm tội phạm tàn nhẫn khống chế. Anh ta nhận ra mình phải giúp đỡ họ.', '/tQti9QTf13MfzNpXguijgNh7ojE.jpg', '/fyv3Cmsdq4pfiKU6M3azRATwBBU.jpg', '2026-02-05', 6.8, '2026-04-23 15:13:48', 'S_uvyNNCiMc'),
(65, 425274, 'Phi Vụ Thế Kỷ 3: Thoắt Ẩn Thoắt Hiện', 'Tứ Kỵ Sĩ chính thức tái xuất, bắt tay cùng các tân binh ảo thuật gia Gen Z trong một phi vụ đánh cắp kim cương liều lĩnh nhất trong sự nghiệp. Họ phải đối đầu với bà trùm Veronika của đế chế rửa tiền nhà Vandenberg (do Rosamund Pike thủ vai) - một người phụ nữ quyền lực và đầy thủ đoạn. Khi kinh nghiệm lão làng của bộ tứ ảo thuật va chạm với công nghệ 4.0 của một mạng lưới tội phạm xuyên lục địa, liệu ai sẽ làm chủ cuộc chơi? Hãy chuẩn bị tinh thần cho những cú xoắn não mà bạn không thể đoán trước!', '/usoYdcapXSsqAM1bDOtD7H42Wxe.jpg', '/dHSz0tSFuO2CsXJ1CApSauP9Ncl.jpg', '2025-11-12', 6.5, '2026-04-23 15:13:49', 'lLWESUfW-0A'),
(66, 278, 'Nhà Tù Shawshank', 'Nhà tù Shawshank kể về Andrew, một nhân viên nhà băng, bị kết án chung thân sau khi giết vợ và nhân tình của cô. Anh một mực cho rằng mình bị oan. Andy bị đưa tới nhà tù Shawshank. Tại đây, thế giới ngầm của các phạm nhân, sự hà khắc của hệ thống quản giáo xung đột và giành nhau quyền thống trị. Chỉ có các phạm nhân trung lập là bị kẹt ở giữa và có thể bỏ mạng. Làm quen với tay ‘quản lý chợ đen’ Redding, Andy dần thích nghi với cuộc sống tại Shawshank. Song, kế hoạch lớn hơn việc tồn tại ở nhà tù này đang được anh suy tính. Qua con mắt và lời kể của Redding, cuộc vượt ngục vĩ đại này được kể tuần tự cùng một kết thúc bất ngờ', '/zLyG4nquaaZKCA3CJdQCEzTwN1R.jpg', '/zfbjgQE1uSd9wiPTX4VzsLi0rGG.jpg', '1994-09-23', 8.7, '2026-04-23 15:13:50', 'PLl99DlL6b4'),
(67, 226674, 'L\'Adolescente', '', '/v7yCEzF9BCF82lbp42X5ZLjIieo.jpg', '/dqmeFUrf6Hs2ejcGGGfv69vtbbR.jpg', '1979-01-24', 4.2, '2026-04-23 15:13:52', NULL),
(68, 1234821, 'Thế Giới Khủng Long: Tái Sinh', 'Thế Giới Khủng Long: Tái Sinh lấy bối cảnh 5 năm sau phần phim Thế Giới Khủng Long: Lãnh Địa, môi trường Trái đất đã chứng tỏ phần lớn là không phù hợp với khủng long. Nhiều loài thằn lằn tiền sử được tái sinh đã chết. Những con chưa chết đã rút lui đến một vùng nhiệt đới hẻo lánh gần phòng thí nghiệm. Địa điểm đó chính là nơi bộ ba Scarlett Johansson, Mahershala Ali và Jonathan Bailey dấn thân vào một nhiệm vụ cực kỳ hiểm nguy.', '/2IVVciw7dPhUlNmYIaz0s1d56SZ.jpg', '/zNriRTr0kWwyaXPzdg1EIxf0BWk.jpg', '2025-07-01', 6.3, '2026-04-23 15:13:53', '2ZhB-YO5Tnk'),
(69, 238, 'Bố Già', 'Một câu chuyện kéo dài từ năm 1945 đến năm 1955, một biên niên sử về gia đình tội phạm Corleone người Mỹ gốc Ý. Khi tộc trưởng gia đình tội phạm có tổ chức, Vito Corleone bị ám sát bởi băng nhóm đối thủ, con trai út của ông, Michael đã phải nhúng tay vào tội ác và chống lại đối thủ với việc phát động một chiến dịch trả thù đẫm máu.', '/84MHN3JvOV4ORHgELrQM6SBlhdB.jpg', '/tSPT36ZKlP2WVHJLM4cQPLSzv3b.jpg', '1972-03-14', 8.7, '2026-04-23 15:13:54', 'Ew9ngL1GZvs'),
(70, 1236153, 'Bằng Chứng Sinh Tử', 'Trong một thế giới mới, bạn có 90 phút để chứng minh vô tội, hoặc không sẽ bị hành quyết ngay lập tức.', '/jGZ3ekw20xZGiLTrkWd1vTRBKCL.jpg', '/po1niVuud0tX86xOFegO5omQ2wX.jpg', '2026-01-20', 7.0, '2026-04-23 15:13:55', 'JUADqWkJiiE'),
(71, 299534, 'Avengers 4: Hồi Kết', 'Sau sự kiện hủy diệt tàn khốc, vũ trụ chìm trong cảnh hoang tàn. Với sự trợ giúp của những đồng minh còn sống sót, biệt đội siêu anh hùng Avengers tập hợp một lần nữa để đảo ngược hành động của Thanos và khôi phục lại trật tự của vũ trụ.', '/8go3YE9sBMQaCXEx23j6BAfeuxd.jpg', '/7RyHsO4yDXtBv1zUU3mTpHeQ0d5.jpg', '2019-04-24', 8.2, '2026-04-23 15:13:56', '4sZj4aeYUCA'),
(72, 803796, 'Thợ săn quỷ Kpop', 'Khi các siêu sao Kpop Rumi, Mira và Zoey không bận trình diễn tại các sân vận động cháy vé, họ sử dụng sức mạnh bí mật để bảo vệ người hâm mộ khỏi những mối đe dọa siêu nhiên.', '/y8OyohPhdTtusY0nXd2XdX4NN8W.jpg', '/w3Bi0wygeFQctn6AqFTwhGNXRwL.jpg', '2025-06-20', 8.0, '2026-04-23 15:13:57', 'AzCAwdp1uIQ'),
(73, 1325734, 'Cú Sốc', 'Một cặp đôi đang hạnh phúc chuẩn bị kết hôn bất ngờ bị thử thách khi một biến cố ngoài dự kiến khiến cả tuần lễ cưới của họ rơi vào hỗn loạn.', '/2r4p7IXUnbw8JkrsJK2vbhVIE2J.jpg', '/1oKLEA9JOhvaBwLpqjROisvWMy7.jpg', '2026-03-26', 7.0, '2026-04-23 15:13:58', '0ZDzsH3XGFA'),
(74, 1119449, 'Chúc May Mắn Và Vui Lên, Đừng Chết', '', '/rWcfOdY7TU6lTdazWj0ebDZnAfO.jpg', '/drRxbu2OHG0DEENptZ8wI5f0uEU.jpg', '2026-02-13', 6.9, '2026-04-23 15:13:59', 'Nm4WbapDzDQ'),
(75, 1539104, 'Chú Thuật Hồi Chiến: -BIến Cố Shibuya x Tử Diệt Hồi Du-', '', '/sBffPvE9Kau726nnU14cTOEj3Pq.jpg', '/gtKglOSEq3d4MgQE4VsrT1sRkd0.jpg', '2025-11-07', 5.9, '2026-04-23 15:14:00', 'XeoQg5PVOLI'),
(76, 1572073, 'The Deadly Little Mermaid', '', '/uye25uG7k8r3NNPLyPiKOiRnFRF.jpg', '/yzIjyPtwvyjHelxqIRXGpiaucPG.jpg', '2026-03-06', 4.7, '2026-04-23 15:14:02', 'xU4bplQ2ZbY'),
(77, 1266992, 'Lăng Nhăng', 'Một người phụ nữ giàu có kết hôn với một người lăng nhăng quyến rũ, người đang âm mưu với bạn thân của vợ anh ta. Khi mọi tiết lộ được phơi bày, tình thế bất ngờ thay đổi.', '/5gotyf6pPf9ZbDSW0yBLXMpDmmP.jpg', '/s4su6J8opkWW9ibqfBdG6oae5iw.jpg', '2024-05-17', 5.3, '2026-04-23 15:14:03', NULL),
(78, 1010581, 'Tội Lỗi', 'Cô nàng Noah buộc phải bỏ lại thị trấn, bạn trai và bạn bè thân để chuyển đến dinh thự của người cha dượng giàu có. Ở đó, cô gặp người anh kế mới Nick và tính cách của họ xung đột ngay từ đầu. Tuy nhiên, sự hấp dẫn của họ đối với nhau dần dần biến thành một mối tình bị cấm đoán!', '/3Kjcu12lIy0dCQA1756e9zG2slc.jpg', '/oz4U9eA6ilYf1tyiVuGmkftdLac.jpg', '2023-06-08', 7.7, '2026-04-23 15:14:04', 'xY-qRGC6Yu0'),
(79, 28322, 'Vacanze per un massacro', '', '/arRNmW27fs1TFsIBOwPYCfZQFJC.jpg', '/7TJjD2X9GTEqyLVIJKLS85J2V47.jpg', '1980-03-20', 4.9, '2026-04-23 15:14:05', NULL),
(80, 1472951, 'Infiltrate', '', '/8Cw8GF9wG63kF8pRRXwOx2kXGt.jpg', '/cfDHxkco8RrslL0Vk2XPTwTVFCe.jpg', '2026-04-10', 5.5, '2026-04-23 15:14:06', 'dzVz0KqqwGE'),
(81, 300496, 'Nefeli', '', '/4EgkcisexFjGfQmGI0IrVxZUBIv.jpg', '/yPbW94JRopYqjz2CLyEiUhEwbB5.jpg', '1980-01-01', 2.5, '2026-04-23 15:14:07', NULL),
(82, 967998, 'Conspiração Fatal', '', '/zpj3nNoc5xaUZTIdnuhwXwUcRag.jpg', '/yQUTEvEb5pJi0BH3b1biQRpGvEx.jpg', '2022-05-26', 5.5, '2026-04-23 15:14:10', NULL),
(83, 1416391, 'टोस्टर', '', '/cbYyWHc1dL1bfwEJbaMYDYKgWG2.jpg', '/3gI8gS7YIpmEzUehg3cZVQ62phl.jpg', '2026-04-15', 5.3, '2026-04-23 15:14:11', NULL),
(84, 77338, 'Những Kẻ Bên Lề', 'Chỉ sau 7 ngày đầu được công chiếu, bộ phim Intouchables (Những kẻ bên lề) đã thu hút gần 2 triệu rưỡi lượt khán giả tại Pháp. Một thành tích khá bất ngờ vì phim này được cho ra mắt hầu như cùng một thời điểm với hai đối thủ nặng ký đến từ Hoa Kỳ là Bí mật của Kỳ lân (Steven Spielberg) và phiên bản mới của Ba chàng ngự lâm pháo thủ (Paul W.S Anderson). Để thành công, bộ phim Những kẻ bên lề chỉ dựa vào cốt truyện kịch bản, chứ không cần đến công nghệ ba chiều hay kỹ xảo điện toán. Tác phẩm này khai thác mạch phim tình cảm xã hội, nó lôi cuốn đông đảo khán giả vào phòng chiếu phim phần lớn vì bộ phim nắm bắt kịp thời thị hiếu của người xem. Vào lúc mà chính phủ Pháp lần lượt ban hành các ...', '/xSFPmpHEezDZjoc1pr7TUEerIr.jpg', '/cK070s3Qdn1Ib7Gq8RgIyJKgvu3.jpg', '2011-11-02', 8.3, '2026-04-23 15:14:12', 'dvdJ--DV0Uo'),
(85, 1246049, 'Dracula: Bản Tình Ca Bất Diệt', 'Một hoàng tử tuyệt vọng biến thành Dracula và lang thang bất tận qua thời gian, sống chỉ vì lời hứa tìm lại tình yêu của đời mình.', '/hCKkybW6EfSZoOW3xia9ZsQwaUd.jpg', '/be5SIsRGMckO8tU9lrLcIik70Dy.jpg', '2025-07-30', 7.1, '2026-04-23 15:14:13', 'hverb7siYJ8'),
(86, 1306368, 'Ranh giới tội ác', 'Lòng tin rạn nứt khi đội cảnh sát Miami phát hiện thấy hàng triệu đô la tiền mặt bên trong một nhà chứa đồ đổ nát, khiến mọi người – và mọi thứ – bị đặt vào vòng nghi vấn.', '/6xL4Ei29kVIR8BXYyTAVMsggs87.jpg', '/3F2EXWF1thX0BdrVaKvnm6mAhqh.jpg', '2026-01-13', 7.1, '2026-04-23 15:14:14', 'yeR5bcbRPak'),
(87, 181808, 'Chiến Tranh Giữa Các Vì Sao: Phần VIII - Jedi Cuối Cùng', 'Sau khi bị người học trò Ben Solo/ Kylo Ren phản bội, toàn bộ nỗ lực tạo dựng lại đội quân những Hiệp sĩ Jedi của Luke Skywalker hoàn toàn sụp đổ. Luke biến mất khỏi vũ trụ và sống một cuộc đời ẩn sĩ trên hành tinh Ahch-To. Tuy nhiên,giờ đây người anh hùng huyền thoại buộc phải lộ mặt, khi phe Quân Kháng Chiến cần ông trở thành người lãnh đạo để chống lại sức mạnh của Tổ Chức Thứ Nhất.', '/5VhBECaiT2hRGHdCdGbwjSEAwR4.jpg', '/bIUaCtWaRgd78SnoHJDI8TNf7Sd.jpg', '2017-12-13', 6.8, '2026-04-23 15:14:15', 'Q0CbN8sfihY'),
(88, 533535, 'Deadpool và Wolverine', 'Wade Wilson, chán nản, đang cố gắng sống cuộc đời bình thường sau những ngày làm lính đánh thuê không mấy lương thiện, Deadpool. Nhưng khi quê hương của anh đứng trước nguy cơ diệt vong, Wade buộc phải khoác lại bộ đồ một lần nữa, cùng với một Wolverine còn miễn cưỡng hơn.', '/lfY2CfmxyN9OvxmFuap6aejViJn.jpg', '/ufpeVEM64uZHPpzzeiDNIAdaeOD.jpg', '2024-07-24', 7.6, '2026-04-23 15:14:16', 'Idh8n5XuYIA'),
(89, 1424965, 'Ice Skater', '', '/m93BKabB7Je8WQACed58BXeHNNR.jpg', '/6xVAbjvUWKJlPSVYduQgkRzEQNy.jpg', '2026-02-24', 4.4, '2026-04-23 15:14:18', 'ShXeLbwaZLw'),
(90, 252969, 'Secret Pleasures', '', '/j0Qu5opplDTot70kMqVqzURFXHY.jpg', NULL, '2002-10-15', 2.6, '2026-04-23 15:14:19', NULL),
(91, 744275, 'Từ Khi Chúng Ta Tan Vỡ', 'Tessa và Hardin yêu nhau hơn bao giờ hết. Nhưng trước những bí mật còn giấu kín và lời hứa còn dang dở, chỉ tình yêu thôi thì chưa đủ để cùng xây đắp tương lai.', '/dU4HfnTEJDf9KvxGS9hgO7BVeju.jpg', '/mxdiaM2tsx8M6W3zLgiPwAkhQfq.jpg', '2021-09-01', 7.0, '2026-04-23 15:14:20', 'NYdNN6C9hfI'),
(92, 1314481, 'Yêu Nữ Thích Hàng Hiệu 2', '', '/4qpxv3OrwOlMHumVI7Zco3zzGaF.jpg', '/Af907x5h9W1wVis8XrSd7ynTWuy.jpg', '2026-04-29', 7.5, '2026-04-23 15:14:21', 'PMd1at7OwiE'),
(93, 50619, 'Chạng Vạng: Hừng Đông - Phần 1', 'Hừng Đông Phần 1 mở đầu khi sau nhiều khó khăn cách trở cuối cùng Bella và Edward cũng đến được với nhau bằng một đám cưới hạnh phúc nhưng \"ngày vui ngắn chẳng tày gang\" khi Bella có thai, sinh mạng mang nửa dòng máu người và nửa dòng máu Ma cà rồng. Đặc biệt cái thai này còn gây nguy hiểm tới tính mạng của Bella và cả gia tộc Ma cà rồng.', '/qzfWlrVAC59EsMwQ71Ke8c62Qn4.jpg', '/hBwDYiOPwXHuwiYGP82ekFNSeBr.jpg', '2011-11-16', 6.2, '2026-04-23 15:14:22', 'PQNLfo-SOR4'),
(94, 27205, 'Kẻ Cắp Giấc Mơ', 'Cobb đánh cắp thông tin từ các mục tiêu của mình bằng cách đi vào giấc mơ của họ. Saito đề nghị xóa sạch tiền án của Cobb như một khoản thanh toán cho việc thực hiện hành vi đầu tiên đối với con trai của đối thủ cạnh tranh ốm yếu của mình.', '/eBtqGWtR5KUiNl6OXHLR3ri6nVm.jpg', '/8ZTVqvKDQ8emSGUEMjsS4yHAwrp.jpg', '2010-07-15', 8.4, '2026-04-23 15:14:23', 'cdx31ak4KbQ'),
(95, 19995, 'Avatar', 'Avatar là câu chuyện về người anh hùng “bất đắc dĩ” Jake Sully – một cựu sĩ quan thủy quân lục chiến bị liệt nửa thân. Người anh em sinh đôi của anh được chọn để tham gia vào chương trình cấy gien với người ngoài hành tinh Na’vi nhằm tạo ra một giống loài mới có thể hít thở không khí tại hành tinh Pandora. Giống người mới này được gọi là Avatar. Sau khi anh của Jake bị giết, Jake được chọn để thay thế anh mình và đã trở thành một Avatar, Jake có nhiệm vụ đi tìm hiểu và nghiên cứu hành tinh Pandora. Những thông tin mà anh thu thập được rất có giá trị cho chiến dịch xâm chiếm hành tinh xanh thứ hai này của loài người.', '/bxp5IUY05jLGeZ5bW85W2NF6Rgi.jpg', '/vL5LR6WdxWPjLPFRLe133jXWsh5.jpg', '2009-12-16', 7.6, '2026-04-23 15:14:24', '01PsgBXFuqA'),
(96, 1339876, 'Mardaani 3', 'Nữ cảnh sát Shivani Shivaji Roy trở lại để truy tìm những kẻ đứng sau vụ mất tích của các cô gái trẻ, bất chấp mọi rủi ro để đưa họ trở về an toàn.', '/dHxLBtHw4InwsVumnthupZYz6NM.jpg', '/pfcyWSaPKGagqdunfBXQYCqZHxx.jpg', '2026-01-30', 7.3, '2026-04-23 15:14:25', 'V4TJKSEftkU');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `search_history`
--

CREATE TABLE `search_history` (
  `search_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `searched_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `role` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `comment_history`
--
ALTER TABLE `comment_history`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `fk_comment_user` (`user_id`);

--
-- Chỉ mục cho bảng `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tmdb_id` (`tmdb_id`);

--
-- Chỉ mục cho bảng `search_history`
--
ALTER TABLE `search_history`
  ADD PRIMARY KEY (`search_id`),
  ADD KEY `fk_search_user` (`user_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `comment_history`
--
ALTER TABLE `comment_history`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT cho bảng `search_history`
--
ALTER TABLE `search_history`
  MODIFY `search_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `comment_history`
--
ALTER TABLE `comment_history`
  ADD CONSTRAINT `fk_comment_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `search_history`
--
ALTER TABLE `search_history`
  ADD CONSTRAINT `fk_search_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
