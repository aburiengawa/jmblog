<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
{{-- <script src="https://cloud.tinymce.com/dev/tinymce.min.js"></script> --}}
{{-- <script src="{{asset('js/tinymce4.min.js')}}"></script> --}}
{{-- <textarea name="content" class="form-control my-editor">{!! old('content', $content) !!}</textarea> --}}
<script>
  var editor_config = {
    style_formats: [
      {title: 'Headers', items: [
          {title: 'Header 1', format: 'h1'},
          {title: 'Header 2', format: 'h2'},
          {title: 'Header 3', format: 'h3'},
          {title: 'Header 4', format: 'h4'},
          {title: 'Header 5', format: 'h5'},
          {title: 'Header 6', format: 'h6'}
      ]},
      {title: 'Inline', items: [
          {title: 'Bold', icon: 'bold', format: 'bold'},
          {title: 'Italic', icon: 'italic', format: 'italic'},
          {title: 'Underline', icon: 'underline', format: 'underline'},
          {title: 'Strikethrough', icon: 'strikethrough', format: 'strikethrough'},
          {title: 'Superscript', icon: 'superscript', format: 'superscript'},
          {title: 'Subscript', icon: 'subscript', format: 'subscript'}
      ]},
      {title: 'Blocks', items: [
          {title: 'Paragraph', format: 'p'},
          {title: 'Blockquote', format: 'blockquote'}
      ]},
      {title: 'Alignment', items: [
          {title: 'Left', icon: 'alignleft', format: 'alignleft'},
          {title: 'Center', icon: 'aligncenter', format: 'aligncenter'},
          {title: 'Right', icon: 'alignright', format: 'alignright'},
          {title: 'Justify', icon: 'alignjustify', format: 'alignjustify'}
      ]},
          {title: 'Caption', inline: 'span', classes: 'caption text-muted'},
          // {title: 'Caption', format: 'caption', inline: 'span'},
          {title: 'Section Heading', block: 'h2', classes: 'section-heading'}
    ],
    formats: {
      alignleft: {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'left'},
      aligncenter: {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'center'},
      alignright: {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'right'},
      alignjustify: {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'full'},
      // caption: {selector : 'span', classes: 'caption text-muted'},
      // h2: {block: 'h2', classes: 'section-heading'},
      blockquote: {block : 'blockquote', classes : 'blockquote'},
      bold: {inline : 'span', 'classes' : 'bold'},
      italic: {inline : 'span', 'classes' : 'italic'},
      underline: {inline : 'span', 'classes' : 'underline', exact : true},
      strikethrough: {inline : 'del'},
      forecolor: {inline : 'span', classes : 'forecolor', styles : {color : '%value'}},
      hilitecolor: {inline : 'span', classes : 'hilitecolor', styles : {backgroundColor : '%value'}},
      custom_format: {block : 'h1', attributes : {title : 'Header'}, styles : {color : 'red'}}
    },
    image_class_list: [
      {title: 'None', value: ''},
      {title: 'img-fluid', value: 'img-fluid'},
    ],
    path_absolute : "/",
    selector: "textarea",
    theme: 'modern',
    mobile: { theme: 'mobile' },
    plugins: [
      "advlist autolink lists link image charmap print preview hr anchor pagebreak",
      "searchreplace wordcount visualblocks visualchars code fullscreen",
      "insertdatetime media nonbreaking save table contextmenu directionality",
      "emoticons template paste textcolor colorpicker textpattern"
    ],
    toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
    relative_urls: false,
    file_browser_callback : function(field_name, url, type, win) {
      var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
      var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
      var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
      if (type == 'image') {
        cmsURL = cmsURL + "&type=Images";
      } else {
        cmsURL = cmsURL + "&type=Files";
      }
      tinyMCE.activeEditor.windowManager.open({
        file : cmsURL,
        title : 'Filemanager',
        width : x * 0.8,
        height : y * 0.8,
        resizable : "yes",
        close_previous : "no"
      });
    }
  };
  tinymce.init(editor_config);
</script>