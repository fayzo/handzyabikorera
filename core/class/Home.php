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
        $targetDir = DOCUMENT_ROOT.'/uploads/food/';
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

            $targetFilePath = $targetDir . $filenames;
            
            // Check whether file type is valid
            $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
            if(in_array($fileType, $allowTypes)){
                // Upload file to server
                $fileTmpName = $file["tmp_name"];
                move_uploaded_file($fileTmpName[$key], $targetFilePath);
            }
        }
        
        # Build the values
        $filenamedb = implode("=", $valued);
        return  $filenamedb;


    }

    // THIS IS ON FOR THE MAIN HOME IT HAVE NAVBAR AS BLACK 
    public function craftList_homeNavbarblack($categories,$pages,$user_id){ ?>

                
        <div class="property-nav">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <nav class="main-menu">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="javascript:void(0)" onclick="craftCategories('Apartment_For_sale',1,<?php echo $user_id ; ?>);">Feature<span class="badge badge-primary"><?php echo $this->craftcountPOSTS('Apartment_For_sale');?></span></a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="javascript:void(0)" onclick="craftCategories('Apartment_For_sale',1,<?php echo $user_id ; ?>);">Arts<span class="badge badge-primary"><?php echo $this->craftcountPOSTS('Apartment_For_sale');?></span></a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="javascript:void(0)" onclick="craftCategories('Apartment_For_sale',1,<?php echo $user_id ; ?>);">Wood Craft<span class="badge badge-primary"><?php echo $this->craftcountPOSTS('Apartment_For_sale');?></span></a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="javascript:void(0)" onclick="craftCategories('Land_For_sale',1,<?php echo $user_id ; ?>);">Homeware<span class="badge badge-primary"><?php echo $this->craftcountPOSTS('Land_For_sale');?></span></a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="javascript:void(0)"  onclick="craftCategories('House_For_sale',1,<?php echo $user_id ; ?>);">Jewellery<span class="badge badge-primary"><?php echo $this->craftcountPOSTS('House_For_sale');?></span></a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="javascript:void(0)" onclick="craftCategories('House_For_rent',1,<?php echo $user_id ; ?>);">Clothing<span class="badge badge-primary"><?php echo $this->craftcountPOSTS('House_For_rent');?></span></a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="javascript:void(0)" onclick="craftCategories('Land_For_sale',1,<?php echo $user_id ; ?>);">Shoes<span class="badge badge-primary"><?php echo $this->craftcountPOSTS('Land_For_sale');?></span></a></li>
                                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="javascript:void(0)" onclick="craftCategories('Land_For_sale',1,<?php echo $user_id ; ?>);">Accessories<span class="badge badge-primary"><?php echo $this->craftcountPOSTS('Land_For_sale');?></span></a></li>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
        </div>

    <?php }

        
    public function craftcountPOSTS($categories)
    {
        // $db =$this->database;
        // $sql= $db->query("SELECT COUNT(*) FROM house WHERE categories_house ='$categories' ");
        // $row_post = $sql->fetch_array();
        // $total_post= array_shift($row_post);
        // $array= array(0,$total_post);
        // $total_posts= array_sum($array);
        // echo $total_posts;
        echo 43;
    }

}

$home= new Home();


?>