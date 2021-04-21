export const Header = () => {

    const menu = [
        {
            "title": "О конкурсе",
            "link": "#about-competition"
        },
        {
            "title": "Номинации",
            "link": "#nominations"
        },
        {
            "title": "Сроки проведения",
            "link": "#schedule"
        },
        {
            "title": "Регистрация",
            "link": "#registration"
        },
        {
            "title": "Первый этап",
            "link": "#first-step"
        },
        {
            "title": "Второй этап",
            "link": "#second-step"
        },
    ];

    const menuBlock = menu.map(item =>
        `<li class="menu-item">
            <a class="menu-item-link" href=${item.link}>
                ${item.title}
            </a>
        </li>`
    );

    const menuDesktop = () => {

        return `<ul class="menu-list menu-desktop" id="menu">
                    ${menuBlock.join('')}
                    <li class="menu-enter">
                        <a class="menu-enter-link" target="_blank" rel="noreferrer" href='/site/login'>
                            Вход
                        </a>
                    </li>
                </ul>`
    }

    const menuMobile = () => {

        return `<nav class="menu-mobile" role="navigation">
                    <div id="menuToggle">
                        <input id="menuCheckbox" type="checkbox" />
                        <span></span>
                        <span></span>
                        <span></span>
                        <ul class="menu-mobile-list" id="menu">
                            ${menuBlock.join('')}
                            <li class="menu-enter">
                                <a class="menu-enter-link" target="_blank" rel="noreferrer" href='/site/login'>
                                    Вход
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>`
    }

    return `<div class="header container-white">
                <div class="container-orange">
                    <div class="header-content container">
                        <img class="header-logo" src="../../../images/logo/young_pedagog_logo.png" alt="logo"> 
                        ${menuDesktop()}
                        ${menuMobile()}
                    </div>
                </div>
            </div>`;
}