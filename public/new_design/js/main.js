$(()=> {
  $(".owl-brands").owlCarousel({
    loop: true,
    items: 4,
    nav: true,
    dots: false,
        responsiveClass: true,
    navText: ['<i class="fa-solid fa-arrow-left"></i>', '<i class="fa-solid fa-arrow-right"></i>'],
            responsive: {
            0: {
                items: 2,
                nav: true
            },
            500: {
                items: 2,
                nav: true,
                margin: 0
            },
            601: {
                items: 6,
                nav: true
            }
        }
  });
   $(".owl-trends").owlCarousel({
      loop: true,
      items: 4,
      nav: true,
      dots: false,
          responsiveClass: true,
      navText: ['<i class="fa-solid fa-arrow-left"></i>', '<i class="fa-solid fa-arrow-right"></i>'],
              responsive: {
              0: {
                  items: 2,
                  nav: true
              },
              500: {
                  items: 2,
                  nav: true,
                  margin: 0
              },
              601: {
                  items: 4,
                  nav: true
              }
          }
    });


   $(".owl-new-products").owlCarousel({
      loop: true,
      items: 4,
      nav: true,
      dots: false,
          responsiveClass: true,
      navText: ['<i class="fa-solid fa-arrow-left"></i>', '<i class="fa-solid fa-arrow-right"></i>'],
              responsive: {
              0: {
                  items: 2,
                  nav: true
              },
              500: {
                  items: 2,
                  nav: true,
                  margin: 0
              },
              601: {
                  items: 4,
                  nav: true
              }
          }
    })

   $(".owl-recommended-products").owlCarousel({
          loop: true,
          items: 4,
          nav: true,
          dots: false,

              responsiveClass: true,
          navText: ['<i class="fa-solid fa-arrow-left"></i>', '<i class="fa-solid fa-arrow-right"></i>'],
                  responsive: {
                  0: {
                      items: 2,
                      nav: true
                  },
                  500: {
                      items: 2,
                      nav: true,
                      margin: 0
                  },
                  601: {
                      items: 4,
                      nav: true
                  }
              }
        })

   $(".owl-product-images").owlCarousel({
                  loop: true,
                  items: 4,
                  nav: true,
                  dots: false,
                   autoplay: true,        // ✅ Enables autoplay
                        autoplayTimeout: 3000, // Time between slides in ms (3000 = 3s)
                        autoplayHoverPause: true ,// Pause on hover
                      responsiveClass: true,
                  navText: ['<i class="fa-solid fa-arrow-left"></i>', '<i class="fa-solid fa-arrow-right"></i>'],
                          responsive: {
                          0: {
                              items: 1,
                              nav: true
                          },
                          500: {
                              items: 1,
                              nav: true,
                              margin: 0
                          },
                          601: {
                              items: 1,
                              nav: true
                          }
                      }
                })

})

