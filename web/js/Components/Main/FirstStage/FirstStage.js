import {OrangeButton} from "../OrangeButton.js";

export const FirstStage = () => {

    return `<div class="first-stage-wrap container">
                <div class="stage-header">
                    <div class="block-header">
                        <div>Дистанционный этап</div>
                    </div>
                    ${OrangeButton("Критерии оценивания", "https://mosmetod.ru/metodicheskoe-prostranstvo/molodym-spetsialistam/konkursy/molodye-pedagogi-moskovskomu-obrazovaniyu/mpmo-2020-krit-ots.html")}
                </div>
                <div class="stage-time-description">Сроки проведения: <span class="marked-text">11–30 января 2021 года</span></div>
                <div class="terms-block">
                    <div class="terms-block-item">
                        <div class="green-category">Учитель – мастер</div>
                        <ul class="objectives-group">
                            <li class="block-secondary-description">видеоролик «Представление участника»</li>
                            <li class="block-secondary-description">авторское эссе</li>
                            <li class="block-secondary-description">видеоролик «Просто о сложном»</li>
                        </ul>
                    </div>
                    <div class="terms-block-item">
                        <div class="green-category">Учитель – лидер</div>
                        <ul class="objectives-group">
                            <li class="block-secondary-description">видеоролик «Представление участника»</li>
                            <li class="block-secondary-description">авторское эссе</li>
                            <li class="block-secondary-description">тестирование</li>
                        </ul>
                    </div>
                    <div class="terms-block-item">
                        <div class="green-category">Профессиональный союз</div>
                        <ul class="objectives-group">
                            <li class="block-secondary-description">видеоролик «Представление Совета молодых педагогов образовательной организации»</li>
                            <li class="block-secondary-description">авторское эссе</li>
                            <li class="block-secondary-description">карта проекта</li>
                        </ul>
                    </div>
                </div>
            </div>`;
}