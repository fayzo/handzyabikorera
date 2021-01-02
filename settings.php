<?php include "header_if_login.php"?>
<?php include "header.php"?>
    
<!-- <body> -->
<body >
<!-- <body class="chair"> -->
    <div class="content">
    <?php include "navbar.php"?>
    <!-- navbar -->
    

 <!-- Content Wrapper. Contains page content -->
 <div class="container mt-3 mb-5">
     <!-- Content Header (Page header) -->
     <section class="content-header">
         <div class="row mb-2">
             <div class="col-sm-6">
                 <h1><i class="fa fa-setting"></i>Settings</h1>
             </div>
             <div class="col-sm-6">
                 <ol class="breadcrumb float-sm-right">
                     <li class="breadcrumb-item"><a href="<?php echo HOME; ?>">Home</a></li>
                    <?php if(isset($_SESSION['key_food']) != 'buyer') { ?> 
                     <li class="breadcrumb-item active"><a href="<?php echo BASE_URL.$user['username'] ;?>">User profile </a></li>
                     <?php } ?>
                </ol>
             </div>
         </div>
     </section>

     <section class="content">
         <div class="row">

             <div class="col-md-3 mb-3">
                 <!-- Profile Image -->
                 <!-- < ?php echo $home->userProfile($user_id); ?> -->
             </div>
             <!-- /.col -->

             <div class="col-md-3 mb-3">
                 <div class="card">
                     <div class="card-body p-0">
                         <div class="list-group " id="list-tab" role="tablist">
                             <a class="list-group-item list-group-item-action active" id="list-Account-list"
                                 data-toggle="tab" href="#list-Account" role="tab" aria-controls="list-Account"><i
                                     class="fa fa-lock"></i> Account</a>
                             <a class="list-group-item list-group-item-action" id="list-Password-list" data-toggle="tab"
                                 href="#list-Password" role="tab" aria-controls="list-Password"><i
                                     class="fa fa-key"></i> Password</a>

                         </div>
                     </div>
                     <!-- /.card-body -->
                 </div>
                 <!-- /.card -->
             </div>
             <!-- /.col -->

             <div class="col-md-3 mb-3">

                 <div class="tab-content" id="nav-tabContent">
                     <div class="tab-pane fade show active" id="list-Account" role="tabpanel"
                         aria-labelledby="list-home-list">
                         <?php include "settings/account.php"?>
                     </div> <!-- END-OF A LINK OF inbox ID=#  -->
                     <div class="tab-pane fade " id="list-Password" role="tabpanel"
                         aria-labelledby="list-Password-list">
                         <?php include "settings/password.php"?>
                     </div> <!-- END-OF A LINK OF sent ID=#  -->

                 </div>
             </div>
             <!-- /.col -->

             <div class="col-md-3">
                 <!-- hastTag Me Box -->
                <!-- < ?php echo $home->jobsfetch() ;?> -->
             </div>
             <!-- /.col -->

         </div>
         <!-- /.row -->
     </section>
     <!-- /.content -->
 </div>
 <!-- /.container -->
 <?php include "footer.php"?>