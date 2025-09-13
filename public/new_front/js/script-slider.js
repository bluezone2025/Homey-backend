
// slideContentOne
var slideContentOne = new Swiper(".slide-content-one", {
    slidesPerView: 1,
    spaceBetween: 25,
    loop: true,
    centerSlide: 'true',
    fade: 'true',
    grabCursor: 'true',
    autoplay: {
      delay: 5000,
      disableOnInteraction: false,
      },
    pagination: {
      el: ".swiper-pagination.one",
      clickable: true,
      dynamicBullets: true,
    },
    navigation: {
      nextEl: ".swiper-button-next.one",
      prevEl: ".swiper-button-prev.one",
    },

    breakpoints:{
        0: {
            slidesPerView: 1,
        },
        520: {
            slidesPerView: 1,
        },
        768: {
          slidesPerView: 1,
      },
        950: {
            slidesPerView: 1,
        },
    },
  });

// slideContentTwo
  var slideContentTwo = new Swiper(".slide-content-two", {
    slidesPerView: 4,
    spaceBetween: 25,
    loop: false,
    centerSlide: 'true',
    fade: 'true',
    grabCursor: 'true',
    // autoplay: {
    //   delay: 3000,
    //   disableOnInteraction: false,
    //   },
    pagination: {
      el: ".swiper-pagination.two",
      clickable: true,
      dynamicBullets: true,
    },
    navigation: {
      nextEl: ".swiper-button-next.two",
      prevEl: ".swiper-button-prev.two",
    },

    breakpoints:{
        0: {
            slidesPerView: 3,
        },
        520: {
            slidesPerView: 3,
        },
        768: {
          slidesPerView: 4,
      },
        950: {
            slidesPerView: 6,
        },
    },
  });


  // slide-content-Shop_by_category
  var slideContentTwo = new Swiper(".slide-content-Shop_by_category", {
    slidesPerView: 4,
    spaceBetween: 25,
    loop: false,
    centerSlide: 'true',
    fade: 'true',
    grabCursor: 'true',
    // autoplay: {
    //   delay: 3000,
    //   disableOnInteraction: false,
    //   },
    pagination: {
      el: ".swiper-pagination.Shop_by_category",
      clickable: true,
      dynamicBullets: true,
    },
    navigation: {
      nextEl: ".swiper-button-next.Shop_by_category",
      prevEl: ".swiper-button-prev.Shop_by_category",
    },

    breakpoints:{
        0: {
            slidesPerView: 3,
        },
        520: {
            slidesPerView: 3,
        },
        768: {
          slidesPerView: 4,
      },
        950: {
            slidesPerView: 5,
        },
    },
  });

  // slide-content-offers

  var slideContentTwo = new Swiper(".slide-content-offers", {
    slidesPerView: 1,
    spaceBetween: 25,
    loop: false,
    centerSlide: 'true',
    fade: 'true',
    grabCursor: 'true',
    autoplay: {
      delay: 3000,
      disableOnInteraction: false,
      },
    pagination: {
      el: ".swiper-pagination.offers",
      clickable: true,
      dynamicBullets: true,
    },
    navigation: {
      nextEl: ".swiper-button-next.offers",
      prevEl: ".swiper-button-prev.offers",
    },

    breakpoints:{
        0: {
            slidesPerView: 2,
        },
        520: {
            slidesPerView: 2,
        },
        768: {
          slidesPerView: 3,
      },
      992: {
        slidesPerView: 4,
      },
      1200: {
          slidesPerView: 5,
      },
    },
  });

  // ******************************************************

  // slide-content-sale_two
  var slideContentSaleTwo = new Swiper(".slide-content-sale_two", {
    slidesPerView: 1,
    spaceBetween: 25,
    loop: false,
    centerSlide: 'true',
    fade: 'true',
    grabCursor: 'true',
    // autoplay: {
    //   delay: 3000,
    //   disableOnInteraction: false,
    //   },
    pagination: {
      el: ".swiper-pagination.sale_two",
      clickable: true,
      dynamicBullets: true,
    },
    navigation: {
      nextEl: ".swiper-button-next.sale_two",
      prevEl: ".swiper-button-prev.sale_two",
    },

    breakpoints:{
        0: {
            slidesPerView: 2,
        },
        520: {
            slidesPerView: 2,
        },
        768: {
          slidesPerView: 3,
      },
      992: {
        slidesPerView: 4,
      },
      1200: {
          slidesPerView: 5,
      },
    },
  });

  // ******************************************************
  
  // slide-content-sale_one
  var slideContentSaleOne = new Swiper(".slide-content-sale_one", {
    slidesPerView: 1,
    spaceBetween: 25,
    loop: false,
    centerSlide: 'true',
    fade: 'true',
    grabCursor: 'true',
    // autoplay: {
    //   delay: 3000,
    //   disableOnInteraction: false,
    //   },
    pagination: {
      el: ".swiper-pagination.sale_one",
      clickable: true,
      dynamicBullets: true,
    },
    navigation: {
      nextEl: ".swiper-button-next.sale_one",
      prevEl: ".swiper-button-prev.sale_one",
    },

    breakpoints:{
        0: {
            slidesPerView: 2,
        },
        520: {
            slidesPerView: 2,
        },
        768: {
          slidesPerView: 3,
      },
      992: {
        slidesPerView: 4,
      },
      1200: {
          slidesPerView: 5,
      },
    },
  });

  // ******************************************************

  // slideContentBanner
var slideContentBanner = new Swiper(".slide-content-banner", {
  slidesPerView: 1,
  spaceBetween: 25,
  loop: true,
  centerSlide: 'true',
  fade: 'true',
  grabCursor: 'true',
  autoplay: {
    delay: 5000,
    disableOnInteraction: false,
    },
  pagination: {
    el: ".swiper-pagination.banner",
    clickable: true,
    dynamicBullets: true,
  },
  navigation: {
    nextEl: ".swiper-button-next.banner",
    prevEl: ".swiper-button-prev.banner",
  },

  breakpoints:{
      0: {
          slidesPerView: 1,
      },
      520: {
          slidesPerView: 1,
      },
      768: {
        slidesPerView: 1,
    },
      950: {
          slidesPerView: 1,
      },
  },
});

  // slideContentBannerTwo
  var slideContentBannerTwo = new Swiper(".slide-content-banner_two", {
    slidesPerView: 1,
    spaceBetween: 25,
    loop: true,
    centerSlide: 'true',
    fade: 'true',
    grabCursor: 'true',
    autoplay: {
      delay: 5000,
      disableOnInteraction: false,
      },
    pagination: {
      el: ".swiper-pagination.banner_two",
      clickable: true,
      dynamicBullets: true,
    },
    navigation: {
      nextEl: ".swiper-button-next.banner_two",
      prevEl: ".swiper-button-prev.banner_two",
    },
  
    breakpoints:{
        0: {
            slidesPerView: 1,
        },
        520: {
            slidesPerView: 1,
        },
        768: {
          slidesPerView: 1,
      },
        950: {
            slidesPerView: 1,
        },
    },
  });