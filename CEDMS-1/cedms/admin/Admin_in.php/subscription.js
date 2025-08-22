document.addEventListener('DOMContentLoaded', () => {
    const demoBtns = document.querySelectorAll('.demo-btn');
    

    demoBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const cardType = btn.closest('.card').classList.contains('start-up') 
                ? 'Start-Up' 
                : 'Enterprise';
            alert(`Requesting demo for ${cardType} plan`);
            // In a real application, this would trigger a demo request form or modal
        });
    });

    
});