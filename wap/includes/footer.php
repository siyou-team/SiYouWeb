<?php 

$data = ob_get_contents();
ob_clean();
echo preg_replace_callback('|.*</head>|',function()use($header){
			
			return $header.'</head>';
			
		}, $data);

 