/* Set the width of the side navigation to 250px */
function openNav() {
  document.getElementById("mySidenav").style.width = "200px";
  $('#siderbarResponsive').attr('onclick','closeNav()');
}

/* Set the width of the side navigation to 0 */
function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  $('#siderbarResponsive').attr('onclick', 'openNav()');
}

function getPropertyTypeHide(selectObject) {
  if(selectObject.value == "commerce_For_rent" || selectObject.value == "House_Land"){
    $('#EquipmentHide').hide();
    $('#bedroomsHide').hide();
    $('#bathroomsHide').hide();
    $('#carHide').hide();
    $('#submit_form').hide();
    $("#submit_form").attr('id', 'submit_form_hide_bedbath').fadeIn();
    
  }else{
    
    $('#EquipmentHide').show();
    $('#bedroomsHide').show();
    $('#bathroomsHide').show();
    $('#carHide').show();
    $('#submit_form').show();
    $("#submit_form_hide_bedbath").attr('id', 'submit_form').fadeIn();

  }
}

function fundAddmoreVideo() {
  $('#add-videohelp').show();
  $("#add-videohelp").html(
  '<div class="form-row mt-2">' +
     '<div class="col">' +
          '<div class="form-group">' +
            '<div class="btn btn-defaults btn-file">' +
     '<i class="fa fa-paperclip">' +'</i>Attachment' + 
                '<input type="file" name="video[]" id="video" multiple>' +
            '</div>' +
     '<span>' +' video</span>' +
     '<small class="help-block">' + ' (e.g mp4 )</small>' +'<br>' +
             '<span class="progress progress-hidez mt-1">' +
                     '<span class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" style="width:0%;" id="proz" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">' +'</span>' +
             '</span>' +
     '<small class="help-block">' +'Max. 10MB</small>' +
        '</div>' + 
     '</div>' +
     '<div class="col">' +
         '<div class="form-group">' +
     '<label for="">' +'youtube link</label>' +
           '<input type="text" class="form-control" name="youtube" id="youtube" placeholder="if any link of youtube video to show us of help you need ">' +
         '</div>' +
     '</div>' +
    '</div>');
  $('#add-more').attr('onclick','fundCloseVideo()');
  $('.progress-hidez').hide();
}

function AddVideo() {
  $('#add-video').show();
  $("#add-video").html(
  '<div class="form-row mt-2">' +
     '<div class="col">' +
          '<div class="form-group">' +
            '<div class="btn btn-defaults btn-file">' +
     '<i class="fa fa-paperclip">' +'</i>Attachment' + 
                '<input type="file" name="video[]" id="video" multiple>' +
            '</div>' +
     '<span>' +' video</span>' +
     '<small class="help-block">' + ' (e.g mp4 )</small>' +'<br>' +
             '<span class="progress progress-hidez mt-1">' +
                     '<span class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" style="width:0%;" id="proz" aria-valuenow="" aria-valuemin="0" aria-valuemax="100">' +'</span>' +
             '</span>' +
     '<small class="help-block">' +'Max. 10MB</small>' +
        '</div>' + 
     '</div>' +
    '</div>');
  $('#add-more').attr('onclick','CloseVideo()');
  $('.progress-hidez').hide();
}

function Addyoutube() {
  $('#add-youtube').show();
  $("#add-youtube").html(
  '<div class="form-row mt-2">' +
     '<div class="col">' +
         '<div class="form-group">' +
     '<label for="">' +'youtube link</label>' +
           '<input type="text" class="form-control" name="youtube" id="youtube" placeholder="if any link of youtube video to show us of help you need ">' +
         '</div>' +
     '</div>' +
    '</div>');
  $('#add-more1').attr('onclick','CloseYoutube()');
}

/* Set the width of the side navigation to 0 */
function fundCloseVideo() {
  $("#add-videohelp").html(" ");
  $('#add-more').attr('onclick', 'fundAddmoreVideo()');
}

function CloseVideo() {
  $("#add-video").html(" ");
  $('#add-more').attr('onclick', 'AddVideo()');
}

function CloseYoutube() {
  $("#add-youtube").html(" ");
  $('#add-more1').attr('onclick', 'Addyoutube()');
}

function displayImage0(e) { 
  for (var i = 0; i < e.files.length; i++) {
    var myDiv = document.getElementById("add-photo0");
    var selectList = document.createElement("div");
    var photo = "add-photoo";
    selectList.id = photo + [i];
    selectList.className = "col-md-4 mt-2";
    myDiv.appendChild(selectList);
  }

  function setupReader0(files, y) {
    if (files) {
      var reader = new FileReader();
      reader.onload = function (e) {
        if (y < 1) {
          $('#add-photoo'+ y +'').html(
            '<div class="form-group mt-3">' +
            '<img src="#" class="profilephotoo' + y + '" alt="User Image" width= "200px">' +
            '<input type="text" name="photo-Titleo' + y + '" class="form-control mt-1" id="photo-Titleo' + y + '" placeholder="title of photo">' +
            '</div>'
          );
        } else {
          $('#add-photoo'+ y +'').html(
            '<img src="#" class="profilephotoo' + y + '" alt="User Image" width= "200px">'
          );
        }

        $('.profilephotoo' + y + '').attr('src', e.target.result);
      };
      reader.readAsDataURL(files, "UTF-8");
      // reader.readAsText(file, "UTF-8");
    }
  }

  for (var y = 0; y < e.files.length; y++) {
    setupReader0(e.files[y], y);
  }

}


function displayImage(e) {

  for (var i = 0; i < e.files.length; i++) {
    var myDiv = document.getElementById("add-photo0");
    var selectList = document.createElement("div");
    var photo = "add-photo";
    selectList.id = photo + [i + 1];
    selectList.className = "col-md-4 mt-2";
    myDiv.appendChild(selectList);
  }

  function setupReader(files,y) {
    if (files) {
      var reader = new FileReader();
      reader.onload = function (e) {
        if (y <= 5) {
          $('#add-photo' + [y + 1] + '').html(
            '<div class="form-group mt-3">' +
            '<img src="#" class="profilephoto' + y + '" alt="User Image"  width= "200px">' +
            '<input type="text" name="photo-Title' + y + '" class="form-control mt-1" id="photo-Title' + y + '" placeholder="title of photo">' +
            '</div>'
          );
        } else {
          $('#add-photo' + [y + 1] + '').html(
            '<img src="#" class="profilephoto' + y + '" alt="User Image"  width= "200px">'
          );
        }

        $('.profilephoto' + y +'').attr('src', e.target.result);
      };
      reader.readAsDataURL(files,"UTF-8");
      // reader.readAsText(file, "UTF-8");
    }
  }

  for (var y = 0; y < e.files.length; y++) {
    setupReader(e.files[y],y);
  }

  console.log(e.files);
  console.log(e.files.length);
  
}