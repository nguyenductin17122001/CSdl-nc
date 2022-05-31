const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item => {
  const li = item.parentElement;

  item.addEventListener('click', function () {
    allSideMenu.forEach(i => {
      i.parentElement.classList.remove('active');
    })
    li.classList.add('active');
  })
});

// -------------------------------
let contactForm = document.querySelector('.contact-form');

document.querySelector('#notifications').onclick = () => {
  contactForm.classList.toggle('active');
  historyForm.classList.remove('active');
}

// --------------
let historyForm = document.querySelector('.history-form');

document.querySelector('#notificationsone').onclick = () => {
  historyForm.classList.toggle('active');
  contactForm.classList.remove('active');
}
// ------------------------------



// TOGGLE SIDEBAR
const menuBar = document.querySelector('#content nav .bx.bx-menu');
const sidebar = document.getElementById('sidebar');

menuBar.addEventListener('click', function () {
  sidebar.classList.toggle('hide');
})







const searchButton = document.querySelector('#content nav form .form-input button');
const searchButtonIcon = document.querySelector('#content nav form .form-input button .bx');
const searchForm = document.querySelector('#content nav form');

searchButton.addEventListener('click', function (e) {
  if (window.innerWidth < 576) {
    e.preventDefault();
    searchForm.classList.toggle('show');
    if (searchForm.classList.contains('show')) {
      searchButtonIcon.classList.replace('bx-search', 'bx-x');
    } else {
      searchButtonIcon.classList.replace('bx-x', 'bx-search');
    }
  }
})





if (window.innerWidth < 768) {
  sidebar.classList.add('hide');
} else if (window.innerWidth > 576) {
  searchButtonIcon.classList.replace('bx-x', 'bx-search');
  searchForm.classList.remove('show');
}


window.addEventListener('resize', function () {
  if (this.innerWidth > 576) {
    searchButtonIcon.classList.replace('bx-x', 'bx-search');
    searchForm.classList.remove('show');
  }
})

// =================
const inputs = document.querySelectorAll(".form__input")

/*=== Add focus ===*/
function addfocus() {
  let parent = this.parentNode.parentNode
  parent.classList.add("focus")
}

/*=== Remove focus ===*/
function remfocus() {
  let parent = this.parentNode.parentNode
  if (this.value == "") {
    parent.classList.remove("focus")
  }
}

/*=== To call function===*/
inputs.forEach(input => {
  input.addEventListener("focus", addfocus)
  input.addEventListener("blur", remfocus)
})
