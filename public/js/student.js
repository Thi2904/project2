
const allSideMenu = document.querySelectorAll('#sidebar .side-menu.top li a');

allSideMenu.forEach(item=> {
    const li = item.parentElement;

    item.addEventListener('click', function () {
        allSideMenu.forEach(i=> {
            i.parentElement.classList.remove('active');
        })
        li.classList.add('active');
    })
});




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
    if(window.innerWidth < 576) {
        e.preventDefault();
        searchForm.classList.toggle('show');
        if(searchForm.classList.contains('show')) {
            searchButtonIcon.classList.replace('bx-search', 'bx-x');
        } else {
            searchButtonIcon.classList.replace('bx-x', 'bx-search');
        }
    }
})





if(window.innerWidth < 768) {
    sidebar.classList.add('hide');
} else if(window.innerWidth > 576) {
    searchButtonIcon.classList.replace('bx-x', 'bx-search');
    searchForm.classList.remove('show');
}


window.addEventListener('resize', function () {
    if(this.innerWidth > 576) {
        searchButtonIcon.classList.replace('bx-x', 'bx-search');
        searchForm.classList.remove('show');
    }
})

// ADD NEW CHUYEN NGANH
if( document.querySelector("#show-add") ) {
    document.querySelector("#show-add")
        .addEventListener("click", function () {
            document.querySelector(".popup_add").classList.add("active");
        });
    document.querySelector(".popup_add .close-btn_add")
        .addEventListener("click", function () {
            document.querySelector(".popup_add").classList.remove("active");

        });
}
// Hien thi them hoc sinh
if( document.querySelector(".show-add") ) {
    document.querySelectorAll(".show-add").forEach(function (button) {
        button.addEventListener("click", function () {
            document.querySelector(".popup").classList.add("active");
        });
    });

    document.querySelector(".popup .close-btn").addEventListener("click", () => {
        document.querySelector(".popup").classList.remove("active");
    });
}


if(document.querySelector(".button-edit")){
    document.querySelectorAll(".button-edit").forEach(function(button) {

        button.addEventListener("click", function () {
            var popupElement = document.querySelector('.popup-edit');
            popupElement.classList.add("active");
            var addButton = popupElement.querySelector('button');
            var addContent = popupElement.querySelector('h2');
            addButton.innerText = 'Edit';
            addContent.innerText = 'Edit Class';

        });
    });
    document.querySelector(".popup-edit .close-btn").addEventListener("click", () => {
        document.querySelector(".popup-edit").classList.remove("active");
    });
}

if(document.querySelector(".alert .alert-success")){
    setTimeout(function() {
        document.querySelector(".alert .alert-success").classList.add('unactive')
    },1000)
}else{

}
