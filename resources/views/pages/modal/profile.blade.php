<!-- Modal Profile -->
<div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="profileModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data"> <!-- Hành động có thể để trống tạm thời -->
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="profileModalLabel">Thông tin cá nhân</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Profile Image -->
                    <div class="form-group">
                        <label>Ảnh đại diện</label><br>
                        <img src="{{ Auth::user()->avatar }}" class="rounded-circle" width="100" height="100" alt="Avatar" >
                        <input type="file" name="avatar" class="form-control mt-2"> <!-- Thêm input cho avatar -->
                    </div>
                     <!-- Name -->
                     <div class="form-group">
                        <label>Tên</label>
                        <input type="text" name="name" class="form-control" value="{{ Auth()->user()->name}}" > 
                    </div>
                    
                    <!-- Email -->
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ Auth()->user()->email}}" readonly > 
                    </div>

                    <div class="form-group">
                        <label for="gender">Giới tính</label>
                        <select id="gender" name="gender" class="form-control" >     
                            <option value="female"{{ Auth()->user()->gender == 'female' ? 'selected' : '' }}>Nữ</option>
                            <option value="male" {{ Auth()->user()->gender == 'male' ? 'selected' : ''}}>Nam</option>
                        </select>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                    <button type="submit" class="btn btn-primary">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>
</div>