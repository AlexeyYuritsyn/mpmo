export const Footer = () => {

    const logoLinks = [
        {
            title: 'Городской методический центр',
            url: 'https://mosmetod.ru/',
            logo: '../../../images/logo/mosmetod.png',
            alt: 'mosmetod.ru'
        },
        {
            title: 'МГО Профсоюза образования',
            url: 'https://mgoprof.ru/',
            logo: '../../../images/logo/prof.png',
            alt: 'mgoprof.ru'
        },
        {
            title: 'САМП',
            url: 'https://www.facebook.com/sampmos',
            logo: '../../../images/logo/samp.png',
            alt: 'sampmos'
        },
        {
            title: 'Межпредметная ассоциация',
            url: 'https://ugmoscow.ru/',
            logo: '../../../images/logo/ma.jpg',
            alt: 'ugmoscow.ru'
        },
        {
            title: 'MAPOO',
            url: 'http://maroo.ru.com/',
            logo: '../../../images/logo/maro.jpg',
            alt: 'maroo.ru.com'
        },
    ]

    const logoLinksBlock = logoLinks.map(item =>
        `<a class="footer-logo-link" target="_blank" rel="noreferrer" title=${item.title} href=${item.url}>
            <img class="footer-logo-link-image" src=${item.logo} alt=${item.alt}>
        </a>`
    );


    const contacts = [
        {
            title: "mail",
            link: "mailto:kamenskiyma@mosmetod.ru",
            description: "kamenskiyma@mosmetod.ru",
            icon: '../../../images/logo/mail.svg',
        },
        {
            title: "Телефон",
            link: "tel:+79263471211",
            description: "+7 (926) 347-12-11",
            icon: '../../../images/logo/phone.svg',
        },
    ]

    const contactsBlock = contacts.map(item =>
        `<a class="footer-contacts-link" href=${item.link}>
            <span class="footer-contacts-text">${item.description}</span>
            <img class="footer-contacts-icon" src=${item.icon} alt=${item.title}>
        </a>`
    );

    return `<div class="footer container-white">
                <div class="footer-container">
                    <div class="footer-links container">
                        ${logoLinksBlock.join('')}
                        ${contactsBlock.join('')}
                    </div>
                </div>
                <script type="text/javascript" > (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter22241698 = new Ya.Metrika({ id:22241698, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script>
            </div>`
}