

 <div class="well" style="margin:auto; padding:auto; width:80%;">
        <div id="manage_admin_form" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title">FORM OF ADMIN address</h2>
                    </div>
                    <div class="modal-body">
                     <div id="editContent_admin">
                     <div id="responseAdmins"></div>
                         <div class="form-group">
                            <input type="hidden" id="admin_editRowID" value="0">
                            <label for="firstName">firstName</label>
                            <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon2"><i
                                              class="fa fa-user"></i></span>
                                  </div>
                                    <input type="text" name="firstname_admin" class="form-control" id="firstname_admin" placeholder="firstName" required>
                            </div>
                            <label for="lastName">lastName</label>
                            <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon2"><i
                                              class="fa fa-user"></i></span>
                                  </div>
                                   <input type="text" name="lastname_admin" class="form-control" id="lastname_admin" placeholder="lastName" required>
                            </div>
                            <label for="Username">Username</label>
                            <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon2"><i
                                              class="fa fa-user"></i></span>
                                  </div>
                                    <input type="text" name="username_admin" class="form-control" id="username_admin" placeholder="Username" required>
                            </div>
                            <label for="password">Password</label>
                            <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon2"><i
                                              class="fa fa-key"></i></span>
                                  </div>
                                    <input type="text" name="Password_admin" class="form-control" id="password_admin" placeholder="Password" required>
                            </div>
            
                            <label for="email">Email <span class="text-muted">(Optional)</span></label>
                            <div class="input-group">
                               <div class="input-group-prepend">
                                 <span class="input-group-text">@</span>
                               </div>
                               <input type="email" class="form-control" id="email_admin" placeholder="you@example.com" required>
                               <div class="invalid-feedback">
                                  Please enter a valid email address for shipping updates.
                               </div>
                            </div>
            
                            <label for="specialize">Telephone :</label>
                              <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon2"><i class="fa fa-phone"></i>
                                      </span>
                                  </div>
                                  <input type="text" class="form-control" name="telephone_admin" id="telephone_admin"
                                      aria-describedby="helpId" value=""  placeholder="Your phone number">
                                      <span id="response"></span>
                              </div>
                              <label for="specialize">Twitter :</label>
                              <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon2"><i class="fa fa-twitter"></i>
                                      </span>
                                  </div>
                                  <input type="text" class="form-control" name="twitter_admin" id="twitter_admin"
                                      aria-describedby="helpId" value=""  placeholder="Your twitter name">
                                      <span id="response"></span>
                              </div>
                              <label for="specialize">Facebook :</label>
                              <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon2"><i class="fa fa-facebook"></i>
                                      </span>
                                  </div>
                                  <input type="text" class="form-control" name="facebook_admin" id="facebook_admin"
                                      aria-describedby="helpId" value=""  placeholder="Your facebook name">
                                      <span id="response"></span>
                              </div>
                              <label for="specialize">Instagram :</label>
                              <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon2"><i class="fa fa-instagram"></i>
                                      </span>
                                  </div>
                                  <input type="text" class="form-control" name="instagram_admin" id="instagram_admin"
                                      aria-describedby="helpId" value=""  placeholder="Your instagram name">
                                      <span id="response"></span>
                              </div>
                              <label for="specialize">skill :</label>
                              <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon2"><i
                                              class="fa fa-pencil"></i></span>
                                  </div>
                                  <input type="text" class="form-control" name="skill_admin" id="skill_admin"
                                      aria-describedby="helpId" value="">
                                      <span id="response"></span>
                                </div>
                              <label for="specialize">notes :</label>
                              <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon2"><i
                                              class="fa fa-file-text-o"></i></span>
                                  </div>
                                  <input type="text" class="form-control" name="notes_admin" id="notes_admin"
                                      aria-describedby="helpId" value="">
                                      <span id="response"></span>
                              </div>
                                <label for="location"><strong>Location</strong> :</label>
                              <div class="input-group mb-3">
                                  <div class="input-group-prepend">
                                      <span class="input-group-text" id="basic-addon2"><i
                                              class="fa fa-map-marker"></i></span>
                                  </div>
                                  <input type="text" class="form-control" name="location_admin" id="location_admin"
                                      aria-describedby="helpId" value="">
                              </div>
                          </div> 
                          <div class="form-group image">
                            <label for="">Upload Picture</label>
                            <input type="file" class="form-control-file" name="image" id="image">
                          </div>      
                          <input type="submit" value="submit" class="btn btn-success user_form">
                        </div> <!-- THIS IS EDIT-CONTENT -->

                        <!-- START OF UPLOAD IMAGE CONTENT -->
                      <div id="profile_image_ADMIN">
                          <div class="container">

                              <div class="user-box">
                                  <div class="img-relative">
                                      <!-- Loading image -->
                                      <div class="overlay uploadProcess" style="display: none;">
                                          <div class="overlay-content"><img src="<?php echo BASE_URL_LINK ;?>image/user_default_image/load.jpg" /></div>
                                      </div>
                                      <!-- Hidden upload form -->
                                      <form method="post" action="<?php echo BASE_URL;?>core/ajax_db/profileEdit.php"  enctype="multipart/form-data"
                                          id="picUploadForm_" target="uploadTarget_">
                                          
                                          <input type="hidden" name="edit_profile" id="edit_profile_" value="" style="display:none" />
                                          <input type="file" name="picture" id="fileInput_" style="display:none" />
                                      </form>
                                      <iframe id="uploadTarget_" name="uploadTarget_" src="#"
                                          style="width:0;height:0;border:0px solid black;"></iframe>
                                      <!-- Image update link -->
                                      <!-- <p class="editLink" `><img src="images/upload_image.png" width="80px" /></p> -->
                                      <a href="javascript:void(0);" class="editLink" id="edit_linkUpload_">
                                      <img src="<?php echo BASE_URL_LINK ;?>image/user_default_image/upload_image.png" width="80px" /></a>
                                      <!-- Profile image -->
                                      <img id="imagePreview_" class="imagePreview" width="180px">
                                  </div>
                                  <div class="name">
                                      <h4>Profile_img :</h4>
                                      <div  id="nameView4"></div> 
                                  </div>
                              </div>

                          </div>
                      </div>
                      <!-- END OF UPLOAD IMAGE CONTENT -->

                        <div id="showContent_admin" style="display:none;">

                            <p><span style="font-weight:bold;font-size:17px;">FirstName : </span>
                            <span id="firstnameView"></span> </p>
                            <hr>
                            <p><span style="font-weight:bold;font-size:17px;">LastName : </span>
                            <span id="lastnameView" ></span> </p>
                            <!-- style="overflow-y: scroll; height: 300px;"> -->
                            <hr>
                            <p><span style="font-weight:bold;font-size:17px;">UserName : </span>
                            <span id="usernameView"></span></p>
                            <hr>
                            <p><span style="font-weight:bold;font-size:17px;">Password : </span>
                            <span id="passwordView"></span> </p>
                            <hr>
                            <p><span style="font-weight:bold;font-size:17px;">Email : </span>
                            <span id="emailViewz"></span> </p>
                            <hr>
                            <p><span style="font-weight:bold;font-size:17px;">Address : </span>
                            <span id="addressViewz"></span> </p>
                            <hr>
                            <p><span style="font-weight:bold;font-size:17px;">Telephone :</span>
                            <span id="telephoneView"></span> </p>
                            <!-- <hr> -->
                            <p><span style="font-weight:bold;font-size:17px;">Twitter : </span>
                            <span id="TwitterViewz"></span> </p>
                            <hr>
                            <p><span style="font-weight:bold;font-size:17px;">Instagram : </span>
                            <span id="InstagramViewz"></span> </p>
                            <hr>
                            <p><span style="font-weight:bold;font-size:17px;">Facebook : </span>
                            <span id="FacebookViewz"></span> </p>
                            <hr>
                            <p><span style="font-weight:bold;font-size:17px;">skill : </span>
                            <span id="skillViewz"></span> </p>
                            <hr>
                            <p><span style="font-weight:bold;font-size:17px;">Note : </span>
                            <span id="NoteViewz"></span> </p>
                            <hr>
                            <p><span style="font-weight:bold;font-size:17px;">Location : </span>
                            <span id="locationViewz"></span> </p>
                            <hr>
                        </div>
                     </div> <!-- THIS IS MODAL BODY -->

                    <div class="modal-footer">
                        <input type="button" class="btn btn-primary" data-dismiss="modal" value="Close" id="closeBtn1" >
                        <input type="button" id="button_admin" onclick="ajax_requests('add_admin');" value="Save" class="btn btn-success">
                    </div>

                </div>
            </div>
        </div>
 </div>