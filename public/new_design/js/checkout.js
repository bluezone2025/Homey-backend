let allTabsCheck = document.querySelectorAll(".tabs-checkout");

allTabsCheck.forEach((el) => {
  el.onclick = function () {
    allTabsCheck.forEach((items) => items.classList.remove("active"));
    this.classList.add("active");
    document
      .querySelectorAll(".tab-hidden")
      .forEach((el) => el.classList.remove("active"));
    document
      .querySelector("#" + this.getAttribute("data-tab"))
      .classList.add("active");
  };
});

