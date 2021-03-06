$(document).ready(function () {
  let submit = () => {
    $('#guru_form').submit(function (e) {
      e.preventDefault();
      $('#loading').addClass('hidden');
      $('#guru_load').removeClass('hidden');
      var form = $('#guru_form')[0]; // You need to use standard javascript object here
      var formData = new FormData(form);
      upload_file(formData);
    });
  }
  let upload_file = (postdata) => {
    $.ajax({
      url: _URL + 'guru/proc_upload',
      type: 'post',
      data: postdata,
      processData: false,
      contentType: false,
      success: function (re) {
        console.log(re);
        if (re.status == 'success') {
          var elem = document.getElementById("guru_pro");
          var width = 1;
          var id = setInterval(frame, 40);
          $('#guru_success_load').removeClass('hidden');
          upload(re.data);

          function frame() {
            if (width >= 100) {
              clearInterval(id);

            } else {
              width = width + 1;
              elem.style.width = width + "%";
              var show = width;
              elem.innerHTML = show + " % menyiapkan data";
            }
          }
        } else {}
      },
      error: function (error) {
        console.log(error);
      }
    });
  }
  submit();
  let upload = (postfile) => {
    $.ajax({
      type: "post",
      data: {
        file: postfile
      },
      url: _URL + "guru/insert",
      success: function (result) {
        if (result.status) {
          console.log(result);
          var elem = document.getElementById("guru_success_pro");
          var width = 1;
          var id = setInterval(frame, 70);

          function frame() {
            if (width >= 100) {
              clearInterval(id);
              console.log(result);
            } else {
              width = width + 1;
              elem.style.width = width + "%";
              var show = width;
              elem.innerHTML = show + " % data berhasil di upload";
            }
          }
        }else{
          console.log(result);
        }
      },
      error: function (error) {
        console.log(error);
        var str = error.responseText;
        var res = str.substring(1094, 1140);
        if (res == 'You have an error in your SQL syntax; check the ') {
          console.log('Format Excel tidak sesuai');
          res = 'Format Excel tidak sesuai';
          res = '<div class="alert alert-danger"><strong>danger !</strong> ' + res + '</div>'
        } else {
          res = '<div class="alert alert-danger"><strong>danger !</strong> ' + res + '</div>'
        }
        $('#error').html(res);
      }
    });
  }
});