$(document).ready(function(){
    tinymce.init({
       selector: 'textarea',
       mode : "textareas",
      theme : "advanced",      
       forced_root_block : "", 
    force_br_newlines : true,
    force_p_newlines : false,         
      width : 70%,      
      menubar: false,
      plugins: [
        'advlist autolink lists link image charmap print preview anchor textcolor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste code help'
      ],
      toolbar: 'insert | undo redo |  styleselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
      content_css: [
        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
        '//www.tinymce.com/css/codepen.min.css']
    });
});
