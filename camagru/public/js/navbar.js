function navbar() {
  var x = document.getElementById("myTopnav");
  var login = document.getElementById("login");
  var register = document.getElementById("register");

  if (login.style["float"] === "right" && register.style["float"] === "right") {
    login.style += "left";
    register.style += "left";
  }
  if (x.className === "topnav") {
    x.className += " responsive";
    if (x.style["float"] === "right") {
      x.style += "left";
    }
  } else {
    x.className = "topnav";
    login.style += "right";
    register.style += "right";
  }
}
