/**Navigation adaptif*/
const toggleBtn = document.querySelector(".toggle_btn");
const toggleBtnImgs = document.querySelectorAll(".toggle_btn img");
const dropDownMenu = document.querySelector(".dropdown_menu");

toggleBtn.onclick = function () {
    // Add the 'open' class to display the menu
    dropDownMenu.classList.add("open");
    dropDownMenu.classList.remove("close"); // Ensure 'close' class is removed
  
    // Update image sources to reflect menu state
    toggleBtnImgs.forEach((img) => {
      img.src = "./assets/img/icons/nav/close.svg";
    });
  };
  
  // Function to close the dropdown menu
  function closeDropDownMenu() {
    // Remove the 'open' class to hide the menu
    dropDownMenu.classList.remove("open");
    // Add the 'close' class to ensure menu is hidden
    dropDownMenu.classList.add("close");
  
    // Update image sources to reflect menu state
    toggleBtnImgs.forEach((img) => {
      img.src = "./assets/img/icons/nav/nav_bar.svg";
    });
  }
  
  // Close the dropdown menu when clicking outside of it
  document.addEventListener("click", function (event) {
    const isClickInside = toggleBtn.contains(event.target) || dropDownMenu.contains(event.target);
    if (!isClickInside) {
      closeDropDownMenu();
    }
  });
  
  // to close the dropdown menu when the toggle button is clicked again
  toggleBtn.onclick = function () {
    if (dropDownMenu.classList.contains("open")) {
      closeDropDownMenu();
    } else {
      dropDownMenu.classList.add("open");
      dropDownMenu.classList.remove("close");
  
      toggleBtnImgs.forEach((img) => {
        img.src = "./assets/img/icons/nav/close.svg";
      });
    }
  };

  /*Auth pop-up*/
  document.addEventListener('DOMContentLoaded', function() {
    const btnConnection = document.querySelector('.btn-connection');

    // Function to create and show the popup
    function showPopup() {
        // Create popup container
        const popup = document.createElement('div');
        popup.id = 'popup';
        popup.className = 'popup';
        
        // Create popup content
        const popupContent = document.createElement('div');
        popupContent.className = 'popup-content';
        
        // Create and add close button
        const closeButton = document.createElement('span');
        closeButton.className = 'popup-close';
        closeButton.innerHTML = '&times;';
        popupContent.appendChild(closeButton);
        
        // Create and add popup info
        const popupInfo = document.createElement('div');
        popupInfo.className = 'pop-up-info';
        popupInfo.innerHTML = `
            <h2>Authentification</h2>
            <button class="btn action_btn btn-login">Se connecter</button>
            <button class="btn action_btn btn-create-account">Créer un compte</button>
        `;
        popupContent.appendChild(popupInfo);

        // Append popup content to popup container
        popup.appendChild(popupContent);
        
        // Append popup container to the body
        document.body.appendChild(popup);

        // Show the popup
        popup.style.display = 'flex';

        // Handle close button click
        closeButton.addEventListener('click', function() {
            popup.style.display = 'none';
            setTimeout(() => document.body.removeChild(popup), 300); // Remove after animation
        });

        // Handle click outside popup to close it
        window.addEventListener('click', function(event) {
            if (event.target === popup) {
                popup.style.display = 'none';
                setTimeout(() => document.body.removeChild(popup), 300); // Remove after animation
            }
        });
    }

    // Show the popup when the button is clicked
    btnConnection.addEventListener('click', function(event) {
        event.preventDefault();
        showPopup();
    });
});


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