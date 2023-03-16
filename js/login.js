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
            window.location.replace("http://127.0.0.1:5500/profile.html");
            localStorage.setItem("redisId", res.session_id);
          }
          
        },
        error: function (jqXHR, textStatus, errorThrown) {
        
            alert("Username or Password entered Wrongly");
            window.location.replace("http://127.0.0.1:5500/login.html");
          console.log(errorThrown); // log error message to console
        },
      });
    });
  });