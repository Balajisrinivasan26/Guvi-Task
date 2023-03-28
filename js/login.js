$(document).ready(function() {
    console.log("Hi");
    $("#my-form").submit(function (event) {
      console.log("hello");
      event.preventDefault();
  
      let formData = {
        email: $("#email").val(),
        password: $("#password").val(),
      };
      console.log(formData);
      $.ajax({
        type: "POST",
        url: "http://localhost/guvitask/php/login.php",
        data: formData,
        success: function (response) {
         console.log(response);
          let res = JSON.parse(response);
  
          if (res.status == "success") {
            console.log("gandha");
            localStorage.setItem("redisId", res.session_id);
            localStorage.setItem("email",formData.email);
            localStorage.setItem("password",formData.password);
            window.location.replace("http://localhost/guvitask/profile.html");
          }
          
        },
        error: function (jqXHR, textStatus, errorThrown) {
        
            alert("Username or Password entered Wrongly");
            window.location.replace("http://localhost/guvitask/login.html");
          console.log(errorThrown); // log error message to console
        },
      });
    });
  });