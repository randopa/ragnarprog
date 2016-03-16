<?php
     

     date_default_timezone_set('Europe/Tallinn');
     ini_set('display_errors',1);
     error_reporting(E_ALL);
     

     function createUser($data) {
              $name = $data["name"];
              $phone = $data["phone"];
              $gender = $data["gender"];
              $comment = $data["comment"];
              $file = $data["displayPicture"];
              $homeFolder = "./userID";
              $userFolder = glob($homeFolder . "/*", GLOB_ONLYDIR);
              if (count($userFolder) != 0) {
                     $folderCreate = "";
                     foreach ($userFolder as $folder) {
                           if (basename($folder) > $folderCreate)
                           {
                           $folderCreate = basename($folder);
                           }
                     }
                     $id = $folderCreate + 1;
              }
              else { 
                     $id = 0;
              }
              $folder = 'userID/'.$id;
              if ( !file_exists($folder) ){
                     $perm = umask(0);
                     mkdir ($folder, 0777, true);
                     umask($perm);
              } 
            
              

              $time = time();
              $data = fopen($folder.'/userData.json','w');
              $userData[] = array(
              "id" => $id,
              "name" => $name,
              "phone" => $phone,
              "gender" => $gender,
              "comment" => $comment,
              "time" => $time);
              move_uploaded_file($file, $folder.'/displayPicture.jpg');
              fwrite($data, json_encode($userData));
              fclose($data);
              }
  




  function editUser($data) {
              $id = $data["id"];
              $name = $data["name"];
              $phone = $data["phone"];
              $gender = $data["gender"];
              $comment = $data["comment"];
              $time =time();
              $file = $data["displayPicture"];     
              
              $homeFolder = "./userID/$id";
              $data = fopen($homeFolder.'/userData.json','w');
              $userData[] = array(
                      "id" => $id,
                      "name" => $name,
                      "phone" => $phone,
                      "gender" => $gender,
                      "comment" => $comment,
                      "time" => $time);
              move_uploaded_file($file, $homeFolder.'/displayPicture.jpg');
              fwrite($data, json_encode($userData));
              fclose($data);
              }




  function viewUser($id) {
            $dataPath = "./userID/$id/userData.json";
            $json = file_get_contents($dataPath);
            $data = json_decode($json, true);
            $data = $data[0];
            $data["time"] = strftime("%d/%m/%Y %H:%M", $data["time"]);
            return $data;
            
            }



  function userList() {
            $users = [];
            $i = 0;
    
            foreach (glob('./userID/*', GLOB_ONLYDIR) as $userID) {
                  $id = filter_var($userID, FILTER_SANITIZE_NUMBER_INT);
                  $users[$i] = display($id);
                  $i++;
            }
            return $users;
            }



  function deleteUser($id) {
            $homeFolder = "./userID/$id";
            if (is_dir($homeFolder)) {
            $files = glob($homeFolder . "/*");
            foreach ($files as $file) {
              unlink($file);
            }
            rmdir($homeFolder);
            }
            }
?>