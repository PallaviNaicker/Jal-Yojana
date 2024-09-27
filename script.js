document.addEventListener('DOMContentLoaded', () => {
    const actionBoxes = document.querySelectorAll('.action-box');

    actionBoxes.forEach(box => {
        box.addEventListener('click', () => {
            console.log(`Button clicked: ${box.querySelector('.icon-text').textContent}`);
            box.classList.add('clicked');
            setTimeout(() => box.classList.remove('clicked'), 150);
        });
    });
});
