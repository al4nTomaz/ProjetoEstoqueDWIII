function buscar() {
    const termoBusca = document.getElementById('buscaInput').value.toLowerCase();
    const linhas = document.querySelectorAll('table tbody tr');

    linhas.forEach(linha => {
        const nome = linha.cells[1].textContent.toLowerCase();  // A segunda célula contém o nome do cliente
        
        if (nome.includes(termoBusca)) {
            linha.style.display = '';  // Exibe a linha
        } else {
            linha.style.display = 'none';  // Esconde a linha
        }
    });
}
