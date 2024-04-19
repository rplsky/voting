<?php
	//include 'phpmailer/PHPMailerAutoload.php';

	ob_start();

		// Import PHPMailer classes into the global namespace
		// These must be at the top of your script, not inside a function
		
	function kirim_email($email, $nama, $isipesan, $id_rapat){
		$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
		try {
		    //Server settings
		    $mail->SMTPDebug = 2;                                 // Enable verbose debug output
		    $mail->isSMTP();                                      // Set mailer to use SMTP
		    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		    $mail->SMTPAuth = true;                               // Enable SMTP authentication
		    $mail->Username = 'cvmoderapadalarang@gmail.com';                 // SMTP username
		    $mail->Password = 'modera@pdl';                           // SMTP password
		    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		    $mail->Port = 587;                                    // TCP port to connect to

			
		    //Recipients
		    $mail->setFrom('cvmoderapadalarang@gmail.com', 'CV. Modera');
		    $mail->addAddress($email, $nama);

		    //Attachments File
			//$mail->addAttachment($file, $id_rapat.'.pdf');    // Optional name

		    //Content
		    $mail->isHTML(true);                                  // Set email format to HTML
		    $mail->Subject = 'Undangan Rapat';
		    $mail->Body    = $isipesan;
		    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

		    if($mail->send()){
		    	return $status = true;
		    } else{
		    	return $status = false;
		    }
		} catch (Exception $e) {
		    
		}
	}

	function tanggal_indo($tanggal, $cetak_hari = false){
		$hari = array ( 1 =>    'Senin',
					'Selasa',
					'Rabu',
					'Kamis',
					'Jumat',
					'Sabtu',
					'Minggu'
				);
				
		$bulan = array (1 =>   'Januari',
					'Februari',
					'Maret',
					'April',
					'Mei',
					'Juni',
					'Juli',
					'Agustus',
					'September',
					'Oktober',
					'November',
					'Desember'
				);
		$split 	  = explode('-', $tanggal);
		$tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
		
		if ($cetak_hari) {
			$num = date('N', strtotime($tanggal));
			return $hari[$num] . ', ' . $tgl_indo;
		}
		return $tgl_indo;
	}
	function print_undangan ($id_rapat, $tgl_skrang, $nama, $tgl_rapat, $waktu_mulai, $waktu_selesai, $judul_rapat, $tempat){
		$document = file_get_contents("undangan_rapat.rtf");

		// isi dokumen dinyatakan dalam bentuk string
		$document = str_replace("#id_rapat", $id_rapat, $document);
		$document = str_replace("#tgl_skrang", tanggal_indo($tgl_skrang), $document);
		$document = str_replace("#penerima", $nama, $document);
		$document = str_replace("#tgl_rapat", tanggal_indo($tgl_rapat, true), $document);
		$document = str_replace("#wmulai", $waktu_mulai, $document);
		$document = str_replace("#wselesai", $waktu_selesai, $document);
		$document = str_replace("#judul", $judul_rapat, $document);
		$document = str_replace("#tempat", $tempat, $document);

		// header untuk membuka file output RTF dengan MS. Word
		/*header("Content-type: application/vnd.ms-word");
		header("Content-disposition: inline; filename=".$id_rapat.".doc");
		header("Content-length: ".strlen($document));*/
		return $document;
	}

	function compress_gambar($source_url, $quality) {
		$info = getimagesize($source_url);
	 
		if ($info['mime'] == 'image/jpeg') $gambar = imagecreatefromjpeg($source_url);
		elseif ($info['mime'] == 'image/gif') $gambar = imagecreatefromgif($source_url);
		elseif ($info['mime'] == 'image/png') $gambar = imagecreatefrompng($source_url);
	 
		imagejpeg($gambar, $source_url, $quality);
		return $source_url;
	}

	function KirimTelegram($pesan, $bot, $chat)
	{
		$url = 'https://api.telegram.org/'.$bot.'/sendMessage?chat_id='.$chat.'&text='.$pesan.'&parse_mode=html';
		$kirim = file_get_contents($url, true);

		return $kirim;
	}
?>