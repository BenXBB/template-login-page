
$("#loginForm").submit(function(e) {
    e.preventDefault();
    $.ajax({
        type: 'POST',
        url: 'login.php',
        dataType: 'json',
        data: {
          username: $('#username').val(),
          password: $('#password').val()
        },
        success: function(response) {
          if (response == "success") {
            // Redirect to the user's dashboard or homepage
            //window.location.href = "dashboard.php";
            console.log("logged in!")
          } else {
            // Display an error message
            console.log(response)
          }
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR, textStatus, errorThrown);
        }
      });
});