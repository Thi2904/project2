
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



// ADD NEW CHUYEN NGANH
if( document.querySelector("#show-add") ) {
    document.querySelector("#show-add")
        .addEventListener("click", function () {
            document.querySelector(".popup_add").classList.add("active");
            overlay.style.display = 'block';

        });
    document.querySelector(".popup_add .close-btn_add")
        .addEventListener("click", function () {
            document.querySelector(".popup_add").classList.remove("active");
            overlay.style.display = 'none';


        });
}
// Hien thi them hoc sinh
document.addEventListener('DOMContentLoaded', function() {
    if (document.querySelector(".show-add")) {
        const buttons = document.querySelectorAll('.show-add');
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

document.addEventListener('DOMContentLoaded', function() {
    if (document.querySelector(".show-add-excel")) {
        const buttons = document.querySelectorAll('.show-add-excel');
        buttons.forEach(function(button) {
            button.addEventListener('click', function() {
                const popupId = this.getAttribute('data-excel-id');
                const popup = document.getElementById('popupExcel-' + popupId);
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

// Duyệt qua từng form để xử lý
document.querySelectorAll('.form-excel').forEach(form => {
    const formId = form.id;
    const dropZone = form.querySelector('.drop-zone');
    const fileInput = form.querySelector('#fileInput');
    const formMessage = form.querySelector('.form-messageExcel');

    let fileSelected = false; // Biến cờ để kiểm tra xem người dùng đã chọn file hay chưa

    // Khi người dùng nhấp vào vùng kéo thả, mở hộp thoại chọn tệp
    dropZone.addEventListener('click', () => fileInput.click());

    // Ngăn chặn hành vi mặc định khi kéo và thả tệp
    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.classList.add('hover');
    });

    dropZone.addEventListener('dragleave', () => {
        dropZone.classList.remove('hover');
    });

    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.classList.remove('hover');
        handleFileDrop(e.dataTransfer.files);
    });

    // Khi người dùng chọn tệp thông qua hộp thoại chọn tệp
    fileInput.addEventListener('change', () => {
        handleFileDrop(fileInput.files);
    });

    // Xử lý khi người dùng thả tệp vào vùng drop zone
    function handleFileDrop(files) {
        if (files.length > 0) {
            const file = files[0];
            const fileName = file.name;
            const fileType = file.type;

            // Kiểm tra nếu không phải file Excel
            if (!fileType.includes('spreadsheet') && !fileType.includes('excel')) {
                dropZone.classList.add('invalid');
                formMessage.style.color = 'red';
                formMessage.innerText = 'Định dạng tệp phải là Excel.';
                fileSelected = false; // Đặt biến cờ là false vì chưa chọn đúng định dạng tệp
            } else {
                dropZone.classList.remove('invalid');
                formMessage.innerText = `Đã chọn tệp: ${fileName}`;
                formMessage.style.color = 'black'
                fileSelected = true; // Đặt biến cờ là true vì đã chọn file thành công
            }
        }
    }

    // Ngăn chặn submit form nếu không có file được chọn
    form.addEventListener('submit', (event) => {
        if (!fileSelected) {
            dropZone.classList.add('invalid');
            event.preventDefault(); // Ngăn chặn submit form
            formMessage.style.color = 'red';
            formMessage.innerText = 'Vui lòng chọn file Excel trước khi tải lên.';
        }else{
            dropZone.classList.remove('invalid');
        }
    });
});
