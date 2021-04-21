export const Overlay = () => {

    const mainBlock = document.querySelector('.main');
    const menuCheckbox = document.querySelector('#menuCheckbox');

    const setOverlay = () => {
        mainBlock.insertAdjacentHTML('afterbegin', `<div class="overlay" />`);
        menuCheckbox.setAttribute('checked', 'checked');
    }

    const removeOverlay = () => {
        const overlay = document.querySelector('.overlay');
        overlay.remove();
        menuCheckbox.removeAttribute('checked');
    }

    const testBlock = document.querySelector('#menuToggle');
    testBlock.addEventListener('click', () => {
        const menuCheckboxStatus = menuCheckbox.getAttribute('checked');
        menuCheckboxStatus ? removeOverlay() : setOverlay();
    })

    mainBlock.addEventListener('click', (event) => {
        const overlay = document.querySelector('.overlay');
        if (event.target === overlay) {
            removeOverlay()
        }
    })
}