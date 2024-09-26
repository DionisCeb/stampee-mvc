/**Navigation adaptif*/
const toggleBtnSelector = ".toggle_btn";
const imgSelector = ".toggle_btn img";
const dropDownMenuSelector = ".dropdown_menu";

const toggleBtn = document.querySelector(toggleBtnSelector);
const toggleBtnImgs = document.querySelectorAll(imgSelector);
const dropDownMenu = document.querySelector(dropDownMenuSelector);

function init() {
    toggleBtn.addEventListener("click", toggleMenu);
    document.addEventListener("click", handleOutsideClick);
}

function toggleMenu() {
    if (dropDownMenu.classList.contains("open")) {
        closeMenu();
        updateImages("https://img.icons8.com/?size=100&id=36389&format=png&color=808080");
    } else {
        openMenu();
        updateImages("https://img.icons8.com/?size=100&id=46&format=png&color=808080");
    }
}

function openMenu() {
    dropDownMenu.classList.add("open");
    dropDownMenu.classList.remove("close");
}

function closeMenu() {
    dropDownMenu.classList.remove("open");
    dropDownMenu.classList.add("close");
}

function updateImages(src) {
    toggleBtnImgs.forEach((img) => {
        img.src = src;
    });
}

function handleOutsideClick(event) {
    const isClickInside = toggleBtn.contains(event.target) || dropDownMenu.contains(event.target);
    if (!isClickInside) {
        closeMenu();
        updateImages("https://img.icons8.com/?size=100&id=36389&format=png&color=808080");
    }
}

// Initialize the dropdown functionality
init();


  /** Custom Dropdown Implementation */
document.addEventListener('DOMContentLoaded', function() {
  var selectElements = document.getElementsByClassName("custom-select");
  for (var i = 0; i < selectElements.length; i++) {
      var selElmnt = selectElements[i].getElementsByTagName("select")[0];
      var selectedDiv = document.createElement("DIV");
      selectedDiv.setAttribute("class", "select-selected");
      selectedDiv.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
      selectElements[i].appendChild(selectedDiv);

      var itemsDiv = document.createElement("DIV");
      itemsDiv.setAttribute("class", "select-items select-hide");
      for (var j = 1; j < selElmnt.length; j++) {
          var itemDiv = document.createElement("DIV");
          itemDiv.innerHTML = selElmnt.options[j].innerHTML;
          itemDiv.addEventListener("click", function(e) {
              var y, k, s, h;
              s = this.parentNode.parentNode.getElementsByTagName("select")[0];
              h = this.parentNode.previousSibling;
              for (k = 0; k < s.length; k++) {
                  if (s.options[k].innerHTML == this.innerHTML) {
                      s.selectedIndex = k;
                      h.innerHTML = this.innerHTML;
                      y = this.parentNode.getElementsByClassName("same-as-selected");
                      for (var l = 0; l < y.length; l++) {
                          y[l].removeAttribute("class");
                      }
                      this.setAttribute("class", "same-as-selected");
                      break;
                  }
              }
              h.click();
          });
          itemsDiv.appendChild(itemDiv);
      }
      selectElements[i].appendChild(itemsDiv);
      selectedDiv.addEventListener("click", function(e) {
          e.stopPropagation();
          closeAllSelect(this);
          this.nextSibling.classList.toggle("select-hide");
          this.classList.toggle("select-arrow-active");
      });
  }
  
  function closeAllSelect(elmnt) {
      var x, y, arrNo = [];
      x = document.getElementsByClassName("select-items");
      y = document.getElementsByClassName("select-selected");
      for (var i = 0; i < y.length; i++) {
          if (elmnt == y[i]) {
              arrNo.push(i)
          } else {
              y[i].classList.remove("select-arrow-active");
          }
      }
      for (var i = 0; i < x.length; i++) {
          if (arrNo.indexOf(i)) {
              x[i].classList.add("select-hide");
          }
      }
  }

  document.addEventListener("click", closeAllSelect);
});