const header = document.querySelector("header");
let lastScrollY = window.scrollY;
let scrollingUp = false;

window.addEventListener("scroll", () => {
  let currentScrollY = window.scrollY;

  // Affiche ou cache la navbar au scroll
  if (currentScrollY < lastScrollY) {
    scrollingUp = true;
  } else {
    scrollingUp = false;
  }

  if (scrollingUp) {
    header.style.transform = "translateY(0)";
    header.style.opacity = "1";
  } else {
    header.style.transform = "translateY(-100%)";
    header.style.opacity = "0";
  }

  // Met à jour la position du scroll
  lastScrollY = currentScrollY;
});

// const burgerMenu = document.querySelector(".burger_menu");
const mobileMenu = document.querySelector(".navbar_menu"); // Assurez-vous que cette sélection est correcte pour votre menu mobile

// if (burgerMenu) {
//     burgerMenu.addEventListener("click", () => {
//         mobileMenu.classList.toggle("open");
//     });
// }

document
  .getElementById("explore_contact")
  .addEventListener("click", function () {
    let target = document.querySelector(this.getAttribute("data-target"));

    if (target) {
      window.scrollTo({
        top: target.offsetTop,
        behavior: "smooth",
      });
      // if (mobileMenu.classList.contains("open")) { // Ferme le menu mobile après le clic
      //     mobileMenu.classList.remove("open");
      // }
    }
  });

document
  .getElementById("explore_projects")
  .addEventListener("click", function () {
    let target = document.querySelector(this.getAttribute("data-target"));

    if (target) {
      window.scrollTo({
        top: target.offsetTop,
        behavior: "smooth",
      });
    }
  });

document.getElementById("home").addEventListener("click", function () {
  let target = document.querySelector(this.getAttribute("data-target"));

  if (target) {
    window.scrollTo({
      top: target.offsetTop,
      behavior: "smooth",
    });
  }
});

document
  .getElementById("logo_Portfolio")
  .addEventListener("click", function () {
    let target = document.querySelector(this.getAttribute("data-target"));

    if (target) {
      window.scrollTo({
        top: target.offsetTop,
        behavior: "smooth",
      });
    }
  });

document
  .getElementById("logo_Portfolio_footer")
  .addEventListener("click", function () {
    let target = document.querySelector(this.getAttribute("data-target"));

    if (target) {
      window.scrollTo({
        top: target.offsetTop,
        behavior: "smooth",
      });
    }
  });
