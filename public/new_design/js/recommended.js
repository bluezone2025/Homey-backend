const recProducts = [
  {
    id: "2344",
    title: "Mary Glam Nail Polish",
    image: "https://trendatt.com/assets/images/products/min/image_6603f3dfe35ca6464.png",
    price: "0.75 ",
    url: "https://trendatt.com/ar/product/2344"
  },
  {
    id: "10850",
    title: "Sensai Lasting Plump",
    image: "https://trendatt.com/assets/images/products/min/image_66d2fd465c6b37894.jpeg",
    price: "14.5 ",
    url: "https://trendatt.com/ar/product/10850"
  },
  {
    id: "6109",
    title: "Ariess Limited Green",
    image: "https://trendatt.com/assets/images/products/min/image_6659d056989d83664.jpeg",
    price: "98.15 ",
    url: "https://trendatt.com/ar/product/6109"
  },
  {
    id: "15398",
    title: "NIP+FAB Purify",
    image: "https://trendatt.com/assets/images/products/min/image_6744c7b6731c43812.jpeg",
    price: "8 ",
    url: "https://trendatt.com/ar/product/15398"
  },
  {
    id: "6114",
    title: "Rozva Gold Women",
    image: "https://trendatt.com/assets/images/products/min/image_6659d40142f985259.jpeg",
    price: "71.47 ",
    url: "https://trendatt.com/ar/product/6114"
  },
  {
    id: "15044",
    title: "AXIS-Y Biome Cream",
    image: "https://trendatt.com/assets/images/products/min/image_6741bf8dd54dc3574.jpeg",
    price: "11.3 ",
    url: "https://trendatt.com/ar/product/15044"
  },
  {
    id: "3088",
    title: "New Smart Toothpaste",
    image: "https://trendatt.com/assets/images/products/min/image_662386dee11798694.jpeg",
    price: "2.1 ",
    url: "https://trendatt.com/ar/product/3088"
  },
  {
    id: "15300",
    title: "NIP + FAB Hydrate Fix",
    image: "https://trendatt.com/assets/images/products/min/image_674411b544a583975.jpeg",
    price: "15 ",
    url: "https://trendatt.com/ar/product/15300"
  },
  {
    id: "15372",
    title: "COSRX Charcoal Mask",
    image: "https://trendatt.com/assets/images/products/min/image_6744a5a3bd3cb2551.jpeg",
    price: "9 ",
    url: "https://trendatt.com/ar/product/15372"
  },{
    id: "16487",
    title: "Fresh Line - Hair Care Set",
    image: "https://trendatt.com/assets/images/products/min/image_6755eca3280558730.jpeg",
    price: "9.2 ",
    url: "https://trendatt.com/ar/product/16487"
  },
  {
    id: "12483",
    title: "NAJ OLEARI - Lip Gloss",
    image: "https://trendatt.com/assets/images/products/min/image_66f8ca4c09c482160.jpeg",
    price: "6 ",
    url: "https://trendatt.com/ar/product/12483"
  },
  {
    id: "12205",
    title: "BU - Herbal Massage Oil",
    image: "https://trendatt.com/assets/images/products/min/image_66f2c27b3bffb6023.jpeg",
    price: "13 ",
    url: "https://trendatt.com/ar/product/12205"
  }
];

for (let i = 0; i <= recProducts.length - 9; i++) {
  let html = "";
  html = `
          <div class="col-md-3 col-6 my-3">
            <div class="brand-card">
            <div class="overflow-hidden">
              <a href="details.html"><img src="${recProducts[i].image}" class="img-fluid" alt=""></a>
              </div>
              <div class="py-3">
                             <a href="details.html">${recProducts[i].title.split(" ", 2).join(" ")}</a>
              <p class="mt-2">${recProducts[i].price} KWD</p>
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
  document.querySelector(".recommendedProducts").innerHTML += html
}
