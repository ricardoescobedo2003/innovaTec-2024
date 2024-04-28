document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('loginForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Evitar que se envíe el formulario automáticamente

        var form = this;
        var formData = new FormData(form);

        fetch(form.action, {
            method: form.method,
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                window.location.href = 'dashboard.php'; // Redirigir al dashboard en caso de éxito
            } else {
                document.getElementById('message').innerText = data.message;
            }
        })
        .catch(error => console.error('Error:', error));
    });
});
