document.addEventListener('DOMContentLoaded', function () {
    const conversationId = document.getElementById('conversation_id').value;
    const authId = document.getElementById('auth_id').value;

    Echo.private('chat.' + conversationId)
        .listen('MessageSent', (e) => {
            console.log(e.message);

            const avatarUrl = e.message.sender.avatar_url;

            const messageHtml = `
                <div class="message d-flex mb-3 ${e.message.sender_id === authId ? 'justify-content-end' : ''}">
                    ${e.message.sender_id !== authId ? `
                        <img src="${avatarUrl}" alt="User" class="rounded-circle me-3" style="object-fit: cover" width="40" height="40">
                    ` : ''}
                    <div class="message-content ${e.message.sender_id === authId ? 'bg-primary text-white' : 'bg-white'} p-2 rounded">
                        <p class="mb-0">${e.message.message}</p>
                        <span class="message-time text-muted small">${e.message.created_at}</span>
                    </div>
                    ${e.message.sender_id === authId ? `
                        <img src="${avatarUrl}" alt="User" class="rounded-circle ms-3" style="object-fit: cover" width="40" height="40">
                    ` : ''}
                </div>
            `;

            $('.box-chat').prepend(messageHtml);
            var chatBox = document.querySelector('.box-chat');
            chatBox.scrollTop = chatBox.scrollHeight;
        });
});



document.addEventListener('DOMContentLoaded', function () {
    $(document).on('submit', '#send-message-form', function (e) {
        console.log('submitting message');

        e.preventDefault();

        let message = $('#messageInput').val();

        $.ajax({
            url: '/send-message',
            type: 'POST',
            data: {
                _token: $('input[name="_token"]').val(),
                conversation_id: $('#conversation_id').val(),
                message: message
            },
            success: function (response) {
                if (response.status === 'success') {
                    $('#messageInput').val('');
                } else {
                    showToastr(response.message, 'error');
                }
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    // Validation error
                    let errors = xhr.responseJSON.errors;
                    let errorMessage = '';
                    for (let key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            errorMessage += errors[key][0] + '\n';
                        }
                    }

                    showToastr(errorMessage, 'error');

                } else {
                    showToastr(xhr.responseJSON.message, 'error');
                }
            }
        });
    });
});
