(function($) {
  var cache = [];
  // Arguments are image paths relative to the current page.
  $.preLoadImages = function() {
    var args_len = arguments.length;
    for (var i = args_len; i--;) {
      var cacheImage = document.createElement('img');
      cacheImage.src = arguments[i];
      cache.push(cacheImage);
    }
  }
})(jQuery)


/* This function is called when user selects file in file dialog */
function jsUpload(upload_field)
{
    var re_text = /\.png|\.jpg|\.bmp|\.jpeg|\.gif/i;
    var filename = upload_field.value;
    if (filename.search(re_text) == -1)
    {
        alert("File does not have text(txt, xml, zip) extension");
        upload_field.form.reset();
        return false;
    }
    upload_field.form.submit();
    filename = filename.replace(/^.*(\\|\/|\:)/, '');
    $('#uploadprogress').html(filename + ' has been uploaded');
    $('#user_image').val(filename);
    jQuery.preLoadImages("../../uploads/"+filename);
    $('#usrphoto').attr('src', '../../uploads/'+filename);
    $('#usrphoto').attr('width', '150');
    upload_field.disabled = true;
    return true;
}
