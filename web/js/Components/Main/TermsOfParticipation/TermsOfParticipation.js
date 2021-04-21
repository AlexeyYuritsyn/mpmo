
export const TermsOfParticipation = () => {

    /*const participants = [
        "учителя",
        "воспитатели",
        "педагогические работники дополнительного образования",
        "педагоги-психологи",
        "учителя-логопеды",
        "старшие вожатые",
        "вожатые",
        "тьюторы"
    ];*/

    /*const participantsList = participants.map(item =>
        `<li class="block-secondary-description">
            ${item}
        </li>`
    );*/

    return `<div class="terms-of-participation-wrap container">
                <div class="block-header">Номинации</div>
                <div class="terms-block">
                    <div class="terms-block-item">
                        <div class="green-category">Учитель – мастер</div>
                        <div class="block-secondary-description">возраст участника – <span class="marked-text">до 30 лет</span></div>
                        <div class="block-secondary-description">педагогический стаж работы – <span class="marked-text">не более 5 лет</span></div>
                    </div>
                    <div class="terms-block-item">
                        <div class="green-category">Учитель – лидер</div>
                        <div class="block-secondary-description">возраст участника – <span class="marked-text">до 30 лет</span></div>
                        <div class="block-secondary-description">педагогический стаж работы – <span class="marked-text">от 3 до 5 лет</span></div>
                    </div>
                    <div class="terms-block-item">
                        <div class="green-category">Профессиональный союз</div>
                        <div class="block-secondary-description">Команда одной образовательной организации из <span class="marked-text">5 человек</span>, являющаяся членом <span class="marked-text">Столичной ассоциации молодых педагогов</span></div>
                        <div class="block-secondary-description">Возраст каждого члена команды – <span class="marked-text">до 30 лет</span></div>
                    </div>
                </div>
                <div class="block-main-description"><span class="marked-text">В Конкурсе принимают участие:</span></div>
                <div class="block-secondary-description">– учителя общеобразовательных организаций, преподаватели организаций профессионального образования;</div>
                <div class="block-secondary-description">– воспитатели общеобразовательных организаций;</div>
                <div class="block-secondary-description">– педагогические работники дополнительного образования, педагоги-психологи, учителя-логопеды, старшие вожатые, вожатые, тьюторы.</div>
            </div>`;
}