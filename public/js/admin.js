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
var overlay = document.querySelector('#overlay')













// const switchMode = document.getElementById('switch-mode');

// switchMode.addEventListener('change', function () {
//     if(this.checked) {
//         document.body.classList.add('dark');
//     } else {
//         document.body.classList.remove('dark');
//     }
// })

if(document.querySelector("#show-add")){
    document.querySelector("#show-add")
        .addEventListener("click",function (){
            document.querySelector(".popup").classList.add("active");
            overlay.style.display = 'block';

        });
    document.querySelector(".popup .close-btn")
        .addEventListener("click",function (){
            document.querySelector(".popup").classList.remove("active");
            overlay.style.display = 'none';
        });
}
document.addEventListener('DOMContentLoaded', function() {
    if (document.querySelector(".button-edit")) {
        const buttons = document.querySelectorAll('.button-edit');
        buttons.forEach(function(button) {
            button.addEventListener('click', function() {
                const popupId = this.getAttribute('data-popup-id');
                const popup = document.getElementById('popupEdit-' + popupId);
                if (popup) {
                    popup.classList.add("active");
                    overlay.style.display = 'block';
                }
            });
        });

        document.querySelectorAll(".popup-edit .close-btn").forEach(function(closeButton) {
            closeButton.addEventListener("click", function() {
                this.closest(".popup-edit").classList.remove("active");
                overlay.style.display = 'none';
            });
        });
    }
});

var clickSearchCount = 0;
if(document.querySelector(".click_search")){
    document.querySelector(".click_search")
        .addEventListener("click", function () {
            var searchElement = document.querySelector('.search_form')
            if (clickSearchCount === 0) {
                searchElement.classList.remove("outZoom");
                searchElement.classList.add("active_search");
                clickSearchCount++;
            }else{
                searchElement.classList.add("outZoom");
                clickSearchCount = 0;
            }
        })

}

document.addEventListener('DOMContentLoaded', function() {
    if (document.querySelector(".button-add-day")) {
        const buttons = document.querySelectorAll('.show-add-day');
        buttons.forEach(function(button) {
            button.addEventListener('click', function() {
                const popupId = this.getAttribute('data-popup-id');
                const popup = document.getElementById('popup-' + popupId);
                if (popup) {
                    popup.classList.add("active");
                    overlay.style.display = 'block';
                }
            });
        });

        document.querySelectorAll(".popup .close-btn").forEach(function(closeButton) {
            closeButton.addEventListener("click", function() {
                this.closest(".popup").classList.remove("active");
                overlay.style.display = 'none';
            });
        });
    }
});
// var studentDrop = document.querySelector('#student_dropDown');
// var listStudentAction = document.querySelector('.listStudentAction');
// var checkstudentDrop = false;
// document.addEventListener('DOMContentLoaded', function() {
//     studentDrop.addEventListener('click', function() {
//         if (checkstudentDrop) {
//             listStudentAction.classList.remove('action');
//             studentDrop.classList.add('bxs-chevron-down');
//             studentDrop.classList.remove('bx-chevron-up');
//         } else {
//             listStudentAction.classList.add('action');
//             studentDrop.classList.remove('bxs-chevron-down');
//             studentDrop.classList.add('bx-chevron-up');
//         }
//
//         checkstudentDrop = !checkstudentDrop; // Cập nhật trạng thái của checkstudentDrop
//
//     });
// });



var calenderDrop = document.querySelector('#calender_dropDown');
var listCalenderAction = document.querySelector('.listCalenderAction');
var checkCalendertDrop = false;
document.addEventListener('DOMContentLoaded', function() {
    calenderDrop.addEventListener('click', function() {
        if (checkCalendertDrop) {
            listCalenderAction.classList.remove('action');
            calenderDrop.classList.add('bxs-chevron-down');
            calenderDrop.classList.remove('bx-chevron-up');
        } else {
            listCalenderAction.classList.add('action');
            calenderDrop.classList.remove('bxs-chevron-down');
            calenderDrop.classList.add('bx-chevron-up');
        }

        checkCalendertDrop = !checkCalendertDrop; // Cập nhật trạng thái của checkstudentDrop

    });
});
