
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
            addButton.innerText = 'Chỉnh sửa';
            addContent.innerText = 'Chỉnh sửa';

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
}

var clickSearchCount = 0;
document.querySelector(".click_search")
    .addEventListener("click", function () {
        var searchElement = document.querySelector('.search_form')
        if (clickSearchCount === 0) {
            searchElement.classList.add("active_search");
            clickSearchCount++;
        }else{
            searchElement.classList.remove("active_search");
            clickSearchCount = 0;
        }
    })

//Xuong dong input
// Lặp qua tất cả các ô input và thêm sự kiện cho mỗi ô input
var textInputs = document.querySelectorAll(".text-input");
textInputs.forEach(function(input) {
    input.addEventListener("input", function(event) {
        var maxLength = parseInt(event.target.getAttribute("maxlength"));
        var text = event.target.value;
        if (text.length > maxLength) {
            event.target.value = text.substring(0, maxLength);
            event.preventDefault();
            var startIndex = event.target.selectionStart;
            var endIndex = event.target.selectionEnd;
            event.target.value = text.substring(0, startIndex) + "\n" + text.substring(endIndex, text.length);
            event.target.setSelectionRange(startIndex + 1, startIndex + 1);
        }
    });

    input.addEventListener("keypress", function(event) {
        if (event.key === "Enter") {
            event.preventDefault();
            var form = event.target.form;
            var index = Array.prototype.indexOf.call(form, event.target);
            if (form.elements[index + 1]) {
                form.elements[index + 1].focus();
            }
        }
    });
});
