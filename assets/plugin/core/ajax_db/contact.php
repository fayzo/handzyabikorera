<style>
.section-titles {
    text-align: left;
    margin-bottom: 10px;
}
</style>              

<?php
include('../init.php');
$users->preventUsersAccess($_SERVER['REQUEST_METHOD'],realpath(__FILE__),realpath($_SERVER['SCRIPT_FILENAME']));
if(isset($_POST['key'])){

if ($_POST['key'] == 'contact_business') {
    
    $datetime= date('Y-m-d H-i-s'); // last_login 
    $name_client_  =  $users->test_input($_POST['name_client_']);
    $email_client_  =  $users->test_input($_POST['email_client_']);
    $phone_client_  =  $users->test_input($_POST['phone_client_']);
    $message_client_  =  $users->test_input($_POST['messages_client_']);

    if(!preg_match("/^[a-zA-Z ]*$/",  $name_client_)){
       exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                   <button class="close" data-dismiss="alert" type="button">
                       <span>&times;</span>
                   </button>
                   <strong>Only letters and white space allowed</strong> </div>');
   }else if (!filter_var($email_client_,FILTER_VALIDATE_EMAIL)) {
           exit('<div class="alert alert-danger alert-dismissible fade show text-center">
                   <button class="close" data-dismiss="alert" type="button">
                       <span>&times;</span>
                   </button>
                   <strong>Email invalid format</strong> </div>');
   }else {
     $users->Postsjobscreates('business_message', array(

        'name_client' => $name_client_,
        'email_client' => $email_client_,
        'message_client' => $message_client_,
        'phone_client' => $phone_client_,
        'datetime' => $datetime

     ));

    } 

    } 
} 

if(isset($_POST['contacts_business'])){ ?>
<div class="house-popup">
    
<div class="wrap6" id="disabler">
    <div class="wrap6Pophide" onclick="togglePopup ( )" ></div>
    <span class="col-sm-12 col-md-3  colose">
        <button class="close-imagePopup"><i class="fa fa-times" aria-hidden="true"></i></button>
    </span>
    <div class="img-popup-wrap" id="popupEnd" style="max-width: 409px;">
        <div class="img-popup-body" >

        <div class="card">
            <div class="card-header">
                    <button class="btn btn-success btn-sm  float-right d-md-block d-lg-none" onclick="togglePopup( )">close</button>
                    <div class="section-titles">
                        <h2>Get In Touch</h2>
                    </div>
            </div>
            <form action="#" class="contact-form">
            <div class="card-body">
          
                <div id="responses"></div> 
                        <div class="form-row">
                            <div class="col-12">
                            <label for="lastname">Name :</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon2"><i class="fa fa-user"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" name="name_client_0" id="name_client_0"
                                    aria-describedby="helpId" placeholder="name">
                                    <span id="response"></span>
                            </div>
                            </div>
                            <div class="col-12">
                            <label for="specialize">email :</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon2"><i class="fa fa-envelope"></i>
                                    </span>
                                </div>
                                <input type="email" class="form-control" name="email_client_0" id="email_client_0"
                                    aria-describedby="helpId" placeholder="@email">
                                    <span id="response"></span>
                            </div>
                            </div>
                            <div class="col-12">
                            <label for="specialize">Telephone :</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon2"><i class="fa fa-phone"></i>
                                    </span>
                                </div>
                                <input type="text" class="form-control" name="phone_client_0" id="phone_client_0"
                                    aria-describedby="helpId" placeholder="Telephone">
                                    <span id="response"></span>
                            </div>
                            </div>
                        </div>
                           
                        <textarea class="form-control mt-2" id="messages_client_0" name="messages_client_0"  placeholder="Messages"></textarea>
                    </div>  <!-- card-body -->
                    <div class="card-footer">
                        <button onclick="javascript:contact_business('contact_business')" type="button" class="btn btn-block btn-primary m-2">Send Message</button>
                    </div>
                     <!-- card-footer -->
                    </form>
                  </div>
                       <!-- card -->

        </div><!-- img-popup-body -->
        </div><!-- tweet-show-popup-box -->
    </div> <!-- Wrp4 -->
</div> <!-- apply-popup" -->

<?php } ?>