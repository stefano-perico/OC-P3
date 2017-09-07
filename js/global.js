tinymce.init({
  mode: 'specific_textareas',
  selector: '#wysiwyg',
  height: 500,
  menubar: false,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table contextmenu paste code'
  ],
  toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent ',
  content_css: [
    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
    '//www.tinymce.com/css/codepen.min.css']
});

jQuery(function($){
    var alert  = $('#alert');
    if (alert.length > 0)
    {
        alert.hide().slideDown(500).delay(3000).slideUp();
    }
});