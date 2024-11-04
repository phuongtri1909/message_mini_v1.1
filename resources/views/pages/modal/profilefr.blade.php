<!-- Modal Thông Tin Bạn Bè -->
<div class="modal fade" id="friendInfoModal-{{ $friend->id }}" tabindex="-1" aria-labelledby="friendInfoModalLabel-{{ $friend->id }}" aria-hidden="true" data-bs-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="friendInfoModalLabel-{{ $friend->id }}">{{ __('messages.friend_info') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Ảnh Đại Diện Bạn Bè -->
                <div class="form-group text-center">
                    <img src="{{ $friend->avatar }}" class="rounded-circle" width="100" height="100" alt="Avatar">
                </div>
                <!-- Tên -->
                <div class="form-group mt-3">
                    <label>{{ __('messages.name') }}: {{ $friend->name }}</label>
                </div>
                <!-- Email -->
                <div class="form-group">
                    <label>{{ __('messages.email') }}: {{ $friend->email }}</label>
                </div>
                <!-- Giới Tính -->
                <div class="form-group">
                    <label>{{ __('messages.gender') }}:
                        @if ($friend->gender == 'male')
                        {{ __('messages.male') }}
                        @elseif ($friend->gender == 'female')
                        {{ __('messages.female') }}
                        @else
                        {{ __('messages.other') }}
                        @endif
                    </label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.close') }}</button>
            </div>
        </div>
    </div>
</div>