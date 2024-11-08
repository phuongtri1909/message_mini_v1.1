<!-- Modal Thông Tin Bạn Bè -->
<div class="modal fade" id="friendInfoModal-{{ $friend->id }}" tabindex="-1" aria-labelledby="friendInfoModalLabel-{{ $friend->id }}" aria-hidden="true" data-bs-backdrop="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold" id="friendInfoModalLabel-{{ $friend->id }}">{{ __('messages.friend_info') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Ảnh Bìa -->
                <div class="text-center mb-4">
                    <img src="{{ $friend->cover_image ?? 'assets/images/logo/uocmo.jpg' }}" class="img-fluid rounded" alt="Cover Image" style="max-height: 200px; width: 100%; object-fit: cover;">
                </div>
                <!-- Ảnh Đại Diện Bạn Bè -->
                <div class="text-center mb-4" style="margin-top: -60px;">
                    <img src="{{ $friend->avatar }}" class="rounded-circle border border-3 border-light" width="100" height="100" alt="Avatar">
                </div>
                <div class="text-center">
                    <h6 class="fw-bold">{{ $friend->name }}</h6>
                </div>
                <!-- Thông tin Bạn Bè dưới dạng Input -->
                <div class="row text-start">

                    <!-- Email -->
                    <div class="col-12 mb-3">
                        <label class="fw-bold">{{ __('messages.email') }}:</label>
                        <input type="email" name="email" class="form-control" value="{{ $friend->email ?? '' }}" readonly>
                    </div>
                    <!-- Giới Tính -->
                    <div class="col-12 mb-3">
                        <label class="fw-bold">{{ __('messages.gender') }}:</label>
                        <select id="gender" name="gender" class="form-control" readonly>
                            <option value="female" {{ Auth::user()->gender == 'female' ? 'selected' : '' }}>{{ __('messages.female')}}</option>
                            <option value="male" {{ Auth::user()->gender == 'male' ? 'selected' : '' }}>{{ __('messages.male')}}</option>
                        </select>
                    </div>
                    <!-- Ngày Sinh -->
                    <div class="col-12 mb-3">
                        <label class="fw-bold">{{ __('messages.dob') }}:</label>
                        <input type="date" name="dob" class="form-control" value="{{ $friend->dob ?? '' }}" readonly>
                    </div>
                    <!-- Số điện thoại -->
                    <div class="col-12 mb-3">
                        <label class="fw-bold">{{ __('messages.phone') }}:</label>
                        <input type="tel" name="phone" class="form-control" value="{{ $friend->phone ?? '' }}" readonly>
                    </div>
                    <!-- Description -->
                    <div class="col-12 mb-3">
                        <label class="fw-bold">{{ __('messages.description') }}:</label>
                        <textarea name="description" class="form-control" rows="3" readonly>{{ $friend->description ?? '' }}</textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.close') }}</button>
            </div>
        </div>
    </div>
</div>