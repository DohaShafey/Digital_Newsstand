document.addEventListener('DOMContentLoaded', function() {
    console.log("Personalized news page loaded.");

   
    const gameLinks = document.querySelectorAll('.games-sidebar .game-link');
    gameLinks.forEach(link => {
        link.addEventListener('mouseover', () => {
            link.style.backgroundColor = '#f0f0f0'; 
        });
        link.addEventListener('mouseout', () => {
            link.style.backgroundColor = 'transparent';
        });
        link.addEventListener('click', (event) => {
            event.preventDefault(); 
            alert('Game link clicked! Implement game logic or navigation.');
        });
    });
});
