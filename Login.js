function LoginForm(event){
  var elements = event.currentTarget;
  var uname = elements[0].value;
  var pswd = elements[1].value;


  var regex_uname = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
  var regex_pswd = /^[^\s]*$/;

 
  var msg_uname = document.getElementById("msg_uname");
  var msg_pswd = document.getElementById("msg_pswd");
  msg_uname.innerHTML  = "";
  msg_pswd.innerHTML = "";
 
  var textNode;
  var htmlNode;

  if (uname == null || uname == "") {
      textNode = document.createTextNode("Username is empty.");
      msg_uname.appendChild(textNode);
      //input.addClass("error");
      valid = false;
    } 
    else if (regex_uname.test(uname) == false) {
      textNode = document.createTextNode("Username is in a wrong format. example: username@somewhere.sth");
      msg_uname.appendChild(textNode);
      valid = false;
    }
    else if (uname.length > 60) {
      textNode = document.createTextNode("Username is too long. Maximum is 60 characters.");
      msg_uname.appendChild(textNode);
      valid = false;
    }
  else
  {valid = true;}


if (pswd == null || pswd == "") {
  textNode = document.createTextNode("Password is empty.");
  msg_pswd.appendChild(textNode);
  valid = false;
} 
else if (regex_pswd.test(pswd) == false) {
  textNode = document.createTextNode("Password is in a wrong format. You should not contain any spaces inside.");
  msg_pswd.appendChild(textNode);
  valid = false;
}
else if (pswd.length < 6) {
  textNode = document.createTextNode("Password is too short. Minimum is 6 characters.");
  msg_pswd.appendChild(textNode);
  valid = false;
}
else {valid = true;}


var display_info = document.getElementById("display_info");
display_info.innerHTML = "";

if (valid == true) {
  display_info.style.color = "green";

  textNode = document.createTextNode("Username: " + uname);
  display_info.appendChild(textNode);
  htmlNode = document.createElement("br");
  display_info.appendChild(htmlNode);

  textNode = document.createTextNode("Password: " + pswd);
  display_info.appendChild(textNode);
  htmlNode = document.createElement("br");
  display_info.appendChild(htmlNode);
}

else {
  event.preventDefault(); 
  display_info.setAttribute("style", "color: red");
}


}

