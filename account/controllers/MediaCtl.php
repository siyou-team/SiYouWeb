<?php if (!defined('ROOT_PATH'))
{
	exit('No Permission');
}

/**
 * @author     Xinze <xinze@live.cn>
 */
class MediaCtl extends Zero_AppController
{
	public function index()
	{
		if (!empty($_REQUEST['debug']))
		{
			$random = rand(0, intval($_REQUEST['debug']));
			if ($random === 0)
			{
				header("HTTP/1.0 500 Internal Server Error");
				exit;
			}
		}

		// 5 minutes execution time
		@set_time_limit(5 * 60);

		// Uncomment this one to fake upload time
		// usleep(5000);

		// Settings
		// $target_tmp_dir = ini_get("upload_tmp_dir") . DIRECTORY_SEPARATOR . "plupload";
		$target_tmp_dir = DATA_PATH . '/upload_tmp';
		$upload_dir     = DATA_PATH . '/upload';

		$cleanupTargetDir = false; // Remove old files
		$maxFileAge       = 5 * 3600; // Temp file age in seconds


		fb($_REQUEST);
		fb($_FILES);
		// Create target dir
		if (!file_exists($target_tmp_dir))
		{
			@mkdir($target_tmp_dir);
		}

		// Create target dir
		if (!file_exists($upload_dir))
		{
			@mkdir($upload_dir);
		}

		// Get a file name
		if (isset($_REQUEST["name"]))
		{
			$file_name_temp = s('name', null);
		}
		elseif (!empty($_FILES))
		{
			$file_name_temp = $_FILES["file"]["name"];
		}
		else
		{
			$file_name_temp = uniqid("file_");
		}

		$md5File = @file('md5list2.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		$md5File = $md5File ? $md5File : array();

		if (isset($_REQUEST["md5"]) && array_search($_REQUEST["md5"], $md5File) !== FALSE)
		{
			die('{"jsonrpc" : "2.0", "result" : null, "id" : "id", "exist": 1}');
		}

		// Chunking might be enabled
		$chunk  = i('chunk');
		$chunks = i('chunks');

		// Remove old temp files
		if ($cleanupTargetDir)
		{
			if (!is_dir($target_tmp_dir) || !$dir = opendir($target_tmp_dir))
			{
				die('{"jsonrpc" : "2.0", "error" : {"code": 100, "message": "Failed to open temp directory."}, "id" : "id"}');
			}

			while (($file = readdir($dir)) !== false)
			{
				$tmpfilePath = $target_tmp_dir . DIRECTORY_SEPARATOR . $file;

				// If temp file is current file proceed to the next
				if ($tmpfilePath == "{$file_tmp_path}.part")
				{
					continue;
				}

				// Remove temp file if it is older than the max age and is not the current file
				if (preg_match('/\.part$/', $file) && (filemtime($tmpfilePath) < time() - $maxFileAge))
				{
					@unlink($tmpfilePath);
				}
			}
			closedir($dir);
		}

		$data = array();

		//设置目录  分割上传, 上传到临时目录
		$p = '';
		switch (4)
		{
			case "1":
			{
				$p = date('Y/m/m');
				break;
			}
			case "2":
			{
				$p = date('Y/m');
				break;
			}
			case "3":
			{
				$p = date('Y');
				break;
			}
			default:
			{
				$p = date('Y/m/m');
				break;
			}
		}

		if ($chunks)
		{
			$file_web_dir = '/app/data/upload_tmp' . '/' . $file_name_temp ;
			$file_dir = ROOT_PATH . $file_web_dir;
		}
		else
		{
			$file_web_dir = '/app/data/upload';

			$file_web_dir = $file_web_dir . DIRECTORY_SEPARATOR . $p;
			$file_dir = ROOT_PATH . $file_web_dir;
		}

		if (!file_exists($file_dir))
		{
			mkdir_r($file_dir);
		}

		if (!empty($_FILES))
		{
			if (isset($_FILES['file']))
			{
				//处理上传logo
				$upload = new HTTP_Upload('en');
				$files  = $upload->getFiles();

				if (PEAR::isError($files))
				{
					/*
					if ($_FILES["file"]["error"] || !is_uploaded_file($_FILES["file"]["tmp_name"]))
					{
						die('{"jsonrpc" : "2.0", "error" : {"code": 103, "message": "Failed to move uploaded file."}, "id" : "id"}');
					}
					*/
					$data['msg'] = '用户上传错误';
					$flag = false;
				}
				else
				{
					foreach ($files as $key=>$file)
					{
						if ($file->isValid())
						{
							//分割上传, 上传到临时目录
							if ($chunks)
							{
								$file_name = $file->setName($file_name_temp . '.part.' . $chunk);
							}
							else
							{
								$file_name = $file->setName('uniq');
							}

							$file_name = $file->moveTo($file_dir);
							fb($file_name);

							if (PEAR::isError($file_name))
							{
								$flag = false;
								$data[$key]['msg'] = $file->getMessage();
							}
							else
							{
								$data[$key]['attachment_mime_type'] = $file->upload['type']; // 上传的附件类型

								$data[$key]['mime']    = $file->upload['type'];
								$data[$key]['type']    = 'image';
								//$data[$key]['subtype'] = $file->upload['upload'];

								//
								fb($file_dir . '/' . $file_name);
								$url =  Zero_Registry::get('base_url') . $file_web_dir . DIRECTORY_SEPARATOR . $file->upload['name'];
								fb($url);
							}
						}
						else
						{
							$flag = false;
							$data[$key]['msg'] = '用户发生错误' . $_FILES['upload']['name'];
						}
					}
				}
			}
		}
		else
		{
			/*
			if (!$in = @fopen("php://input", "rb"))
			{
				die('{"jsonrpc" : "2.0", "error" : {"code": 101, "message": "Failed to open input stream."}, "id" : "id"}');
			}

			// Open temp file
			if (!$out = @fopen("{$file_tmp_path}.part", $chunks ? "ab" : "wb"))
			{
				die('{"jsonrpc" : "2.0", "error" : {"code": 102, "message": "Failed to open output stream."}, "id" : "id"}');
			}


			while ($buff = fread($in, 4096))
			{
				fwrite($out, $buff);
			}

			@fclose($out);
			@fclose($in);
			*/
		}

		// Check if all files has been uploaded,   合并文件
		if ($chunks)
		{
			$ext_row = pathinfo($file_name_temp);
			$file_web_dir = '/app/data/upload';
			$file_web_dir = $file_web_dir . DIRECTORY_SEPARATOR . $p;
			$file_upload_dir = ROOT_PATH . $file_web_dir;

			if (!file_exists($file_upload_dir))
			{
				mkdir_r($file_upload_dir);
			}

			$file_upload_path = $file_upload_dir . DIRECTORY_SEPARATOR . uniqid() . '.' . $ext_row['extension'];

			//异步,读取重复了....
			/*
			$cdir = scandir($file_dir);

			if ($chunks == count($cdir)-2)
			{
				foreach ($cdir as $key => $value)
				{
					$f = $file_dir . DIRECTORY_SEPARATOR . $value;

					if (!is_dir($f))
					{
						file_put_contents($file_upload_path, file_get_contents(f), FILE_APPEND);
					}
				}
			}
			*/
		}
		else
		{
			fb($data);
		}
		// Return Success JSON-RPC response
		die('{"jsonrpc" : "2.0", "result" : null, "id" : "id"}');
	}
}

?>