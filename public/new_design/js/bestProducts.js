const productsData = [
  {
    id: 10952,
    title: "IL105 Sensai Red Lipstick",
    image:
      "https://trendatt.com/assets/images/products/min/image_66d72b9cc4ad72198.jpeg",
      price: "22"
  },
  {
    id: 5961,
    title: "Anti-Aging Flash",
    image:
      "https://trendatt.com/assets/images/products/min/image_667e796c8ca1f5588.jpeg",
      price: "11.97"
  },
  {
    id: 3703,
    title: "18K Necklace 1.2",
    image:
      "https://trendatt.com/assets/images/products/min/image_662d69c6662bc5887.jpeg",
      price: "55.4"
  },
  {
    id: 18543,
    title: "TopFace Skin Editor",
    image:
      "https://trendatt.com/assets/images/products/min/image_663c440518cf07400.jpeg",
      price: "1.4"
  },
  {
    id: 11533,
    title: "L'Insoumis Ma Force",
    image:
      "https://trendatt.com/assets/images/products/min/image_66e93c556a9176650.png",
      price: "2"
  },
  {
      id: 6085,
      title: "Defender Blue Dark",
      image: "https://trendatt.com/assets/images/products/min/image_6659ac629299d4891.jpeg",
      price: "79.47"
    },
    {
      id: 11571,
      title: "Marie Glam - Hydra Lip Gloss",
      image: "https://trendatt.com/assets/images/products/min/image_66e99d95302488696.jpeg",
      price: "2"
    },
    {
      id: 11513,
      title: "Marie Glam - HD Compact Powder",
      image: "https://trendatt.com/assets/images/products/min/image_66e8f6a5b2a5e5092.jpeg",
      price: "3.5"
    },
    {
      id: 12568,
      title: "Marie Glam - 24 Piece Nail Set",
      image: "https://trendatt.com/assets/images/products/min/image_66f94dbd7fe624142.jpeg",
      price: "1"
    },
    {
      id: 6397,
      title: "Sheikh Al Kar Aleppo Soap",
      image: "https://trendatt.com/assets/images/products/min/image_665d4c8585d1a6050.jpeg",
      price: "11.97"
    },
    {
    id: 4335,
    title: "Bio Natural Vitamin",
    image: "https://trendatt.com/assets/images/products/min/image_6636004646bca7511.jpeg",
    price: "8.5",
    url: "https://trendatt.com/ar/product/4335"
  },
  {
    id: 7243,
    title: "Aqua Di Italia – Shower Gel",
    image: "https://trendatt.com/assets/images/products/min/image_666d35a8d4bf14661.jpeg",
    price: "6.25",
    url: "https://trendatt.com/ar/product/7243"
  },
  {
    id: 6557,
    title: "Spirit Felici EVERL",
    image: "https://trendatt.com/assets/images/products/min/image_665eda24e44fd1950.jpeg",
    price: "25",
    url: "https://trendatt.com/ar/product/6557"
  },
  {
    id: 6022,
    title: "Defender M Green for Men",
    image: "https://trendatt.com/assets/images/products/min/image_66587430a0c895911.jpeg",
    price: "88.37",
    url: "https://trendatt.com/ar/product/6022"
  },
  {
    id: 1942,
    title: "Marie Glam Lashes 110",
    image: "https://trendatt.com/assets/images/products/min/image_65fe8e8a14efc6292.jpeg",
    price: "1.5",
    url: "https://trendatt.com/ar/product/1942"
  },
  {
    id: 7972,
    title: "Real Techniques Brush Set",
    image: "https://trendatt.com/assets/images/products/min/image_668436594a8cb3116.jpeg",
    price: "11.5",
    url: "https://trendatt.com/ar/product/7972"
  }
];


productsData.map(items=> {
  let html = "";
  html = `
          <div class="col-md-3 col-6 my-3">
            <div class="brand-card">
            <div class="overflow-hidden">
              <a href="details.html"><img src="${items.image}" class="img-fluid" alt=""></a>
              </div>
              <div class="py-3">
              <a href="details.html">${items.title.split(" ", 2).join(" ")}</a>
              <p class="mt-2">${items.price} KWD</p>
              <div class="d-flex align-items-center justify-content-between mt-4">
              <button class="btn btn-black">Buy Now</button>

                <svg
                  width="20"
                  height="19"
                  viewBox="0 0 20 19"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M4.84141 1.07812C3.99636 1.35026 3.27306 1.77279 2.67149 2.3457C2.06993 2.9043 1.60444 3.55599 1.27501 4.30078C0.945581 5.04557 0.766545 5.85482 0.737899 6.72852C0.69493 7.60221 0.816675 8.47591 1.10313 9.34961C1.38959 10.166 1.76199 10.943 2.22032 11.6807C2.67865 12.4183 3.21576 13.0879 3.83165 13.6895C4.24701 14.1048 4.6767 14.4987 5.12071 14.8711C5.5504 15.2578 5.99441 15.6302 6.45274 15.9883C6.91108 16.3464 7.38373 16.6901 7.87071 17.0195C8.34337 17.349 8.83035 17.6712 9.33165 17.9863L9.54649 18.1152C9.66108 18.1725 9.77924 18.2012 9.90098 18.2012C10.0227 18.2012 10.1409 18.1725 10.2555 18.1152L10.4703 17.9863C10.9573 17.6712 11.4371 17.349 11.9098 17.0195C12.3968 16.6901 12.8694 16.3464 13.3277 15.9883C13.7861 15.6302 14.2301 15.265 14.6598 14.8926C15.1038 14.5059 15.5335 14.112 15.9488 13.7109C16.5647 13.0951 17.1054 12.4219 17.5709 11.6914C18.0364 10.9609 18.4052 10.1803 18.6774 9.34961C18.9638 8.47591 19.0856 7.60221 19.0426 6.72852C19.0139 5.85482 18.8349 5.04557 18.5055 4.30078C18.1761 3.55599 17.7106 2.9043 17.109 2.3457C16.5074 1.77279 15.7841 1.35026 14.9391 1.07812L14.7027 1.01367C13.9293 0.798828 13.1487 0.741537 12.3609 0.841797C11.5732 0.942057 10.8284 1.18555 10.1266 1.57227L9.89024 1.72266L9.65391 1.57227C8.92345 1.1569 8.13927 0.90625 7.30138 0.820312C6.46348 0.734375 5.6435 0.820312 4.84141 1.07812ZM9.31016 2.94727L9.50352 3.07617C9.61811 3.16211 9.74701 3.20508 9.89024 3.20508C10.0335 3.20508 10.1695 3.16211 10.2984 3.07617C10.9 2.61784 11.5768 2.32422 12.3287 2.19531C13.0807 2.06641 13.8147 2.11654 14.5309 2.3457C15.1897 2.56055 15.7483 2.88997 16.2066 3.33398C16.6793 3.778 17.041 4.2972 17.2916 4.8916C17.5423 5.486 17.6819 6.12695 17.7106 6.81445C17.7392 7.51628 17.6389 8.22526 17.4098 8.94141C17.1663 9.65755 16.8404 10.3379 16.4322 10.9824C16.024 11.627 15.555 12.2142 15.025 12.7441L14.5309 13.1953C13.8863 13.8112 13.2096 14.3913 12.5006 14.9355C11.7916 15.4798 11.0647 15.9954 10.3199 16.4824L9.89024 16.7402L10.0191 16.8262C9.07384 16.2533 8.16075 15.623 7.27989 14.9355C6.39903 14.248 5.55756 13.5176 4.75548 12.7441C4.22553 12.2142 3.75645 11.6234 3.34825 10.9717C2.94005 10.32 2.6142 9.63607 2.37071 8.91992C2.14154 8.2181 2.04128 7.51628 2.06993 6.81445C2.09858 6.12695 2.23822 5.486 2.48888 4.8916C2.73953 4.2972 3.10118 3.778 3.57384 3.33398C4.03217 2.88997 4.59076 2.56055 5.24962 2.3457C5.93712 2.13086 6.63894 2.07715 7.35509 2.18457C8.07123 2.29199 8.72293 2.54622 9.31016 2.94727ZM13.4352 4.45117C13.2633 4.39388 13.095 4.4082 12.9303 4.49414C12.7656 4.58008 12.6546 4.70898 12.5973 4.88086C12.54 5.05273 12.5543 5.22103 12.6402 5.38574C12.7262 5.55046 12.8551 5.66146 13.027 5.71875C13.3707 5.83333 13.6572 6.03385 13.8863 6.32031C14.1155 6.60677 14.2444 6.9362 14.2731 7.30859C14.2874 7.49479 14.3662 7.64518 14.5094 7.75977C14.6526 7.87435 14.8173 7.92448 15.0035 7.91016C15.1897 7.89583 15.3437 7.81706 15.4654 7.67383C15.5872 7.5306 15.6337 7.36589 15.6051 7.17969C15.5621 6.54948 15.3401 5.98372 14.9391 5.48242C14.538 4.98112 14.0367 4.63737 13.4352 4.45117Z"
                    fill="black"
                  ></path>
                </svg>
              </div>
                </div>
            </div>
          </div>
  `
  document.querySelector(".bestProduct-parent").innerHTML += html
})
