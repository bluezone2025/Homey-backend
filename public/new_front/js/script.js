// start Dropdown desktop
const optionMenuLang = document.querySelector(".select__menu__lang"),
selectBtnLang = document.querySelector(".select__btn__lang"),
optionsLang = document.querySelectorAll(".option__lang"),
sBtnTextLang = document.querySelector(".select__btn__lang .text")
// start Dropdown mob
optionMenuLangMob = document.querySelector(".select__menu__lang__mob"),
selectBtnLangMob = document.querySelector(".select__btn__lang__mob"),
optionsLangMob = document.querySelectorAll(".option__lang__mob"),
sBtnTextLangMob = document.querySelector(".select__btn__lang__mob .text")
// start menu show mob
menuBtn = document.querySelector(".menu__btn")
menuClose = document.querySelector(".menu__btn__close")
menuShow = document.querySelector(".menu_mob");




/////////////////////////////////////////////////////////////////////////////////////////
// menu show mob
menuBtn.addEventListener("click", () => {
    menuShow.classList.add("show");
    menuBtn.classList.add("d_none");
    menuClose.classList.add("d_flex");

});

// menu close mob
menuClose.addEventListener("click", () => {
  menuShow.classList.remove("show");
  menuBtn.classList.remove("d_none");
  menuClose.classList.remove("d_flex");
});

/////////////////////////////////////////////////////////////////////////////////////////
//selectBtnLang.addEventListener("click", () => optionMenuLang.classList.toggle("active"));
//
//optionsLang.forEach(option => {
//  option.addEventListener("click", () => {
//      let selectOptionLang = option.querySelector(".option__lang .text").innerText;
//      // sBtnText.innerText = selectOption;
//      console.log(selectOptionLang)
//      optionMenuLang.classList.remove("active");
//  })
//});

//  **********************************************


// end Dropdown

let PerviewProducts = document.querySelector(".products_preview"),
      previewBox = PerviewProducts.querySelectorAll(".preview");

      document.querySelectorAll(".container .icon_shopping").forEach(icon => (
        icon.onclick = () => {
          PerviewProducts.classList.add("active");
        }
      ));

      previewBox.forEach(close =>{
        close.querySelector(".preview .bx-x").onclick = () => {
          PerviewProducts.classList.remove("active");
        }
      })


/////////////////////////////////////////////////////////////////////////////////////////
//selectBtnLangMob.addEventListener("click", () => optionMenuLangMob.classList.toggle("active"));
//
//optionsLangMob.forEach(option => {
//  option.addEventListener("click", () => {
//      let selectOptionLangMob = option.querySelector(".option__lang__mob .text").innerText;
//      // sBtnText.innerText = selectOption;
//      console.log(selectOptionLangMob)
//      optionMenuLangMob.classList.remove("active");
//  })
//});

//  **********************************************


;
