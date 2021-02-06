
$(document).ready(function() {
    
    var delay = 300; // milliseconds
    var cookie_expire = 10; // days

    var cookie = localStorage.getItem("list-builder");
    if(cookie === undefined || cookie === null) {
        cookie = 0;
    }

    
    if((((new Date()).getTime() - cookie) / (1000 * 60 * 60 * 24) > cookie_expire)) {
        $("#list-builder").delay(delay).fadeIn("fast", () => {
            $("#popup-box").fadeIn("fast", () => {});
        });

        $("button[name=subscribe]").click(() => {
            if(verifyInput("name") && verifyInput("email")) {
                $.ajax({
                    type: "POST",
                    url: $("#popup-form").attr("action"),
                    data: $("#popup-form").serialize(),
                    success: (data) => {
                        $("#popup-box-content").html("<p style='text-align: center'>Obrigado por se inscrever</p>");
                        
                    }
                });
            }
        });

        $("#popup-close").click(() => {
            $("#list-builder, #popup-box").hide();
            localStorage.setItem("list-builder", (new Date()).getTime());
        });
        
        $("#popup-close").click(() => {
            $("#list-builder, #popup-box").hide();
            localStorage.setItem("list-builder", (new Date()).getTime());
        });
    }

});


function verifyInput(name) {
  var x, text;

  x = document.getElementById(name).value;

 
  if (x.length > 0) {
    return true;
    
  } else {
      if(name === "name") {
          name = "Nome";
      } else {
          name = "E-mail"
      }
    text = name + " não válido";
    document.getElementById("demo").innerHTML = text;
    return false;
      
  }
  
}


