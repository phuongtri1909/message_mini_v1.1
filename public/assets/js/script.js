//hidden password

$(document).on('click', '#togglePassword', function() {
    const passwordField = $('#password');
    const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
    passwordField.attr('type', type);

    $(this).toggleClass('fa-eye fa-eye-slash');
});

//hidden password confirm

$(document).on('click', '#togglePasswordConfirm', function() {
    const passwordField = $('#password_confirmation');
    const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
    passwordField.attr('type', type);

    $(this).toggleClass('fa-eye fa-eye-slash');
});

//toast
function showToast(message, status) {
    const toastElement = $('#liveToast');
    const toastBody = toastElement.find('.toast-body');

    // Cập nhật nội dung tin nhắn
    toastBody.text(message);

    // Xóa các lớp nền cũ
    toastElement.removeClass('bg-success bg-danger text-white');

    // Thêm lớp nền dựa trên trạng thái
    if (status === 'success') {
        toastElement.addClass('bg-success text-white');
    } else if (status === 'error') {
        toastElement.addClass('bg-danger text-white');
    }

    // Hiển thị toast
    const toast = new bootstrap.Toast(toastElement[0]);
    toast.show();
}

//save toast

function saveToast(message, status) {
    sessionStorage.setItem('toastMessage', message);
    sessionStorage.setItem('toastStatus', status);
}

//show toast
function showSavedToast() {
    const message = sessionStorage.getItem('toastMessage');
    const status = sessionStorage.getItem('toastStatus');

    if (message && status) {
        showToast(message, status);
        sessionStorage.removeItem('toastMessage');
        sessionStorage.removeItem('toastStatus');
    }
}

//otp

function handleInput(element) {
    $(element).val($(element).val().replace(/[^0-9]/g, ''));

    if ($(element).val().length === 1) {
        const nextInput = $(element).next('.otp-input');
        if (nextInput.length) {
            nextInput.focus();
        }
    }
}


// Lưu vị trí cuộn trang khi chuyển trang
$(document).ready(function () {
    $('.click-scroll').on('click', function (e) {
        localStorage.setItem('scrollPosition', $(window).scrollTop());
        window.location.href = $(this).attr('href');
    });

    const scrollPosition = localStorage.getItem('scrollPosition');
    if (scrollPosition) {
        $(window).scrollTop(scrollPosition);
        localStorage.removeItem('scrollPosition');
    }
});
// Lưu vị trí cuộn trang khi chuyển trang



 // Hàm để cuộn xuống dưới
 function scrollToBottom() {
    const chatMessages = document.querySelector('.chat-messages');
    chatMessages.scrollTop = chatMessages.scrollHeight; // Cuộn xuống dưới cùng
}

// Gọi hàm cuộn xuống khi trang tải xong

    document.addEventListener('DOMContentLoaded', function () {
        // Cuộn xuống cuối cùng của phần chat-messages
        function scrollToBottom() {
            const chatMessages = document.querySelector('.chat-messages');
            if (chatMessages) {
                chatMessages.scrollTop = chatMessages.scrollHeight;
            }
        }

        // Ẩn hiện ảnh đã gửi
        const imagesList = document.querySelectorAll('.images-list .view-image');
        const viewToggleBtn = document.getElementById('view-toggle-btn');

        function hideExtraImages() {
            imagesList.forEach((img, index) => {
                img.classList.toggle('d-none', index >= 6);
            });
            viewToggleBtn.textContent = "Xem tất cả";
        }

        hideExtraImages();

        // Xử lý khi bấm nút "Xem tất cả" hoặc "Ẩn bớt"
        viewToggleBtn.addEventListener('click', function () {
            if (viewToggleBtn.textContent === "Xem tất cả") {
                imagesList.forEach(img => img.classList.remove('d-none'));
                viewToggleBtn.textContent = "Ẩn bớt";
            } else {
                hideExtraImages();
            }
        });

        // Hiển thị ảnh lớn khi bấm vào ảnh nhỏ
        imagesList.forEach(image => {
            image.addEventListener('click', function () {
                const modalImage = document.getElementById('modalImage');
                modalImage.src = this.src;
                const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
                imageModal.show();
            });
        });

        // Gọi hàm cuộn xuống cuối sau khi mọi thứ đã sẵn sàng
        scrollToBottom();
    });
    
 // JavaScript để xử lý nút "Xem tất cả" và mở modal ảnh
 document.addEventListener('DOMContentLoaded', function () {
    const viewAllBtn = document.getElementById('view-all-btn');
    const extraImages = document.querySelector('.extra-images');

    // Kiểm tra xem cả hai phần tử có tồn tại không
    if (viewAllBtn && extraImages) {
        viewAllBtn.addEventListener('click', function () {
            extraImages.classList.toggle('d-none');
            this.innerText = this.innerText === "Xem tất cả" ? "Ẩn bớt" : "Xem tất cả";
        });
    } else {
        console.error("Không tìm thấy phần tử với ID 'view-all-btn' hoặc lớp 'extra-images'.");
    }
});
// Xử lý sự kiện khi nhấn vào ảnh để xem lớn
document.querySelectorAll('.view-image').forEach(image => {
    image.addEventListener('click', function () {
        const modalImage = document.getElementById('modalImage');
        modalImage.src = this.src;
        const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
        imageModal.show();
    });
});
// xem tất cả thành viên

document.addEventListener('DOMContentLoaded', function () {
    // Lấy các phần tử cần thiết
    const viewMembersBtn = document.getElementById('view-all-members-btn');
    const membersOffcanvas = document.getElementById('offcanvasMembers');

    // Kiểm tra xem cả hai phần tử có tồn tại hay không
    if (viewMembersBtn && membersOffcanvas) {
        // Khởi tạo offcanvas Bootstrap cho phần tử 'offcanvasMembers'
        const offcanvasInstance = new bootstrap.Offcanvas(membersOffcanvas);

        // Thêm sự kiện click cho nút để hiển thị offcanvas
        viewMembersBtn.addEventListener('click', function () {
            offcanvasInstance.show();
        });
    } else {
        console.error("Không tìm thấy phần tử 'view-all-members-btn' hoặc 'offcanvasMembers'");
    }
});

//Hàm biểu tượng ảnh
function previewImage(event) {
    var reader = new FileReader();
    reader.onload = function() {
        var output = document.createElement('img');
        output.src = reader.result;
        
        // Thêm hình ảnh vào container
        var imageCircle = document.querySelector('.group-image-circle');
        imageCircle.innerHTML = ''; // Xóa biểu tượng camera
        imageCircle.appendChild(output); // Thêm ảnh mới
    };
    reader.readAsDataURL(event.target.files[0]);
}

//Hàm chỉnh cài đặt danh sách bạn bè 3 chấm
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.toggle-menu').forEach(function (toggleButton) {
        toggleButton.addEventListener('click', function (event) {
            const dropdownMenu = document.getElementById('global-dropdown-menu');

            // Ẩn tất cả các dropdown trước khi hiển thị dropdown mới
            document.querySelectorAll('.dropdown-menu-custom').forEach(function (menu) {
                menu.style.display = 'none';
            });

            // Tính toán vị trí của phần tử
            const rect = toggleButton.getBoundingClientRect();
            const dropdownWidth = dropdownMenu.offsetWidth;
            const dropdownHeight = dropdownMenu.offsetHeight;
            const screenWidth = window.innerWidth;
            const screenHeight = window.innerHeight;

            // Xử lý vị trí dọc
            const topPosition = rect.top + window.scrollY;

            // Xử lý vị trí ngang - hiển thị dropdown bên trái icon 3 chấm
            const leftPosition = rect.left - dropdownWidth;

            // Kiểm tra nếu tràn khỏi màn hình bên trái thì hiển thị bên phải icon 3 chấm
            const finalLeftPosition = leftPosition < 0 ? rect.right : leftPosition;

            // Gán vị trí cho dropdown menu
            dropdownMenu.style.top = `${topPosition}px`;
            dropdownMenu.style.left = `${finalLeftPosition}px`;
            dropdownMenu.style.display = 'block';

            // Ngăn không cho trang tự cuộn lên đầu
            event.preventDefault();
        });
    });

    // Ẩn menu khi click bên ngoài
    window.addEventListener('click', function (e) {
        const dropdownMenu = document.getElementById('global-dropdown-menu');
        if (!e.target.matches('.toggle-menu, .toggle-menu *')) {
            dropdownMenu.style.display = 'none';
        }
    });
});
