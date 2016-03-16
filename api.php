<?php
	date_default_timezone_set('Europe/Tallinn');
	
	ini_set('display_errors',1);
	error_reporting(E_ALL); 
	
	function create($userData) {
		$username = $userData["username"];
		$first_name = $userData["first_name"];
		$last_name = $userData["last_name"];
		$gender = $userData["gender"];
		$description = $userData["description"];
		$file = $userData["picture"];
		
		$homedir = "./db";
		$folders = glob($homedir . "/*", GLOB_ONLYDIR);
		if (count($folders) != 0) {        
			$folderlist = "";
			foreach ($folders as $folder) {
				if (basename($folder) > $folderlist)
				{
				$folderlist = basename($folder);
				}
			}
			$id = $folderlist + 1;
		}
		else {
			$id = 0;
		}
		$folder = 'db/'.$id;
		if ( !file_exists($folder) ){
			$old = umask(0);
			mkdir ($folder, 0777, true);
			umask($old);
		}
		$time = time();
		$userData = fopen($folder.'/form.json','w');
		$form[] = array(
		"id" => $id,
		"username" => $username,
		"first_name" => $first_name,
		"last_name" => $last_name,
		"gender" => $gender,
		"description" => $description,
		"time" => $time);
		move_uploaded_file($file, $folder.'/picture.jpg');
		fwrite($userData, json_encode($form));
		fclose($userData);
	}
	
	function edit($userData) {
		$id = $userData["id"];
		$username = $userData["username"];
		$first_name = $userData["first_name"];
		$last_name = $userData["last_name"];
		$gender = $userData["gender"];
		$description = $userData["description"];
		$time = strtotime(str_replace('/', '-', $userData["time"]));
		$file = $userData["picture"];
		$homedir = "./db/$id";
		$userData = fopen($homedir.'/form.json','w');
		$form[] = array(
			"id" => $id,
			"username" => $username,
			"first_name" => $first_name,
			"last_name" => $last_name,
			"gender" => $gender,
			"description" => $description,
			"time" => $time);
		move_uploaded_file($file, $homedir.'/picture.jpg');
		fwrite($userData, json_encode($form));
		fclose($userData);
	}
    
  function display($id) {
    $dataPath = "./db/$id/form.json";
    $json = file_get_contents($dataPath);
    $userData = json_decode($json, true);
	$userData = $userData[0];
    $userData["time"] = strftime("%d/%m/%Y %H:%M", $userData["time"]);
    return $userData;
  }
  
  function userList() {
    $users = [];
    $i = 0;
    
    foreach (glob('./db/*', GLOB_ONLYDIR) as $db) {
		$id = filter_var($db, FILTER_SANITIZE_NUMBER_INT);
		$users[$i] = display($id);
		$i++;
    }
    return $users;
  }
  function delete($id) {
    $homedir = "./db/$id";
    if (is_dir($homedir)) {
      $files = glob($homedir . "/*");
      foreach ($files as $file) {
        unlink($file);
      }
      rmdir($homedir);
    }
  }
?>