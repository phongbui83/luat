		<?php
		error_reporting(0);
    // Multiple email account
		$emails = array(
			array(
				'no'		=> '1',
				'label' 	=> 'LV Havanvuong,
				'host' 		=> '{outlook.office365.com:993/tls}INBOX',
				'username' 	=> 'lv-havanvuong@chip1stop.com',
				'password' 	=> 'vanvuong10'
			),
			array(
				'no'		=> '2',
				'label' 	=> 'Bui The Phong',
				'host' 		=> '{imap.gmail.com:993/tls}INBOX',
				'username' 	=> 'viettelmediact2@gmail.com',
				'password' 	=> 'C,dinh@0711'
			)
			// bla bla bla ...
		);
				
		foreach ($emails as $email) {
			$read = imap_open($email['host'],$email['username'],$email['password']) or die('Cannot connect to yourdomain.com: ' . imap_last_error().'</div>');
			$array = imap_search($read,'ALL');
			if($array) {
				
				rsort($array);
				
								
				foreach($array as $result) {
					$overview = imap_fetch_overview($read,$result,0);																		
					$message = imap_body($read,$result,0);																		
					$reply = imap_headerinfo($read,$result,0);
				}
			}
