document.getElementById('comment-form').addEventListener('submit', function(event) {
    event.preventDefault();
    const commentText = document.getElementById('user-comment').value.trim();
    if (commentText !== '') {
        addComment(commentText);
        document.getElementById('user-comment').value = ''; // Limpiar el campo de comentario
    }
});

function addComment(text) {
    const commentsList = document.getElementById('comments-list');
    const comment = document.createElement('div');
    comment.className = 'comment mb-4 p-3 border rounded';
    comment.innerHTML = `
        <div class="d-flex justify-content-between">
            <h5>Usuario Nuevo</h5>
            <div>
                <button class="btn btn-sm btn-warning me-2" onclick="editComment(this)">Editar</button>
                <button class="btn btn-sm btn-danger" onclick="deleteComment(this)">Eliminar</button>
            </div>
        </div>
        <p class="comment-text">${text}</p>
    `;
    commentsList.appendChild(comment);
}

function editComment(button) {
    const commentTextElement = button.closest('.comment').querySelector('.comment-text');
    const newText = prompt('Edita tu comentario:', commentTextElement.textContent);
    if (newText !== null) {
        commentTextElement.textContent = newText.trim();
    }
}

function deleteComment(button) {
    if (confirm('¿Estás seguro de que deseas eliminar este comentario?')) {
        const comment = button.closest('.comment');
        comment.remove();
    }
}