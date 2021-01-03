<?php 
 if ($_SERVER['REQUEST_METHOD'] == 'GET' && realpath(__FILE__) == realpath($_SERVER['SCRIPT_FILENAME'])){
       header('Location: ../../404.html');
 }

class Users extends Db{

    protected $database;
    static protected $databases;

    static public function getconstruct($db)
    {   
       return self::$databases= $db;
    }

    public function __construct()
    {
        global $db;
        $this->database=$db;
    }

    public function preventUsersAccess($request,$currentfile,$currently)
    {
       if ($request == 'GET' && $currentfile == $currently) {
            header('Location: '.F_INDEX.'');
        }
    }
    
    public function login($email,$password,$datetime)
    {
       $mysqli= $this->database;
       $sql= $mysqli->query("SELECT user_id,username,approval,profile_img, chat,register_as,admin  FROM users WHERE username ='{$email}' AND password='{$password}' OR email ='{$email}'and password='{$password}' ");
       $sql1= $mysqli->query("SELECT user_id ,username,profile_img ,approval, chat,register_as,admin FROM users WHERE username ='{$email}' or email ='{$email}'");

        $row= $sql->fetch_assoc();
        $rows= $sql1->fetch_assoc();
    
        if ($sql->num_rows > 0) {
            $_SESSION['key_craft'] = $row['user_id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['approval'] = $row['approval'];
            $_SESSION['profile_img'] = $row['profile_img'];
            $_SESSION['chat'] = $row['chat'];
            $_SESSION['register_as'] = $row['register_as'];
            $_SESSION['admin'] = $row['admin'];
            
            $mysqli->query("UPDATE users SET counts_login= counts_login + 1 WHERE email='{$email}' AND password= '{$password}' OR username ='{$email}' AND password='{$password}' ");
            $mysqli->query("UPDATE users SET last_login = '{$datetime}'  WHERE email='{$email}' AND password= '{$password}' OR username ='{$email}' AND password='{$password}' ");
            $mysqli->query("UPDATE users SET chat = 'on'  WHERE email='{$email}' AND password= '{$password}' OR username ='{$email}' AND password='{$password}' ");
            exit ('<div class="alert alert-success alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>SUCCESS</strong> </div>');

        }else if($sql1->num_rows > 0){
            $_SESSION['keys'] = $rows['user_id'];
            $_SESSION['username'] = $rows['username'];
            $_SESSION['profile_img'] = $rows['profile_img'];
            $_SESSION['approval'] = $rows['approval'];
            $_SESSION['chat'] = $rows['chat'];
            $_SESSION['register_as'] = $row['register_as'];
            $_SESSION['admin'] = $row['admin'];
            exit ('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Fail Password</strong>
                </div>');

        }else{
            exit ('<div class="alert alert-danger alert-dismissible fade show text">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>TRY AGAIN !!! </strong>
                </div>');
        }
    }


    
    public function alreadyUseEmail($table,$arrayselects=array(),$conditions = array())
    {
        $mysqli= $this->database;
        //  username Already Tooken
        $sql = 'SELECT ';
        $select="";
        $select= array_keys($arrayselects);
        $select = $select[0];
        $sql .= (!empty($select))?$select:'*';
        $sql .= ' FROM '.$table;
        $sql .= ' WHERE ';
        $condition= $conditions;
        $condition = array_diff_key($condition, [
            'firstname' => 'firstname', 
            'lastname' => 'lastname', 
            'email' => 'email', 
            'password' => 'password', 
            'register_as' => 'register_as', 
            'date_registry' => 'date_registry', 
            'last_login' => 'datetime', 
            'approval' => 'off',
            ]);
        $i= 0;
        foreach($condition as $key => $value){
             $pre = ($i > 0)?' OR ':'';
             $sql .= $pre.$key." = '".$value."'";
             $i++;
         }
         $query= $mysqli->query($sql);
         $row = $query->fetch_assoc();

         //  Email Already Tooken

        $sql1 = 'SELECT ';
        $select="";
        $select= array_keys($arrayselects);
        $select = $select[1];
        $sql1 .= (!empty($select))?$select:'*';
        $sql1 .= ' FROM '.$table;
        $sql1 .= ' WHERE ';
        $conditionz= $conditions;
        $conditionz = array_diff_key($conditionz, [
            'firstname' => 'firstname', 
            'lastname' => 'lastname', 
            'username' => 'username', 
            'register_as' => 'register_as', 
            'password' => 'password', 
            'date_registry' => 'date_registry', 
            'last_login' => 'datetime', 
            'approval' => 'off',  
            ]);
        $i= 0;
        foreach($conditionz as $key => $value){
             $pre = ($i > 0)?' OR ':'';
             $sql1 .= $pre.$key." = '".$value."'";
             $i++;
         }
         $querys= $mysqli->query($sql1);
         $rows = $querys->fetch_assoc();
        //  var_dump($sql);
        // $b= array_keys($conditions);
        // var_dump($conditions['username'][0]);
        // var_dump($b[0]);
        
        if(!empty($row['username'])){
             exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Username Already Tooken ???</strong> </div>');
        }else if(!empty($rows['email'])){
             exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Email Already Tooken ???</strong> </div>');
        }else{
             $this->Postsjobscreates('users',$conditions);
        }
    } 


    
    public function Postsjobscreates($table,$fields=array())
    {
        $mysqli= $this->database;
        function addQuotes($str){
            return "'$str'";
        }
         $valued = array();
        # Surround values by quotes
        foreach ($fields as $key => $value) {
            $valued[] = addQuotes($value);
        }
        
        # Build the column
        $columns = implode(",", array_keys($fields));
        
        # Build the values
        $values = implode(",", array_values($valued));
        # Build the insert query
        $queryl = "INSERT INTO $table (".$columns.") VALUES (".$values.")";
        $query= $mysqli->query($queryl);
        // var_dump('ERROR: Could not able to execute'. $query.mysqli_error($mysqli));

        if($query){
                exit('<div class="alert alert-success alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>SUCCESS</strong> </div>');
            }else{
                exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Fail input try again !!!</strong>
                </div>');
        }
    }

    
    public function creates($table,$fields=array())
    {
        $mysqli= $this->database;
        function addQuotes($str){
            return "'$str'";
        }
         $valued = array();
        # Surround values by quotes
        foreach ($fields as $key => $value) {
            $valued[] = addQuotes($value);
        }
        
        # Build the column
        $columns = implode(",", array_keys($fields));
        
        # Build the values
        $values = implode(",", array_values($valued));
        # Build the insert query
        $queryl = "INSERT INTO $table (".$columns.") VALUES (".$values.")";
        $query= $mysqli->query($queryl);

        // if($query){
        //         exit('<div class="alert alert-success alert-dismissible fade show text-center">
        //             <button class="close" data-dismiss="alert" type="button">
        //                 <span>&times;</span>
        //             </button>
        //             <strong>SUCCESS</strong> </div>');
        //     }else{
        //         exit('<div class="alert alert-danger alert-dismissible fade show text-center">
        //             <button class="close" data-dismiss="alert" type="button">
        //                 <span>&times;</span>
        //             </button>
        //             <strong>Fail input try again !!!</strong>
        //         </div>');
        // }
        $row= json_encode($mysqli->insert_id);
        // var_dump($queryl,$query);
        return $row;
    }

    static  public function createss($table,$fields=array())
    {
        $mysqli= self::$databases;

         $valued = array();
        # Surround values by quotes
        foreach ($fields as $key => $value) {
            $valued[] = "'$value'";
        }
        
        # Build the column
        $columns = implode(",", array_keys($fields));
        
        # Build the values
        $values = implode(",", array_values($valued));

        # Build the insert query
        $queryl = "INSERT INTO $table (".$columns.") VALUES (".$values.")" ;
        $query= $mysqli->query($queryl);
        $row= json_encode($mysqli->insert_id);
        // $query1= "DELETE FROM notification WHERE notification_id= $row AND type= 'retweet' ";
        // $mysqli->query($query1);

        // if($query){
        //         exit('<div class="alert alert-success alert-dismissible fade show text-center">
        //             <button class="close" data-dismiss="alert" type="button">
        //                 <span>&times;</span>
        //             </button>
        //             <strong>SUCCESS</strong> </div>');
        //     }else{
        //         exit('<div class="alert alert-danger alert-dismissible fade show text-center">
        //             <button class="close" data-dismiss="alert" type="button">
        //                 <span>&times;</span>
        //             </button>
        //             <strong>Fail input try again !!!</strong>
        //         </div>');
        // }
        
    }

    public function test_input($data)
    {
        $mysqli=$this->database;
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = $mysqli->real_escape_string($data);
        return $data;
    }

    public function userData($user_id)
    {
        $mysqli= $this->database;
        $query= $mysqli->query("SELECT * FROM users WHERE user_id= '{$user_id}' ");
        $row= $query->fetch_array();
        return $row;
    }

    public function businessData($user_id)
    {
        $mysqli= $this->database;
        $query= $mysqli->query("SELECT * FROM business_contact WHERE business_id= '{$user_id}' ");
        $row= $query->fetch_array();
        return $row;
    }

    public function forgotUsernameCountsTodelete($table,$fields=array(),$user_id)
    {
        $columns="";
        $i= 1;
        foreach ($fields as $key => $value) {
            # code...
            $columns .= "{$key} = {$value}";
            if ($i++ < count($fields)) {
                # code...
                 $columns .= ',';
            }
        }

        $mysqli= $this->database;
        $sql="UPDATE $table SET {$columns} WHERE user_id='$user_id'";
        $query= $mysqli->query($sql);
        var_dump($query);
    }

    
    public function loggedin()
    {
        if (isset($_SESSION['key_craft'])) {
            return true;
        }else {
            return false;
        }
    }

    
    public function update($table,$fields=array(),$conditions=array())
    {
       $mysqli= $this->database;
       $columns="";
       $column="";
       $select="";
       $i= 1;
       foreach ($fields as $key => $value) {
           # code...
           $columns .= "{$key} = '{$value}'";
           if ($i++ < count($fields)) {
               # code...
                $columns .= ',';
           }
       }

       $sql = "UPDATE ";
       $sql .= $table.' SET '.$columns;
       $sql .= ' WHERE ';
        $i = 0;
        foreach($conditions as $key => $value){
            $pre = ($i > 0)?' AND ':'';
              $sql .= $pre.$key." = '".$value."'";
            $i++;
        }

       $query= $mysqli->query($sql);
    //    var_dump($sql);
       $i= 1;
       foreach ($fields as $key => $value) {
           # code...
           $select .= "{$key}";
           if ($i++ < count($fields)) {
               # code...
                $select .= ',';
           }
       }
       $i= 1;
       foreach ($fields as $key => $value) {
           # code...
           $column .= "{$key} = '{$value}'";
           if ($i++ < count($fields)) {
               # code...
                $column .= 'AND ';
           }
       }
       $sql1 = 'SELECT ';
       $sql1 .= (!empty($select))?$select:'*';
       $sql1 .= ' FROM '.$table;
       $sql1 .= ' WHERE ';
       $i = 0;
        foreach($conditions as $key => $value){
            $pre = ($i > 0)?' AND ':'';
              $sql1 .= $pre.$key." = '".$value."'";
            $i++;
        }

       $query1= $mysqli->query($sql1);
       $row = $query1->fetch_assoc();
       if($row){
               exit('<div class="alert alert-success alert-dismissible fade show text-center">
                   <button class="close" data-dismiss="alert" type="button">
                       <span>&times;</span>
                   </button>
                   <strong>SUCCESS</strong> </div>');
           }else{
               exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                   <button class="close" data-dismiss="alert" type="button">
                       <span>&times;</span>
                   </button>
                   <strong>Fail input try again !!!</strong>
               </div>');
       }
   }

    
    public function updateReal($table,$fields=array(),$conditions=array())
     {
        $mysqli= $this->database;
        $columns="";
        $i= 1;
        foreach ($fields as $key => $value) {
            # code...
            $columns .= "{$key} = '{$value}'";
            if ($i++ < count($fields)) {
                # code...
                 $columns .= ',';
            }
        }

        $sql = "UPDATE ";
        $sql .= $table.' SET '.$columns;
        $sql .= ' WHERE ';
         $i = 0;
         foreach($conditions as $key => $value){
             $pre = ($i > 0)?' AND ':'';
               $sql .= $pre.$key." = '".$value."'";
             $i++;
         }

        $query= $mysqli->query($sql);
        // var_dump('ERROR: Could not able to execute'. $query.mysqli_error($mysqli));

        // var_dump($sql);
         if($query){
                exit('<div class="alert alert-success alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>SUCCESS</strong> </div>');
            }else{
                exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Fail input try again !!!</strong>
                </div>');
        }
    }

    
    public function runQuery($query) {
        $mysqli= $this->database;
		$result = $mysqli->query($query);
		while($row=$result->fetch_assoc()) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}
	
	public function numRows($query) {
		$mysqli= $this->database;
		$result = $mysqli->query($query);
		$rowcount = $result->num_rows;
		return $rowcount;	
    }
    
    public function updateQuery($table, $data, $conditions){
		    $mysqli= $this->database;
            $colvalSet = '';
            $whereSql = '';
            $i = 0;
            // if(!array_key_exists('modified',$data)){
            //     $data['modified'] = date("Y-m-d H:i:s");
            // }
            foreach($data as $key=>$val){
                $pre = ($i > 0)?', ':'';
                $colvalSet .= $pre.$key."='".$val."'";
                $i++;
            }
            if(!empty($conditions)&& is_array($conditions)){
                $whereSql .= ' WHERE ';
                $i = 0;
                foreach($conditions as $key => $value){
                    $pre = ($i > 0)?' AND ':'';
                    $whereSql .= $pre.$key." = '".$value."'";
                    $i++;
                }
            }
            $query = "UPDATE ".$table." SET ".$colvalSet.$whereSql;
            $update = $mysqli->query($query);
            // return $update?$mysqli->affected_rows:false;
            //  var_dump($update);
            //  var_dump($query);

    }

    public function insertQuery($table,$fields=array())
    {
        $mysqli= $this->database;
        function addQuotes($str){
            return "'$str'";
        }
         $valued = array();
        # Surround values by quotes
        if(!array_key_exists('modified',$fields)){
            $fields['modified'] = date("Y-m-d H:i:s");
            }
        foreach ($fields as $key => $value) {
            $valued[] = addQuotes($value);
        }
        
        # Build the column
        $columns = implode(",", array_keys($fields));
        
        # Build the values
        $values = implode(",", array_values($valued));
        # Build the insert query
        $queryl = "INSERT INTO $table (".$columns.") VALUES (".$values.")";
        $query= $mysqli->query($queryl);
        // var_dump( $queryl );
    }

    public function delete($table, $conditions){
        $mysqli= $this->database;
        $whereSql = '';
        if(!empty($conditions) && is_array($conditions)){
            $whereSql .= ' WHERE ';
            $i = 0;
            foreach($conditions as $key => $value){
                $pre = ($i > 0)?' AND ':'';
                $whereSql .= $pre.$key." = '".$value."'";
                $i++;
            }
        }
        $query = "DELETE FROM ".$table.$whereSql;
        $delete = $mysqli->query($query);
        // return $delete?true:false;
        // var_dump( $delete );
    }

    public function timeAgo($datetime)
    {
        $time= strtotime($datetime);
        $current= time($datetime);
        $second= $current - $time;
        $minute= round($second / 60);
        $hour= round($second / 3600);
        $week= round($second / 86400);
        $month= round($second / 2600640);

        $date = date('d/m/Y', $time);

        $Date  = date('Y-m-d', $time);
        $now  = date('Y-m-d');
        $datetime1 = new DateTime($Date);
        $datetime2 = new DateTime($now);
        $interval = $datetime1->diff($datetime2);
        // $interval->format('%R%a days');

        if ($second <= 60) {
            # code...
             if ($second == 0 ) {
                 # code...
                 return 'now'; 
              }else {
                  # code...
                  return $second.'s ago'; 
              }

        }elseif ($minute <= 60) {
            # code...
             return $minute.'m ago'; 
        }elseif ($hour <= 24 ) {
            # code...
             return $hour.'h ago'; 

        }elseif ($week == 1 ) {
            # code...
             return  'yesterday'; 
        }elseif ($week <= 7) {
            # code...
             return  $interval->format('%a days').' ago'; 
        }elseif ($month <= 12) {
            # code...
             return date('M j',$time); 

        }else { 
            # code...
             return date('M j, Y',$time); 
        }
        
    }

    
    public function UserEmailalreadyTookenSettings($table,$arrayselects=array(),$conditions = array())
    {
        $mysqli= $this->database;
        //  username Already Tooken
        $sql = 'SELECT ';
        $select="";
        $select= array_keys($arrayselects);
        $select = $select[0];
        $sql .= (!empty($select))?$select:'*';
        $sql .= ' FROM '.$table;
        $sql .= ' WHERE ';
        $condition= $conditions;
        $condition = array_diff_key($condition, [
            'email' => 'email', 
            ]);
        $i= 0;
        foreach($condition as $key => $value){
             $pre = ($i > 0)?' OR ':'';
             $sql .= $pre.$key." = '".$value."'";
             $i++;
         }
         $query= $mysqli->query($sql);
         $row = $query->fetch_assoc();

         //  Email Already Tooken

        $sql1 = 'SELECT ';
        $select="";
        $select= array_keys($arrayselects);
        $select = $select[1];
        $sql1 .= (!empty($select))?$select:'*';
        $sql1 .= ' FROM '.$table;
        $sql1 .= ' WHERE ';
        $conditionz= $conditions;
        $conditionz = array_diff_key($conditionz, [
            'username' => 'username', 
            ]);
        $i= 0;
        foreach($conditionz as $key => $value){
             $pre = ($i > 0)?' OR ':'';
             $sql1 .= $pre.$key." = '".$value."'";
             $i++;
         }
         $querys= $mysqli->query($sql1);
         $rows = $querys->fetch_assoc();
        //  var_dump($sql1);
        // $b= array_keys($conditions);
        // var_dump($conditions['username'][0]);
        // var_dump($b[0]);
        
        if(!empty($row['username'])){
             exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Username Already Tooken ???</strong> </div>');
        }else if(!empty($rows['email'])){
             exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                    <button class="close" data-dismiss="alert" type="button">
                        <span>&times;</span>
                    </button>
                    <strong>Email Already Tooken ???</strong> </div>');
        }else{
              $this->update($table,$conditions,$id);
        }
    } 

    public function forgotUsernameCountsTimesHeCreatespassword($table,$fields=array(),$user_id)
    {
        $columns="";
        $i= 1;
        foreach ($fields as $key => $value) {
            # code...
            $columns .= "{$key} = {$value}";
            if ($i++ < count($fields)) {
                # code...
                 $columns .= ',';
            }
        }

         $mysqli= $this->database;
        $sql="UPDATE $table SET {$columns} WHERE user_id='$user_id'";
        $query= $mysqli->query($sql);
    }

    public function checkPassword($password)
    {
        $mysqli= $this->database;
        $query= $mysqli->query("SELECT password FROM users WHERE password= '$password' ");
        $count=$query->num_rows;
        if ($count > 0) {
            return true;
        }else {
            return false;
        }
    }
            
    public function countUSERS()
    {
        $db =$this->database;
        $sql= $db->query('SELECT COUNT(*) FROM users');
        $row_users = $sql->fetch_array();
        $total_user= array_shift($row_users);
        $array= array(0,$total_user);
        $total_users= array_sum($array);
        echo $total_users;
    }

    public function countPOSTS()
    {
        $db =$this->database;
        $sql= $db->query('SELECT COUNT(*) FROM food');
        $row_post = $sql->fetch_array();
        $total_post= array_shift($row_post);
        $array= array(0,$total_post);
        $total_posts= array_sum($array);
        echo $total_posts;
    }

    public function countPost_food()
    {
        $db =$this->database;
        $sql= $db->query('SELECT COUNT(*) FROM food WHERE categories_food = "food" ');
        $row_comment = $sql->fetch_array();
        $total_comment= array_shift($row_comment);
        $array= array(0,$total_comment);
        $total_comments= array_sum($array);
        echo $total_comments;
    }

    public function countPost_beverage()
    {
        $db =$this->database;
        $sql= $db->query('SELECT COUNT(*) FROM food WHERE categories_food = "drink" ');
        $row_comment = $sql->fetch_array();
        $total_comment= array_shift($row_comment);
        $array= array(0,$total_comment);
        $total_comments= array_sum($array);
        echo $total_comments;
    }

    public function countPost_fruits()
    {
        $db =$this->database;
        $sql= $db->query('SELECT COUNT(*) FROM food WHERE categories_food = "fruits" ');
        $row_comment = $sql->fetch_array();
        $total_comment= array_shift($row_comment);
        $array= array(0,$total_comment);
        $total_comments= array_sum($array);
        echo $total_comments;
    }

    
    function Users_usage_dashboard($usage){
        if($usage == 0){
            $variable = 1;
        }else{
            $variable = $usage;
        }

    switch ($variable) {
        case $variable <= 100 :
            # code...
            return '<div class="progress-bar bg-danger" role="progressbar"
                    style="width: '.($variable * 100 / 1000).' %" aria-valuenow="'.($variable * 100 / 1000).'" aria-valuemin="0"
                    aria-valuemax="100">'.($variable * 100 / 1000).'%</div>';
            break;
        case $variable <= 200 :
            # code...
            return '<div class="progress-bar bg-danger" role="progressbar"
                    style="width: '.($variable*100/1000).'%" aria-valuenow="'.($variable*100/1000).'" aria-valuemin="0"
                    aria-valuemax="100">'.($variable*100/1000).'%</div>';
            break;
        case $variable <= 300 :
            # code...
            return '<div class="progress-bar bg-danger" role="progressbar"
                    style="width: '.($variable*100/1000).'%" aria-valuenow="'.($variable*100/1000).'" aria-valuemin="0"
                    aria-valuemax="100">'.($variable*100/1000).'%</div>';
            break;
        case $variable <= 350:
            # code...
            return '<div class="progress-bar bg-warning" role="progressbar"
                    style="width: '.($variable*100/1000).'%" aria-valuenow="'.($variable*100/1000).'" aria-valuemin="0"
                    aria-valuemax="100">'.($variable*100/1000).'%</div>';
            break;
        case $variable <= 400:
            # code...
            return '<div class="progress-bar bg-info" role="progressbar"
                    style="width: '.($variable*100/1000).'%" aria-valuenow="'.($variable*100/1000).'" aria-valuemin="0"
                    aria-valuemax="100">'.($variable*100/1000).'%</div>';
            break;
        case $variable <= 500:
            # code...
            return '<div class="progress-bar bg-info" role="progressbar"
                    style="width: '.($variable*100/1000).'%" aria-valuenow="'.($variable*100/1000).'" aria-valuemin="0"
                    aria-valuemax="100">'.($variable*100/1000).'%</div>';
            break;
        case $variable <= 600:
            # code...
            return '<div class="progress-bar bg-info" role="progressbar"
                    style="width: '.($variable*100/1000).'%" aria-valuenow="'.($variable*100/1000).'" aria-valuemin="0"
                    aria-valuemax="100">'.($variable*100/1000).'%</div>';
            break;
        case $variable <= 750:
            # code...
            return '<div class="progress-bar bg-primary" role="progressbar"
                    style="width: '.($variable*100/1000).'%" aria-valuenow="'.($variable*100/1000).'" aria-valuemin="0"
                    aria-valuemax="100">'.($variable*100/1000).'%</div>';
            break;
        default:
            # code...
            return '<div class="progress-bar bg-success" role="progressbar"
                    style="width: '.($variable*100/1000).'%" aria-valuenow="'.($variable*100/1000).'" aria-valuemin="0"
                    aria-valuemax="100">'.($variable*100/1000).'%</div>';
            break;
        }
    } 

    public function lengths($date){
        if(strlen($date) == 11  || strlen($date) == 10) {
            return '<p class="btn btn-danger btn-sm">Old</p>';
        }else{
            return '<p class="btn btn-primary btn-sm">New</p>';
        }
    }

    public function convertNumberToWord($num = false){
        
        $num = str_replace(array(',', ' '), '' , trim($num));
        if(! $num) {
            return false;
        }
        $num = (int) $num;
        $words = array();
        $list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
            'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
        );
        $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
        $list3 = array('', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
            'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
            'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
        );
        $num_length = strlen($num);
        $levels = (int) (($num_length + 2) / 3);
        $max_length = $levels * 3;
        $num = substr('00' . $num, -$max_length);
        $num_levels = str_split($num, 3);
        for ($i = 0; $i < count($num_levels); $i++) {
            $levels--;
            $hundreds = (int) ($num_levels[$i] / 100);
            $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ' ' : '');
            $tens = (int) ($num_levels[$i] % 100);
            $singles = '';
            if ( $tens < 20 ) {
                $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
            } else {
                $tens = (int)($tens / 10);
                $tens = ' ' . $list2[$tens] . ' ';
                $singles = (int) ($num_levels[$i] % 10);
                $singles = ' ' . $list1[$singles] . ' ';
            }
            $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
        } //end for loop
        $commas = count($words);
        if ($commas > 1) {
            $commas = $commas - 1;
        }
        return implode(' ', $words);
    }

    
    public function nice_number($n) {
        // first strip any formatting;
        $n = (0+str_replace(",", "", $n));

        // is this a number?
        if (!is_numeric($n)) return false;

        // now filter it;
        if ($n > 1000000000000) return round(($n/1000000000000),PHP_ROUND_HALF_UP).' Trillion';
        elseif ($n > 1000000000) return round(($n/1000000000),PHP_ROUND_HALF_UP).' Billion';
        elseif ($n > 1000000) return round(($n/1000000),PHP_ROUND_HALF_UP).' Million';
        elseif ($n > 1000) return round(($n/1000),PHP_ROUND_HALF_UP).' Thousand';
        elseif ($n > 1000) return round(($n/100),PHP_ROUND_HALF_UP).' Hundred';
        // if ($n > 1000000000000) return round(($n/1000000000000), 2).' trillion';
        // elseif ($n > 1000000000) return round(($n/1000000000), 2).' billion';
        // elseif ($n > 1000000) return round(($n/1000000), 2).' million';
        // elseif ($n > 1000) return round(($n/1000), 2).' thousand';

        return number_format($n);
    }

}

$users= new Users();
global $db;
Users::getconstruct($db);

?>