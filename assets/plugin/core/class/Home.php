<?php 
 if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])){
       header('Location: ../../404.html');
 }

class Home extends Users {

     public function usersNameId($username)
    {
        $mysqli= $this->database;
        $query= $mysqli->query("SELECT user_id FROM users WHERE username= '$username'");
        $row= $query->fetch_array();
        return $row;
    }

        public function userData($user_id)
    {
        $mysqli= $this->database;
        $query= $mysqli->query("SELECT * FROM users WHERE user_id= '{$user_id}' ");
        $row= $query->fetch_array();
        return $row;
    }
    
    public function uploadfoodFile($file)
    {

        $insertValuesSQL ="";
        $targetDir = DOCUMENT_ROOT.'/uploads/craft/';
        $allowTypes = array('jpg','png','jpeg','mp4','mp3', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt','docx', 'xlsx','xls','zip');
        
        foreach($file['name'] as $key => $value){
            // File upload path
            $fileName = basename($file['name'][$key]);
            $fileExt = explode('.', $fileName);
            $fileActualExt = strtolower(end($fileExt));

             $filenames = (strlen($fileName) > 10)? 
                     strtolower(date('Y').'_'.rand(10,1000).substr($fileName,0,4).".".$fileActualExt):
                     strtolower(date('Y').'_'.rand(10,1000).$fileName);

            $valued[] = $filenames;

            $targetFilePath = $targetDir.$filenames;
            
            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            if(in_array($fileType, $allowTypes)){
                // Upload file to server
                $fileTmpName = $file["tmp_name"];
                move_uploaded_file($fileTmpName[$key], $targetFilePath);
                // var_dump(move_uploaded_file($fileTmpName[$key], $targetFilePath));

            }
        }
        
        # Build the values
        $filenamedb = implode("=", $valued);
        return  $filenamedb;


    }
    
    public function addLike($user_id,$tweet_id,$get_id)
    {
        $mysqli= $this->database;
        $query= "UPDATE users SET likes_counts = likes_counts +1 WHERE user_id= $user_id ";
        $mysqli->query($query);
        $this->creates('likes',array('like_by' => $user_id ,'like_on' => $tweet_id));
    }

      public function unLike($user_id,$tweet_id, $get_id)
    {
        $mysqli= $this->database;
        $query= "UPDATE users SET likes_counts = likes_counts -1 WHERE user_id= $user_id ";
        $mysqli->query($query);

        $query= "DELETE FROM likes WHERE like_by = $user_id AND like_on = $tweet_id";
        $mysqli->query($query);

    }

      public function likes($user_id,$tweet_id)
    {
        $mysqli= $this->database;
        $query= "SELECT * FROM likes WHERE like_by = $user_id AND like_on = $tweet_id";
        $result= $mysqli->query($query);

        $fetchCountLikes= array();
        while ($row= $result->fetch_assoc()) {
             $fetchCountLikes[] = array(
            'like_id' => $row['like_id'],
            'like_by' => $row['like_by'],
            'like_on' => $row['like_on']
           );
        }
        foreach ($fetchCountLikes as $fetchLikes) {
            # code...
            return $fetchLikes; // Return the $contacts array
        }
    }

}

$home= new Home();


?>