window.addEventListener('DOMContentLoaded', () => {
    const deleteButtons = document.querySelectorAll('[data-id]');

    deleteButtons.forEach((btn) => {
        const id = btn.dataset.id;
        btn.addEventListener('click', (e) => {
            fetch(`/s/deletemenuitem${id}`, { method: 'POST' })
                .then(res => res.json())
                .then(data => {
                    if (data.status === 'success') {
                        btn.closest('.input-group').remove();
                    }
                });
        });
    });
});