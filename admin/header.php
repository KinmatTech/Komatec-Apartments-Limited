<?php
//$_POST = array_map('strip_tags', $_POST);
 ?>
 <?php   
		$pdo->exec("set names utf8");
		$dd = $pdo->query("SELECT * FROM general_setting WHERE id='1'");
		$dd = $dd->fetch(PDO::FETCH_ASSOC);
		$currency = $dd['currency'];
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="shortcut icon" href="images/favicon.png" type="image/png">

  <title><?php echo($dd['sitename']) ?></title>

  <link href="css/style.default.css" rel="stylesheet"> 


 <link rel="stylesheet" href="css/bootstrap-timepicker.min.css" />
  <link rel="stylesheet" href="css/jquery.tagsinput.css" />
  <link rel="stylesheet" href="css/colorpicker.css" />
  <link rel="stylesheet" href="css/dropzone.css" />
  <script src="js/jquery-1.11.1.min.js"></script>
<script src="js/jquery-migrate-1.2.1.min.js"></script>
<script src="js/jquery-ui-1.10.3.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/modernizr.min.js"></script>
<script src="js/jquery.sparkline.min.js"></script>
<script src="js/toggles.min.js"></script>
<script src="js/retina.min.js"></script>
<script src="js/jquery.cookies.js"></script>
<!------------------------Chat JS Files ------------------------------------------------------>
<script type="text/javascript" src="js/Chart.js"></script>
<script type="text/javascript" src="js/Chart.min.js"></script>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>

tinymce.init({ 
selector:'textarea.tiny',
//oninit : "setPlainText",
height: 500,
  theme: 'modern',
  plugins: [
    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    'searchreplace wordcount visualblocks visualchars code fullscreen',
    'insertdatetime media nonbreaking save table contextmenu directionality',
    'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc',
	'image code',
  ],
  toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
  toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
  image_advtab: true,
  templates: [
    { title: 'Test template 1', content: 'Test 1' },
    { title: 'Test template 2', content: 'Test 2' }
  ],
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css'
  ],
  // enable title field in the Image dialog
  image_title: true, 
  // enable automatic uploads of images represented by blob or data URIs
  automatic_uploads: true,
  // URL of our upload handler (for more details check: https://www.tinymce.com/docs/configure/file-image-upload/#images_upload_url)
  images_upload_url: 'postAcceptor',
  // here we add custom filepicker only to Image dialog
  file_picker_types: 'image', 
  // and here's our custom image picker
  file_picker_callback: function(cb, value, meta) {
    var input = document.createElement('input');
    input.setAttribute('type', 'file');
    input.setAttribute('accept', 'image/*');
    
    // Note: In modern browsers input[type="file"] is functional without 
    // even adding it to the DOM, but that might not be the case in some older
    // or quirky browsers like IE, so you might want to add it to the DOM
    // just in case, and visually hide it. And do not forget do remove it
    // once you do not need it anymore.

    input.onchange = function() {
      var file = this.files[0];
      
      // Note: Now we need to register the blob in TinyMCEs image blob
      // registry. In the next release this part hopefully won't be
      // necessary, as we are looking to handle it internally.
      var id = 'blobid' + (new Date()).getTime();
      var blobCache = tinymce.activeEditor.editorUpload.blobCache;
      var blobInfo = blobCache.create(id, file);
      blobCache.add(blobInfo);
      
      // call the callback and populate the Title field with the file name
      cb(blobInfo.blobUri(), { title: file.name });
    };
    
    input.click();
  }
});
function setPlainText() {
	var ed = tinyMCE.get('elm1');

	ed.pasteAsPlainText = true;  

	//adding handlers crossbrowser
	if (tinymce.isOpera || /Firefox\/2/.test(navigator.userAgent)) {
		ed.onKeyDown.add(function (ed, e) {
			if (((tinymce.isMac ? e.metaKey : e.ctrlKey) && e.keyCode == 86) || (e.shiftKey && e.keyCode == 45))
				ed.pasteAsPlainText = true;
		});
	} else {            
		ed.onPaste.addToTop(function (ed, e) {
			ed.pasteAsPlainText = true;
		});
	}
}
</script>

  <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script src="js/html5shiv.js"></script>
  <script src="js/respond.min.js"></script>
  <![endif]-->

    

 <script>
$(function() {
$( "#datepicker" ).datepicker();
});
</script>

 <script>
$(function() {
$( "#datepicker1" ).datepicker();
});
</script>

 <script>
$(function() {
$( "#datepicker2" ).datepicker();
});
</script>
<style>
.page-header {
    border-bottom: 0px solid #FFF;
	color: #1D2939;
	
}
h1 {
  text-transform: uppercase;
}
</style>

 
</head>

<body>



<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>

  <div class="leftpanel">

    <div class="logopanel">
        <a href="index">
			<img src="img/logo.png" alt="<?php echo($dd['sitename']) ?>" height="60px" style="width: 100%;">
		</a>
    </div><!-- logopanel -->

    <div class="leftpanelinner">

        <!-- This is only visible to small devices -->
        <div class="visible-xs hidden-sm hidden-md hidden-lg">

            <h5 class="sidebartitle actitle">Account</h5>
            <ul class="nav nav-pills nav-stacked nav-bracket mb30">
              <li><a href="changepass"><i class="fa fa-cog"></i> <span>Account Settings</span></a></li>
              <li><a href="signout"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
            </ul>
        </div>

      <br>
      <ul class="nav nav-pills nav-stacked nav-bracket">
	  
	  
	   
	  
        <li><a href="home"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
        
		<li><a href="memberview"><i class="fa fa-user"></i><span>Members</span></a></li>
		<li><a href="../chat/"><i class="fa fa-comment"></i> <span>Live Collaborations</span></a></li>
		
		<li class="nav-parent"><a href="#"><i class="fa fa-book"></i> <span>Blog Management</span></a>
          <ul class="children">
            <li><a href="postview"><i class="fa fa-caret-right"></i> <span>Blog Post</span></a></li>
			<li><a href="postcatview"><i class="fa fa-caret-right"></i> <span>Blog Category</span></a></li>
          </ul>
        </li>
		
		<li class="nav-parent"><a href="#"><i class="fa fa-pencil"></i> <span>Journal Management</span></a>
          <ul class="children">
            <li><a href="paperview"><i class="fa fa-caret-right"></i> <span>Papers</span></a></li>
			<li><a href="volumeview"><i class="fa fa-caret-right"></i> <span>Volumes</span></a></li>
          </ul>
        </li>
		
		<li class="nav-parent"><a href="#"><i class="fa fa-th-list"></i> <span>Website Management</span></a>
          <ul class="children">
            <li><a href="blockview"><i class="fa fa-caret-right"></i> <span>Block</span></a></li>
			<li><a href="blockcatview"><i class="fa fa-caret-right"></i> <span>Block Category</span></a></li>
          </ul>
        </li>
        <li class="nav-parent"><a href="#"><i class="fa fa-th-list"></i> <span>Expense Management</span></a>
          <ul class="children">
            <li><a href="expadd"><i class="fa fa-caret-right"></i>Add Expenses</a></li>
            <li><a href="expview"><i class="fa fa-caret-right"></i>View/Edit Expenses</a></li>
            <li><a href="expcatadd"><i class="fa fa-caret-right"></i>Add Expense Category</a></li>
            <li><a href="expcatview"><i class="fa fa-caret-right"></i>View/Edit Expense Category</a></li>
          </ul>
        </li>
        <li class="nav-parent"><a href="#"><i class="fa fa-th-list"></i> <span>Income Management</span></a>
          <ul class="children">
          	<li><a href="incadd"><i class="fa fa-caret-right"></i>Add Income</a></li>
            <li><a href="incview"><i class="fa fa-caret-right"></i>View/Edit Income</a></li>
            <li><a href="inccatadd"><i class="fa fa-caret-right"></i>Add Income Category</a></li>
            <li><a href="inccatview"><i class="fa fa-caret-right"></i>View/Edit Income Category</a></li>
          </ul>
        </li>
        <li class="nav-parent"><a href="#"><i class="fa fa-th-list"></i> <span>General Settings</span></a>
          <ul class="children">
          	<li><a href="setgeneral"><i class="fa fa-caret-right"></i>Settings</a></li>
            <li><a href="setlogo"><i class="fa fa-caret-right"></i>Logo</a></li>
          </ul>
        </li>
		<li><a href="../"><i class="fa fa-globe"></i> <span>Back to Website</span></a></li>
      </ul>

      

    </div><!-- leftpanelinner -->
  </div><!-- leftpanel -->

  <div class="mainpanel">

    <div class="headerbar">

      <a class="menutoggle"><i class="fa fa-bars"></i></a>

        
      <div class="header-right">
        <ul class="headermenu">
          <li>
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">

<?php
echo "<img src='images/user.png' alt='' />";
echo " $user";
?>
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
              <li><a href="changepass"><i class="fa fa-cog"></i> <span>Account Settings</span></a></li>
              <li><a href="signout"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
              </ul>
            </div>
          </li>

        </ul>
      </div><!-- header-right -->

    </div><!-- headerbar -->


    <div class="contentpanel">