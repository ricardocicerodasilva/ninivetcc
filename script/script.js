document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('menu-toggle');
    const navMenu = document.querySelector('.nav-menu');
    const menuItems = document.querySelectorAll('.nav-menu > ul > li');

    // Toggle menu visibility
    menuToggle.addEventListener('click', function(event) {
    event.stopPropagation();
    this.classList.toggle('active');
    navMenu.classList.toggle('active');
    document.querySelector('.overlay').style.display = this.classList.contains('active') ? 'block' : 'none'; // Mostrar ou ocultar overlay
});

// Adicione o seguinte para esconder o menu e o overlay ao clicar fora
document.addEventListener('click', function() {
    menuToggle.classList.remove('active');
    navMenu.classList.remove('active');
    document.querySelector('.overlay').style.display = 'none'; // Esconder overlay
});
// Toggle submenu visibility
menuItems.forEach(function(item) {
    item.addEventListener('click', function(event) {
        event.stopPropagation();
        // Esconde outros submenus
        menuItems.forEach(function(menuItem) {
            if (menuItem !== item) {
                menuItem.querySelector('.submenu').style.display = 'none';
            }
        });
        // Alterna a visibilidade do submenu do item clicado
        const submenu = item.querySelector('.submenu');
        submenu.style.display = submenu.style.display === 'block' ? 'none' : 'block';
    });
    document.addEventListener('click', function() {
    menuItems.forEach(function(item) {
        item.querySelector('.submenu').style.display = 'none'; // Esconde todos os submenus
    });
});

});


    // Prevent menu from closing when clicking inside it
    navMenu.addEventListener('click', function(event) {
        event.stopPropagation(); // Evita que o clique no menu se propague para o document
    });
});


let slideIndex = 0;
showSlides();

function showSlides() {
    const slides = document.getElementsByClassName("mySlides");
    
    // Esconde todas as imagens
    for (let i = 0; i < slides.length; i++) {
        slides[i].classList.remove("active");
    }

    // Atualiza o índice do slide
    slideIndex++;
    if (slideIndex > slides.length) { slideIndex = 1; }

    // Mostra a imagem atual
    slides[slideIndex - 1].classList.add("active");

    // Muda a imagem a cada 5 segundos
    setTimeout(showSlides, 10000);
}
