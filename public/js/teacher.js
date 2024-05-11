
var clickCount = 0;
document.querySelector(".show_logout")
    .addEventListener("click",function (){
        var popupElement =  document.querySelector('.btn-not-out');
        if (clickCount === 0) {
            popupElement.classList.remove("btn-out");
            clickCount++;
            console.log(clickCount)
        }else{
            popupElement.classList.add("btn-out");
            clickCount = 0;
        }
    });

var clickSearchCount = 0;
document.querySelector(".search_icon")
    .addEventListener("click", function () {
        var searchElement = document.querySelector('.search_content')
        if (clickSearchCount === 0) {
            searchElement.classList.add("active");
            clickSearchCount++;
        }else{
            searchElement.classList.remove("active");
            clickSearchCount = 0;
        }
    })
var clickBarCount = 0;
document.querySelector(".icon_bar")
    .addEventListener("click", function () {
        var barElement = document.querySelector('#sidebar')

        var mainElement = document.querySelector(".contentBenTrong")
        if(clickBarCount === 0){
            barElement.classList.remove("off");
            mainElement.classList.remove("off");
            barElement.classList.add("col-lg-part");
            mainElement.classList.add("col-lg-13");
            clickBarCount++;
        }else{
            barElement.classList.add("off");
            mainElement.classList.add("off");
            barElement.classList.remove("col-lg-part");
            mainElement.classList.remove("col-lg-13");
            clickBarCount = 0;
        }

})
// document.querySelector(".list_diemdanh")
//     .addEventListener("click",function (event){
//         var diemDanhElement = document.querySelector('.ele_diemdanh')
//         var targetElement = event.target;
//         var isClickInsideDiemDanh = diemDanhElement.contains(targetElement);
//         if(isClickInsideDiemDanh) {
//             diemDanhElement.classList.add("nentrang");
//         }else{
//             diemDanhElement.classList.remove("nentrang");
//         }
//     })
