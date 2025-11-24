function productFilter() {
  // open categry
  let filterCategory = document.querySelectorAll(".filter-category");
  let filterList = document.querySelectorAll(".filter-list");
  let listPadding = 18;
  // fist element always open
  if (filterList.length !== 0) {
    filterList[0].style.height =
      filterList[0].scrollHeight + listPadding + "px";
    filterList[0].style.maxHeight =
      filterList[0].scrollHeight + listPadding + "px";
  }
  for (let i = 0; i < filterCategory.length; i++) {
    filterCategory[i].onclick = function (e) {
      let filterListHeight = filterList[i].scrollHeight;
      let paddingB = 18;
      if (!e.target.closest(".active")) {
        filterCategory[i].classList.add("active");
        if (filterListHeight >= 300) {
          filterList[i].style.height =
            Math.ceil(filterListHeight / 2) + paddingB + listPadding + "px";
          filterList[i].style.maxHeight = filterListHeight + listPadding + "px";
          filterList[i].style.overflowY = `auto`;
        } else {
          filterList[i].style.height = filterListHeight + listPadding + "px";
          filterList[i].style.maxHeight = filterListHeight + listPadding + "px";
        }
      } else {
        filterCategory[i].classList.remove("active");
        filterList[i].style.maxHeight = "0";
      }
    };
  }
}
productFilter();

// open the menu sidebar
function menuSidebar(className) {
  let menuClassName = `.${className}`;
  let menuSidebar = document.querySelector(menuClassName);
  let headerBar = document.querySelector(".header-bar");
  let overlay = document.querySelector(".overlay");
  let hiddenBodyScollbar = document.querySelector("body");
  headerBar.onclick = function () {
    menuSidebar.style.transform = `translateX(0)`;
    menuSidebar.style.opacity = `1`;
    overlay.style.display = `block`;
    hiddenBodyScollbar.style.overflowY = `hidden`;
  };
}
menuSidebar("header-menu-sidebar");
// close the menu sidebar
let overlay = document.querySelector(".overlay");
let hiddenBodyScollbar = document.querySelector("body");

function closeMenuSidebar(className) {
  let menuClassName = `.${className}`;
  let menuSidebar = document.querySelector(menuClassName);
  let signUp = document.getElementById("register-modal");
  overlay.onclick = function () {
    menuSidebar.style.transform = `translateX(-100%)`;
    menuSidebar.style.opacity = `0`;
    overlay.style.display = `none`;
    if (modal1.style.display === "block") {
      modal1.style.display = "none";
    }
    if (signUp.style.display === "block") {
      signUp.style.display = "none";
    }
    hiddenBodyScollbar.style.overflowY = `auto`;
  };
}
closeMenuSidebar("header-menu-sidebar");
// click overlay close register
overlay.addEventListener("click", function () {
  if (signUp.style.top === "0px") {
    signUp.style.top = "-150%";
    signUp.style.opacity = "0";
  }
  if (modal1.style.top === "0px") {
    console.log("hello");
    modal1.style.top = "-124%";
    modal1.style.opacity = "0";
    overlay.style.display = `none`;
  }
});

// bắt sự kiện onscoll ở trình duyệt để hiển thị menu
function hiddenMenubar() {
  document.onscroll = function () {
    const scollTop = window.scrollY || document.documentElement.scrollTop;
    const header = document.querySelector(".header");
    if (scollTop >= 200) {
      header.classList.add("nav-active");
      header.style.justifyContent = `space-between`;
    } else {
      header.classList.remove("nav-active");
      header.style.justifyContent = ``;
    }
  };
}
// hiddenMenubar();

function hiddenOverlay() {
  overlay.style.display = `none`;
}
const openModalBtn = document.getElementById("open-modal-btn");
const modal1 = document.getElementById("my-modal");
const closeBtn = document.querySelector(".sign-in-close");
const form = document.querySelector("form");
const message = document.getElementById("message");

if (openModalBtn) {
  openModalBtn.addEventListener("click", () => {
    let menuSidebar = document.querySelector(".header-menu-sidebar");
    let hiddenBodyScollbar = document.querySelector("body");
    modal1.style.top = "0";
    modal1.style.opacity = "1";
    menuSidebar.style.transform = `translateX(-100%)`;
    // menuSidebar.style.opacity = `1`;
    hiddenBodyScollbar.style.overflowY = `auto`;
  });
}

const dangnhap_user = document.getElementById("dangnhap_user");
const dangki_user = document.getElementById("dangki_user");

const button = document.querySelector(".header-content-user");

const user_modal = document.querySelector(".modal_user");
const modal = document.querySelector(".user_modal_container");
button.addEventListener("click", () => {
  user_modal.classList.toggle("open");
});
modal.addEventListener("click", (e) => {
  e.stopPropagation();
});

user_modal.onclick = function (e) {
  user_modal.classList.toggle("open");
};
if (dangnhap_user) {
  dangnhap_user.addEventListener("click", function () {
    openModalBtn.click();
    user_modal.classList.toggle("open");
  });

  dangki_user.addEventListener("click", function () {
    openRegister.click();
    user_modal.classList.toggle("open");
  });
}

if (closeBtn) {
  closeBtn.addEventListener("click", () => {
    modal1.style.top = "-124%";
    modal1.style.opacity = "0";
    overlay.style.display = `none`;
  });
}

let openRegister = document.getElementById("register-button");

let open_icon_re = document.getElementById("icon_re");

let quenpass = document.getElementById("quenpass");
let signUp = document.getElementById("register-modal");
let quen = document.getElementById("quen-modal");
let closeButton = document.getElementById("close-button");
let close_quen = document.getElementById("close_quen");

if (openRegister) {
  openRegister.onclick = function () {
    let menuSidebar = document.querySelector(".header-menu-sidebar");
    signUp.style.top = "0";
    signUp.style.opacity = "1";
    menuSidebar.style.transform = `translateX(-100%)`;
    menuSidebar.style.opacity = `1`;
  };
}

// open_icon_re.onclick = function () {
//   let menuSidebar = document.querySelector(".header-menu-sidebar");
//   signUp.style.top = "0";
//   signUp.style.opacity = "1";
//   menuSidebar.style.transform = `translateX(-100%)`;
//   menuSidebar.style.opacity = `1`;
// };
if (quenpass) {
  quenpass.onclick = function () {
    let menuSidebar = document.querySelector(".header-menu-sidebar");
    let quen = document.getElementById("quen-modal"); // Thêm đoạn này nếu chưa có

    quen.style.top = "0";
    quen.style.opacity = "1";
    menuSidebar.style.transform = `translateX(-100%)`;
    menuSidebar.style.opacity = `1`;
  };
}

// close register
let closeRegister = document.querySelector("#close-button");
closeRegister.onclick = function () {
  hiddenOverlay();
  signUp.style.top = "-150%";
  signUp.style.opacity = "0";
};
// end close register
// close register
let closequen = document.querySelector("#close-quen");
close_quen.onclick = function () {
  hiddenOverlay();
  quen.style.top = "-150%";
  quen.style.opacity = 0;
};
// end close register

// increase value
function increaseValue(incValue, inputName, quantity, isquantity) {
  let increaseValue = document.querySelector(`${incValue}`);
  let incNumber = document.querySelector(`${inputName}`);
  let getQuantity = document.querySelector(`${quantity}`);
  if (increaseValue) {
    increaseValue.onclick = function () {
      let newValue = Number(incNumber.value);
      if (newValue < 1000000) {
        incNumber.value = newValue + 1;
      }
      if (isquantity) {
        getQuantity.textContent = incNumber.value;
      }
    };
  }
}
// increaseValue("#favoriteProduct-inc-plus", "#favoriteProduct-inc-quantity");
// increaseValue("#cartModal-inc-plus", "#cartModal-inc-quantity");
// increaseValue(
//   "#product-detail-inc-plus",
//   "#product-detail-inc-quantity",
//   "#product_detail_quantity",
//   true
// );
// end
// reduce value
function reduceValue(incValue, inputName, quantity, isquantity) {
  let reduceValue = document.querySelector(`${incValue}`);
  let reduceNumber = document.querySelector(`${inputName}`);
  let getQuantity = document.querySelector(`${quantity}`);
  if (reduceValue) {
    reduceValue.onclick = function () {
      // debugger
      let newValue = Number(reduceNumber.value);
      if (newValue > 1) {
        reduceNumber.value = newValue - 1;
      }
      if (isquantity) {
        getQuantity.textContent = reduceNumber.value;
      }
    };
  }
}
// reduceValue("#favoriteProduct-inc-minus", "#favoriteProduct-inc-quantity");
// reduceValue("#cartModal-inc-minus", "#cartModal-inc-quantity");

// reduceValue(
//   "#product-detail-inc-minus",
//   "#product-detail-inc-quantity",
//   "#product_detail_quantity",
//   true
// );
// end

// let containerQuantity = document.querySelector("#product-detail-inc-quantity");
// let getQuantity = document.querySelector("#product_detail_quantity");
// console.log(containerQuantity.value);
// containerQuantity.onchange = function () {
//   console.log("hello");
//   getQuantity.value = containerQuantity.value;
// };

// handle open modal

// handle open sidebar
function handleOpensTheSidebar(
  openButton,
  modal,
  sidebar,
  closeButton,
  modalClass,
  sidebarClass,
  isHiddenBodyScollbar
) {
  let openBtn = document.querySelector(`#${openButton}`);
  let openModal = document.querySelector(`#${modal}`);
  let sidebarName = document.querySelector(`#${sidebar}`);
  let closeSibar = document.querySelector(`#${closeButton}`);
  let hiddenBodyScollbar = document.querySelector("body");
  let isHandleHidenBodyScollbar = false;
  openBtn.addEventListener("click", function () {
    openModal.classList.add(`${modalClass}`);
    sidebarName.classList.add(`${sidebarClass}`);

    if (isHiddenBodyScollbar) {
      hiddenBodyScollbar.style.overflowY = "hidden";
      isHandleHidenBodyScollbar = true;
    }
  });
  // event wheb click hidden  modal
  openModal.addEventListener("click", function () {
    localStorage.setItem("openModal", false);
    handleCLoseTheSidebar(
      openModal,
      sidebarName,
      modalClass,
      sidebarClass,
      isHandleHidenBodyScollbar
    );
  });
  closeSibar.addEventListener("click", function () {
    handleCLoseTheSidebar(
      openModal,
      sidebarName,
      modalClass,
      sidebarClass,
      isHandleHidenBodyScollbar
    );
  });

  sidebarName.onclick = function (e) {
    e.stopPropagation();
  };
}
// handle close sidebar
function handleCLoseTheSidebar(
  modalName,
  sidebarName,
  modalClass,
  sidebarClass,
  isHiddenBodyScollbar
) {
  // let handleModalName = document.querySelector(`#${modalName}`);
  // let handleSidebarName = document.querySelector(`#${sidebarName}`);
  // localStorage.setItem("openModal",false);

  let hiddenBodyScollbar = document.querySelector("body");
  if (isHiddenBodyScollbar) {
    hiddenBodyScollbar.style.overflowY = "visible";
  }
  modalName.classList.remove(`${modalClass}`);
  sidebarName.classList.remove(`${sidebarClass}`);
}
// Open cart
// let openCart = document.querySelector("#header-content-cart");

// open favorite sidebar

handleOpensTheSidebar(
  "header-content-heart",
  "favoriteProduct-modal",
  "favoriteProduct",
  "favoriteProduct-header-close",
  "Fopen",
  "Fopen",
  true
);
// open cart sidebar
handleOpensTheSidebar(
  "header-content-cart",
  "cart-modal",
  "cart-modal-container",
  "cart-header-close",
  "cart-open",
  "cart-open",
  true
);

let continueBuy = document.querySelector(".close-cart-modal");
if (continueBuy) {
  let cartModal = document.querySelector(".cart-modal");
  let cartModalContainer = document.querySelector(".cart-modal-container");
  continueBuy.onclick = function () {
    let hiddenBodyScollbar = document.querySelector("body");
    hiddenBodyScollbar.style.overflowY = "visible";
    cartModal.classList.remove(`cart-open`);
    cartModalContainer.classList.remove(`cart-open`);
  };
}
