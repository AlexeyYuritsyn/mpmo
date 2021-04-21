import {Header} from "./Components/Header/Header.js";
import {Main} from "./Components/Main/Main.js";
import {Footer} from "./Components/Footer/Footer.js";
import {ContainerColor} from "./Components/ContainerColor/ContainerColor.js";
import {LogoScrollToTop} from "./Components/Header/LogoScrollToTop.js";
import {MenuClickHandler} from "./Components/ActiveMenu/ActiveMenu.js";
import {Overlay} from "./Components/Header/Overlay.js";


const template = `${Header()}${Main()}${Footer()}`;

document.querySelector('#root').insertAdjacentHTML('afterbegin', template);

const mainItemsArray = document.querySelectorAll('.colored-block');
ContainerColor(mainItemsArray);

LogoScrollToTop();
MenuClickHandler();
Overlay();