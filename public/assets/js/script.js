//hidden password
$(document).on('click', '#togglePassword', function () {
    const passwordField = $('#password');
    const type = passwordField.attr('type') === 'password' ? 'text' : 'password';
    passwordField.attr('type', type);
    $(this).toggleClass('fa-eye fa-eye-slash');
});

//hidden password confirm
$(document).on('click', '#togglePasswordConfirm', function () {
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

// Hàm để cuộn xuống dưới
function scrollToBottom() {
    const chatMessages = document.querySelector('.chat-messages');
    if (chatMessages) {
        chatMessages.scrollTop = chatMessages.scrollHeight; // Cuộn xuống dưới cùng
    }
}

// Gọi hàm cuộn xuống khi trang tải xong
document.addEventListener('DOMContentLoaded', function () {
    scrollToBottom();

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
            if (modalImage) {
                modalImage.src = this.src;
                const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
                imageModal.show();
            } else {
                console.error("Không tìm thấy phần tử 'modalImage'.");
            }
        });
    });
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
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.view-image').forEach(image => {
        image.addEventListener('click', function () {
            const modalImage = document.getElementById('modalImage');
            if (modalImage) {
                modalImage.src = this.src;
                const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
                imageModal.show();
            } else {
                console.error("Không tìm thấy phần tử 'modalImage'.");
            }
        });
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

// Hàm biểu tượng ảnh đã có
function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function () {
        const output = document.createElement('img');
        output.src = reader.result;

        const inputId = event.target.id;
        const imageCircle = document.querySelector('.group-image-circle');

        if (inputId === 'cover_image') {
            const coverImagePreview = document.getElementById('coverImagePreview');
            coverImagePreview.src = reader.result; // Cập nhật ảnh bìa
        } else if (inputId === 'avatar') {
            const avatarPreview = document.getElementById('avatarPreview');
            avatarPreview.src = reader.result; // Cập nhật ảnh đại diện
        }
    };
    reader.readAsDataURL(event.target.files[0]);
}

//Hàm chỉnh cài đặt danh sách bạn bè 3 chấm
document.addEventListener('DOMContentLoaded', function () {
    const toggleMenus = document.querySelectorAll('.toggle-menu');

    toggleMenus.forEach(toggleMenu => {
        toggleMenu.addEventListener('click', function (event) {
            event.preventDefault();
            const dropdownId = this.getAttribute('data-dropdown-id');
            const dropdownMenu = document.getElementById(dropdownId);

            // Ẩn tất cả các menu dropdown khác
            document.querySelectorAll('.dropdown-menu-custom').forEach(menu => {
                if (menu !== dropdownMenu) {
                    menu.style.display = 'none';
                }
            });

            // Hiển thị hoặc ẩn menu dropdown hiện tại
            if (dropdownMenu.style.display === 'none' || dropdownMenu.style.display === '') {
                dropdownMenu.style.display = 'block';
            } else {
                dropdownMenu.style.display = 'none';
            }
        });
    });

    // Ẩn menu dropdown khi nhấp ra ngoài
    document.addEventListener('click', function (event) {
        if (!event.target.closest('.friend-item')) {
            document.querySelectorAll('.dropdown-menu-custom').forEach(menu => {
                menu.style.display = 'none';
            });
        }
    });
});




// modal thêm thành viên
document.addEventListener('DOMContentLoaded', function () {
    // Khởi tạo modal Thêm thành viên
    const addMembersModal = new bootstrap.Modal(document.getElementById('addMembersModal'));

    // Sự kiện mở modal
    document.getElementById('openAddMembersModal').addEventListener('click', function () {
        addMembersModal.show();
    });

    // Sự kiện thêm thành viên đã chọn
    document.getElementById('addSelectedMembers').addEventListener('click', function () {
        const selectedMembers = [];
        document.querySelectorAll('#addMembersModal .form-check-input:checked').forEach(checkbox => {
            selectedMembers.push(checkbox.value);
        });
        console.log("Các thành viên được thêm:", selectedMembers);
        // Đóng modal
        addMembersModal.hide();
    });
});


// input gửi tin nhắn
document.addEventListener('DOMContentLoaded', function () {
    const folderIcon = document.getElementById('folderIcon');
    const imageIcon = document.getElementById('imageIcon');
    const fileIcon = document.getElementById('fileIcon');
    const folderInput = document.getElementById('folderInput');
    const imageInput = document.getElementById('imageInput');
    const fileInput = document.getElementById('fileInput');
    const previewContainer = document.getElementById('previewContainer');
    const previewContent = document.getElementById('previewContent');
    const sendIcon = document.getElementById('sendIcon');
    const messageInput = document.getElementById('messageInput');

    folderIcon.addEventListener('click', function () {
        folderInput.click();
    });

    imageIcon.addEventListener('click', function () {
        imageInput.click();
    });

    fileIcon.addEventListener('click', function () {
        fileInput.click();
    });

    function handleFileSelect(input) {
        const files = input.files;
        previewContent.innerHTML = '';

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();

            reader.onload = function (e) {
                const fileType = file.type.split('/')[0];
                let element;

                if (fileType === 'image') {
                    element = document.createElement('img');
                    element.src = e.target.result;
                    element.style.width = '50px';
                    element.style.height = '50px';
                    element.style.objectFit = 'cover';
                    element.style.marginRight = '5px';
                } else {
                    element = document.createElement('div');
                    element.textContent = file.name;
                    element.style.marginRight = '5px';
                }

                previewContent.appendChild(element);
            };

            reader.readAsDataURL(file);
        }

        previewContainer.style.display = 'block';
        toggleSendIcon();
    }

    folderInput.addEventListener('change', function () {
        handleFileSelect(this);
    });

    imageInput.addEventListener('change', function () {
        handleFileSelect(this);
    });

    fileInput.addEventListener('change', function () {
        handleFileSelect(this);
    });

    messageInput.addEventListener('input', function () {
        toggleSendIcon();
    });

    function toggleSendIcon() {
        // Hiển thị nút gửi nếu có tin nhắn hoặc ảnh/tệp đính kèm
        if (messageInput.value.trim() !== '' || previewContent.children.length > 0) {
            sendIcon.style.display = 'block';
            previewContainer.style.display = 'block';
        } else {
            sendIcon.style.display = 'none';
            previewContainer.style.display = 'none';
        }
    }
});


// hàm xử lý tìm kiếm người dùng
document.getElementById('searchButton').addEventListener('click', function () {
    const email = document.getElementById('friendEmail').value.trim();

    if (email === "") {
        showToast('Vui lòng nhập email người dùng.', 'error');
        return;
    }

    fetch('/search-friend', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ email: email })
    })
        .then(response => response.json())
        .then(data => {
            const searchResult = document.getElementById('searchResult');
            const resultUserName = document.getElementById('resultUserName');
            const sendRequestButton = document.getElementById('sendRequestButton');
            const cancelRequestButton = document.getElementById('cancelRequestButton');
            const messageButtonn = document.getElementById('messageButtonn');

            resultUserName.textContent = '';
            searchResult.style.display = "none";

            if (data.status === "success") {
                const userAvatar = data.user.avatar || "assets/images/logo/uocmo.jpg";

                document.getElementById('resultUserAvatar').src = userAvatar;
                document.getElementById('resultUserName').textContent = data.user.name || "Không có tên";
                document.getElementById('resultUserEmail').textContent = data.user.email || "Không có email";
                document.getElementById('resultUserGender').textContent = data.user.gender;

                searchResult.style.display = "block";

                checkFriendRequestStatus(data.user.id, sendRequestButton, cancelRequestButton, messageButtonn);
            } else {
                showToast(data.message, 'error');
            }
        })
        .catch(error => {
            showToast('Có lỗi xảy ra. Vui lòng thử lại sau.', 'error');
        });
});

document.addEventListener('DOMContentLoaded', function () {
    const emailInput = document.getElementById('friendEmail');
    const searchButton = document.getElementById('searchButton');

    // Hàm kiểm tra tính hợp lệ của email
    function validateEmail() {
        return emailInput.checkValidity();
    }

    // Sự kiện khi người dùng nhập vào ô email
    emailInput.addEventListener('input', function () {
        if (validateEmail()) {
            searchButton.disabled = false;
        } else {
            searchButton.disabled = true;
        }
    });
});

// Hàm kiểm tra trạng thái yêu cầu kết bạn
function checkFriendRequestStatus(userId, sendRequestButton, cancelRequestButton) {
    fetch('/check-friend-request-status', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ friend_id: userId })
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === "friends") {
                messageButtonn.style.display = 'block';
                sendRequestButton.style.display = 'none';
                cancelRequestButton.style.display = 'none';
                //hai người đã là bạn bè
            } else if (data.status === "sent") {
                sendRequestButton.style.display = 'none';
                cancelRequestButton.style.display = 'block';
                messageButtonn.style.display = 'none';
            } else if (data.status === "received") {
                sendRequestButton.style.display = 'none';
                cancelRequestButton.style.display = 'none';
                messageButtonn.style.display = 'none';
                //người này đã gửi lời mời kết bạn cho bạn
            } else {
                sendRequestButton.style.display = 'block';
                cancelRequestButton.style.display = 'none';
                messageButtonn.style.display = 'none';
            }

            sendRequestButton.onclick = function () {
                sendFriendRequest(userId);
            };

            cancelRequestButton.onclick = function () {
                cancelFriendRequest(userId);
            };
        })
        .catch(error => {
            saveToast('Có lỗi xảy ra. Vui lòng thử lại sau.', 'error');
        });
}

// Hàm gửi yêu cầu kết bạn
function sendFriendRequest(userId) {
    fetch('/send-friend-request', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ friend_id: userId })
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                showToast(data.message, 'success');
                checkFriendRequestStatus(userId, sendRequestButton, cancelRequestButton);
            } else {
                showToast(data.message, 'error');
            }
        })
        .catch(error => {
            showToast('Có lỗi xảy ra. Vui lòng thử lại sau.', 'error');
        });
}

// Hàm hủy yêu cầu kết bạn
function cancelFriendRequest(userId) {
    fetch('/cancel-friend-request', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ friend_id: userId })
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                showToast(data.message, 'success');
                checkFriendRequestStatus(userId, sendRequestButton, cancelRequestButton);
            } else {
                showToast(data.message, 'error');
            }
        })
        .catch(error => {
            showToast('Có lỗi xảy ra. Vui lòng thử lại sau.', 'error');
        });
}


// hàm xử lý lời mời kết bạn

function loadFriendRequests() {
    fetch('/get-friend-requests', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                const friendRequestsList = document.getElementById('friendRequestsList');
                friendRequestsList.innerHTML = ''; // Xóa nội dung hiện tại
                
                // Duyệt qua danh sách lời mời và tạo HTML
                
                data.requests.forEach(request => {
                    const requestTime = new Date(request.created_at).toLocaleString(); // Chuyển đổi thời gian thành chuỗi dễ đọc
                    friendRequestsList.innerHTML += `
                       <div class="friend-request-item"
    style="display: flex; align-items: center; justify-content: space-between; padding: 10px; border: 1px solid #ddd; border-radius: 5px; margin-bottom: 10px;">
    <div style="display: flex; align-items: center;">
        <img src="${request.sender.avatar}" alt="${request.sender.name}"
            style="width: 70px; height: 70px; border-radius: 50%; object-fit: cover; margin-right: 10px;">
        <div>
            <p style="margin: 0; font-weight: bold;">${request.sender.name}</p>
            <p style="margin: 0; color: #888;">Gửi lúc: ${requestTime}</p>
        </div>
    </div>
    <div style="display: flex; align-items: center;">
        <button class="btn btn-success" style="margin-right: 5px; position: relative; width: 110px; height: 40px; background-color: #2dea1c; display: flex; align-items: center; color: white; flex-direction: column; justify-content: center; border: none; padding: 12px; gap: 12px; border-radius: 8px; cursor: pointer;
    }" onclick="acceptRequest(${request.id})">Chấp nhận</button> 
    <button class="btn btn-danger" style="width: 110px; height: 40px;  border-radius: 5px; padding: 10px 25px cursor: pointer; transition: all 0.3s ease; position: relative; display: inline-block 
     outline: none;" onclick="declineRequest(${request.id})">Từ chối</button>
    </div>
</div>
                    `;
                });
            } else {
                saveToast(data.message, 'error');
            }
        })
        .catch(error => {
            saveToast('Có lỗi xảy ra. Vui lòng thử lại sau.', 'error');
        });
}

// Hàm đồng ý kết bạn
function acceptRequest(requestId) {
    fetch('/accept-friend-request', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ request_id: requestId })
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                showToast(data.message, 'success');
                loadFriendRequests(); // Cập nhật lại danh sách lời mời
            } else {
               showToast(data.message, 'error');
            }
        })
        .catch(error => {
            showToast('Có lỗi xảy ra. Vui lòng thử lại sau.', 'error');
        });
}

// Hàm từ chối kết bạn
function declineRequest(requestId) {
    fetch('/decline-friend-request', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ request_id: requestId })
    })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                showToast(data.message, 'success');
                loadFriendRequests(); // Cập nhật lại danh sách lời mời
            } else {
                showToast(data.message, 'error');
            }
        })
        .catch(error => {
            showToast('Có lỗi xảy ra. Vui lòng thử lại sau.', 'error');
        });
}

// Gọi hàm loadFriendRequests khi modal được mở
document.getElementById('showFriendRequestsModal').addEventListener('click', function () {
    loadFriendRequests();
});

// Danh sách bạn bè
document.addEventListener('DOMContentLoaded', function () {
    const friendsListModal = document.getElementById('friendsListModal');
    const friendsList = document.getElementById('friendsList');

    // Gọi hàm loadFriendsList khi modal được mở
    friendsListModal.addEventListener('show.bs.modal', function () {
        loadFriendsList();
    });

    // Hàm tải danh sách bạn bè
    function loadFriendsList() {
        fetch('/friends-list-modal', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === "success") {
                    friendsList.innerHTML = ''; // Xóa nội dung hiện tại
                    
                    // Duyệt qua danh sách bạn bè và tạo HTML
                    data.friends.forEach(friend => {
                        friendsList.innerHTML += `
                            <div class="friend-item">
                                <img src="${friend.avatar}" alt="${friend.name}" class="avatar" style="height:96px; width:96px;">
                                <p>${friend.name}</p>
                            </div>
                        `;
                    });
                } else {
                    saveToast(data.message, 'error');
                }
            })
            .catch(error => {
                saveToast('Có lỗi xảy ra. Vui lòng thử lại sau.', 'error');
            });
    }

         //Hàm chuyển đổi ngôn ngữ
         document.getElementById('saveSettingsBtn').addEventListener('click', function() {
            var selectedLang = document.getElementById('languageSelect').value;
            // Gửi yêu cầu đến route để thay đổi ngôn ngữ
            fetch(`/language/${selectedLang}`)
            .then(response => {
                if (response.ok) {
                    // Tái tải trang để áp dụng ngôn ngữ mới
                    location.reload();
                } else {
                    // Xử lý lỗi nếu cần
                    console.error('Error changing language');
                }
            })
            .catch(error => console.error('Fetch error:', error));
        });

});