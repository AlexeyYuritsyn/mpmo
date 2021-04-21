export const LogoScrollToTop = () => {

    const logo = document.querySelector('.header-logo');
    logo.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            left: 0,
            behavior: 'smooth'
        });
    })
}

