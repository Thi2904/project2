
var clickCount = 0;
var dropDowmTeacher = document.querySelector('#dropDowmTeacher')
document.querySelector(".show_logout")
    .addEventListener("click",function (){
        var popupElement =  document.querySelector('.drop_down');
        if (clickCount === 0) {
            popupElement.classList.remove("drop_downActive");
            dropDowmTeacher.classList.remove('fa-caret-down')
            dropDowmTeacher.classList.add('fa-caret-up')
            clickCount++;
        }else{
            popupElement.classList.add("drop_downActive");
            dropDowmTeacher.classList.add('fa-caret-down');
            dropDowmTeacher.classList.remove('fa-caret-up');

            clickCount = 0;
        }
    });

var clickSearchCount = 0;
document.querySelector(".search_icon")
    .addEventListener("click", function () {
        var searchElement = document.querySelector('.search_content')
        if (clickSearchCount === 0) {
            searchElement.classList.remove("outZoom");
            searchElement.classList.add("active");
            clickSearchCount++;
        }else{
            searchElement.classList.add("outZoom");
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

document.addEventListener('DOMContentLoaded', function() {
    // Chọn các phần tử với ID tương ứng
    var successAlert = document.getElementById('success-alert');
    var warningAlert = document.getElementById('warning-alert');

    // Kiểm tra nếu có tồn tại ít nhất một trong hai phần tử
    if (successAlert || warningAlert) {
        // Đặt thời gian ẩn là 5 giây (5000ms)
        setTimeout(function() {
            if (successAlert) {
                successAlert.style.transition = "opacity 0.5s ease";
                successAlert.style.opacity = "0";
                setTimeout(function() {
                    successAlert.remove();
                }, 500); // Thêm thời gian để chờ hiệu ứng opacity hoàn tất trước khi xóa phần tử
            }
            if (warningAlert) {
                warningAlert.style.transition = "opacity 0.5s ease";
                warningAlert.style.opacity = "0";
                setTimeout(function() {
                    warningAlert.remove();
                }, 500); // Thêm thời gian để chờ hiệu ứng opacity hoàn tất trước khi xóa phần tử
            }
        }, 5000); // 5000ms = 5 giây
    }
});

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


document.addEventListener('DOMContentLoaded', function () {
    const diHocCountElement = document.getElementById('di-hoc-count');
    const treCountElement = document.getElementById('tre-count');
    const nghiPhepCountElement = document.getElementById('nghi-phep-count');
    const nghiCountElement = document.getElementById('nghi-count');

    const updateCounts = () => {
        const diHocCount = document.querySelectorAll('input[type="radio"][value="đi học"]:checked').length;
        const treCount = document.querySelectorAll('input[type="radio"][value="trễ"]:checked').length;
        const nghiPhepCount = document.querySelectorAll('input[type="radio"][value="nghỉ có phép"]:checked').length;
        const nghiKhongPhepCount = document.querySelectorAll('input[type="radio"][value="nghỉ không phép"]:checked').length;

        diHocCountElement.textContent = diHocCount;
        treCountElement.textContent = treCount;
        nghiPhepCountElement.textContent = nghiPhepCount;
        nghiCountElement.textContent = nghiKhongPhepCount;
    };

    document.querySelectorAll('input[type="radio"]').forEach(input => {
        input.addEventListener('change', updateCounts);
    });

    // Initialize counts on page load
    updateCounts();
});
