let calcHeader = document.querySelector("header");

document.body.style.paddingTop = calcHeader.clientHeight + "px";

window.onresize = function () {
document.body.style.paddingTop = calcHeader.clientHeight + "px";

}


let shoppingCart = document.querySelector(".shopping");
let closeShopping = document.querySelector(".cart-overlay .close");
let cartOverlay = document.querySelector(".cart-overlay")
let cartInner = document.querySelector(".cart-inner")
shoppingCart.onclick = function () {
  cartOverlay.classList.add("active")
  cartInner.classList.add("active")
}

closeShopping.onclick = function () {
  cartOverlay.classList.remove("active")
  cartInner.classList.remove("active")
}


// Close cart by clicking anywhere outside cartInner
document.addEventListener("click", function (e) {
  // if cart is open and click is NOT inside cartInner or on shoppingCart
  if (
    cartOverlay.classList.contains("active") &&
    !cartInner.contains(e.target) &&
    !shoppingCart.contains(e.target)
  ) {
    cartOverlay.classList.remove("active");
    cartInner.classList.remove("active");
  }
});

const openSearch = document.querySelector(".open-search");
const openSearch2 = document.querySelector(".open-search2");
const closeSearch = document.querySelector(".search-inner .close");
const searchOver = document.querySelector(".search-overlay")

window.onclick = function (e) {
  if (e.target == searchOver) {
    searchOver.classList.remove("active")
    searchOver.children[0].classList.remove("active")
  }
}


openSearch.onclick = function () {
  searchOver.classList.add("active")
  searchOver.children[0].classList.add("active")
 setTimeout(() => {
        document.getElementById('searchInput').focus();
    }, 100); // delay بسيط للتأكد أن العنصر ظهر
}
openSearch2.onclick = function () {
  searchOver.classList.add("active")
  searchOver.children[0].classList.add("active")
 setTimeout(() => {
        document.getElementById('searchInput').focus();
    }, 100); // delay بسيط للتأكد أن العنصر ظهر
}

closeSearch.onclick = function () {
  searchOver.classList.remove("active")
  searchOver.children[0].classList.remove("active")
}

//const bars = document.querySelector(".bars");
//const nav = document.querySelector(".nav");
//
//bars.onclick = function () {
//  nav.classList.toggle("active")
//}
