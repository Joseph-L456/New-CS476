function SignUpForm(event){
    var elements = event.currentTarget;
    var uname1 = elements[0].value;
    var pname1 = elements[1].value;
    var pswd1 = elements[2].value;
    var pswdr1 = elements[3].value;

    var regex_uname1 = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
    var regex_pswd1 = /^[^\s]([\da-zA-Z]+?[_]+?)|([_]+?[\da-zA-Z]+?)|(\d+?[a-zA-Z]+?)|([a-zA-Z]+?\d+?)/;

   
    var msg_uname1 = document.getElementById("msg_uname1");
    var msg_pswd1 = document.getElementById("msg_pswd1");
    var msg_pswdr1 = document.getElementById("msg_pswdr1");
    var msg_pname1 = document.getElementById("msg_pname1");
  
    msg_uname1.innerHTML  = "";
    msg_pswd1.innerHTML = "";
    msg_pswdr1.innerHTML = "";
    msg_pname1.innerHTML = "";
   
    var textNode;
    var htmlNode;

    if (uname1 == null || uname1 == "") {
        textNode = document.createTextNode("Username is empty.");
        msg_uname1.appendChild(textNode);
        valid = false;
      } 
      else if (regex_uname1.test(uname1) == false) {
        textNode = document.createTextNode("Username is in a wrong format. example: username@somewhere.sth");
        msg_uname1.appendChild(textNode);
        valid = false;
      }
      else if (uname1.length > 60) {
        textNode = document.createTextNode("Username is too long. Maximum is 60 characters.");
        msg_uname1.appendChild(textNode);
        valid = false;
      }



if (pswd1 == null || pswd1 == "") {
    textNode = document.createTextNode("Password is empty.");
    msg_pswd1.appendChild(textNode);
    valid = false;
  } 
  else if (regex_pswd1.test(pswd1) == false) {
    textNode = document.createTextNode("Password is in a wrong format. You should have at least one non-letter character inside and can not contain any spaces inside.");
    msg_pswd1.appendChild(textNode);
    valid = false;
  }
  else if (pswd1.length < 6) {
    textNode = document.createTextNode("Password is too short. It should be 6 characters.");
    msg_pswd1.appendChild(textNode);
    valid = false;
  }
  else if (pswd1.length > 6) {
    textNode = document.createTextNode("Password is too long. It should be 6 characters.");
    msg_pswd1.appendChild(textNode);
    valid = false;
  }

  
  if (pswdr1 == null || pswdr1 == "") {
    textNode = document.createTextNode("Confirmation password is empty.");
    msg_pswdr1.appendChild(textNode);
    valid = false;
  } 
  else if (pswdr1 != pswd1) {
    textNode = document.createTextNode("The confirmation password did not match with the password.");
    msg_pswdr1.appendChild(textNode);
    valid = false;
  }

  
   if (pname1 == null || pname1 == "") {
        textNode = document.createTextNode("Nickname is empty.");
        msg_pname1.appendChild(textNode);
        valid = false;
      } 
      else if (pname1.length > 8) {
        textNode = document.createTextNode("Nick name is too long. Maximum is 8 characters.");
        msg_pname1.appendChild(textNode);
        valid = false;
      }


var display_info = document.getElementById("display_info");
display_info.innerHTML = "";

  if (valid == true) {
    display_info.style.color = "green";

    textNode = document.createTextNode("Username: " + uname1);
    display_info.appendChild(textNode);
    htmlNode = document.createElement("br");
    display_info.appendChild(htmlNode);

    textNode = document.createTextNode("Password: " + pswd1);
    display_info.appendChild(textNode);
    htmlNode = document.createElement("br");
    display_info.appendChild(htmlNode);
  }

  else {
    event.preventDefault(); 
    display_info.setAttribute("style", "color: red");
}


}