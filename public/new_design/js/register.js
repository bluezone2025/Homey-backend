
let registerLink = document.querySelectorAll(".register-top .linkTop");

registerLink.forEach(items=> {
  items.onclick = function (e) {
    e.preventDefault();
    registerLink.forEach(items=> items.classList.remove("active"))
    this.classList.add("active")
  }
})


let allTabsReg = document.querySelectorAll(".linkTop");

allTabsReg.forEach((el) => {
  el.onclick = function () {
    allTabsReg.forEach((items) => items.classList.remove("active"));
    this.classList.add("active");
    document
      .querySelectorAll(".rgister-hidden")
      .forEach((el) => el.classList.remove("active"));
    document
      .querySelector("#" + this.getAttribute("data-link"))
      .classList.add("active");
  };
});

