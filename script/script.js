document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('menu-toggle');
    const navMenu = document.querySelector('.nav-menu');
    const overlay = document.querySelector('.overlay');

    // Alterna visibilidade do menu e overlay
    menuToggle.addEventListener('click', function(event) {
        event.stopPropagation();
        const isActive = this.classList.toggle('active');
        navMenu.classList.toggle('active', isActive);
        overlay.style.display = isActive ? 'block' : 'none';
    });

    // Esconde o menu e overlay ao clicar fora
    document.addEventListener('click', function() {
        menuToggle.classList.remove('active');
        navMenu.classList.remove('active');
        overlay.style.display = 'none';
    });

    // Impede que o menu feche ao clicar dentro dele
    navMenu.addEventListener('click', function(event) {
        event.stopPropagation();
    });

    // Controle do submenu dentro do menu principal
    navMenu.querySelectorAll('.nav-menu > ul > li').forEach(item => {
        const submenu = item.querySelector('.submenu');
        if (submenu) {
            item.addEventListener('click', function(event) {
                event.stopPropagation();
                
                // Alterna a visibilidade do submenu
                const isVisible = submenu.style.display === 'block';
                navMenu.querySelectorAll('.submenu').forEach(sm => sm.style.display = 'none');
                submenu.style.display = isVisible ? 'none' : 'block';
            });
        }
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
