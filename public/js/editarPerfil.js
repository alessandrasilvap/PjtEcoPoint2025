
document.querySelector('form').addEventListener('submit', function(e) {
    const login = document.getElementById('login').value.trim();
    const email = document.getElementById('email').value.trim();
    let mensagens = [];

    if (login === "") {
        mensagens.push("O nome não pode ser vazio.");
    }
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        mensagens.push("O e-mail informado é inválido.");
    }

    if (mensagens.length > 0) {
        e.preventDefault(); // Impede envio
        alert(mensagens.join("\n"));
    }
});



