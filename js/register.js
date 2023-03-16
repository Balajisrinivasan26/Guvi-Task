function submitForm() {
    var name = $("input[name=name]").val();
    var email = $("input[name=email]").val();
    var password = $("input[name=password]").val();
    var mobile = $("input[name=mobile]").val();
    var age = $("input[name=age]").val();
    var dob = $("input[name=dob]").val();
      var formData = {
        name: name,
        email: email,
        password: password,
        mobile: mobile,age:age,dob:dob
      };
      $.ajax({
        url: "http://localhost/guvitask/php/register.php",
        type: "POST",
        data: formData,
        success: function (response) {
          // kk;
          console.log(response);
        },
        error: (jqXHR, textStatus, errorThrown) => {
          console.error("Error:", textStatus, errorThrown);
        },
      });
      // alert(name);
    }
