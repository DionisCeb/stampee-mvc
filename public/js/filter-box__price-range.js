var slide = document.getElementById("price");
var range_price = document.querySelector(".filter-box__price-range-value");
range_price.innerHTML = slide.value;

slide.oninput = function () {
  range_price.innerHTML = this.value;
};
/* Source : https://www.w3schools.com/howto/howto_js_rangeslider.asp */
