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
        });
    document.querySelector(".popup .close-btn")
        .addEventListener("click",function (){
            document.querySelector(".popup").classList.remove("active");
            // document.body.classList.remove('dark');

        });
}
document.querySelectorAll(".show-edit").forEach(function(button) {

    button.addEventListener("click", function () {
        var popupElement = document.querySelector('.popup-edit');
        popupElement.classList.add("active");


    });
});
document.querySelector(".popup-edit .close-btn")
    .addEventListener("click",function (){
        var popupElement =  document.querySelector('.popup-edit');
        popupElement.classList.remove("active");

    });
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

