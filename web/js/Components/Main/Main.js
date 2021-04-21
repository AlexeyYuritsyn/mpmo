import {LogoTitle} from "./LogoTitle/LogoTitle.js";
import {TermsOfParticipation} from "./TermsOfParticipation/TermsOfParticipation.js";
import {AboutCompetition} from "./AboutCompetition/AboutCompetition.js";
import {Schedule} from "./Schedule/Schedule.js";
import {Registration} from "./Registration/Registration.js";
import {FirstStage} from "./FirstStage/FirstStage.js";
import {SecondStage} from "./SecondStage/SecondStage.js";

export const Main = () => {

    const mainItems = [
        {
            id: 'logo-title',
            content: LogoTitle()
        },
        {
            id: 'about-competition',
            content: AboutCompetition()
        },
        {
            id: 'nominations',
            content: TermsOfParticipation()
        },
        {
            id: 'schedule',
            content: Schedule()
        },
        {
            id: 'registration',
            content: Registration()
        },
        {
            id: 'first-step',
            content: FirstStage()
        },
        {
            id: 'second-step',
            content: SecondStage()
        },
    ]

    const mainContent = mainItems.map(item =>
        `<div id=${item.id} class="main-item colored-block">
            ${item.content}
        </div>`
    );

    return `<div class="main">
                ${mainContent.join('')}
            </div>`;
}