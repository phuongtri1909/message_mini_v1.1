<!-- Modal Profile -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="#" method="POST" enctype="multipart/form-data"> <!-- Hành động có thể để trống tạm thời -->
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="profileModalLabel">Thông tin cá nhân</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Profile Image -->
                    <div class="form-group">
                        <label>Ảnh đại diện</label><br>
                        <img src="{{ asset('assets/images/logo/logohoanxu.png') }}" width="100" height="100" alt="Avatar">
                        
                    </div>
                    
                    <!-- Email -->
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="Thằng Thắng OcS CHOS"> 
                    </div>

                    <!-- Birthdate -->
                    <div class="form-group">
                        <label>Ngày sinh</label>
                        <input type="date" name="birthdate" class="form-control" value="">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Sửa</button>
                </div>
            </form>
        </div>
    </div>
</div>
