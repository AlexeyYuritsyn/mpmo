import {OrangeButton} from "../OrangeButton.js";

export const SecondStage = () => {

    return `<div class="second-stage-wrap container">
                <div class="stage-header">
                    <div class="block-header">
                        <div>Финал</div>
                    </div>
                    ${OrangeButton("Критерии оценивания", "https://mosmetod.ru/metodicheskoe-prostranstvo/molodym-spetsialistam/konkursy/molodye-pedagogi-moskovskomu-obrazovaniyu/mpmo-2020-krit-ots.html")}
                </div>
                <div class="stage-time-description">Сроки проведения: <span class="marked-text">15 февраля – 31 марта 2021 года</span></div>
                <div class="block-main-description"><span class="marked-text">Конкурсное испытание «Педагогическая игра» (для всех номинаций)</span></div>
                    <div class="terms-block-item">
                        <div class="block-secondary-description">Выявление лидеров среди молодых педагогов – участников Конкурса</div>
                    </div>
                <div class="block-main-description"><span class="marked-text">Конкурсное испытание по номинациям</span></div>
                <div class="terms-block">
                    <div class="terms-block-item">
                        <div class="green-category">Учитель – мастер</div>
                        <div class="block-secondary-description">Мастер-класс</div>
                    </div>
                    <div class="terms-block-item">
                        <div class="green-category">Учитель – лидер</div>
                        <div class="block-secondary-description">Представление управленческого проекта</div>
                    </div>
                    <div class="terms-block-item">
                        <div class="green-category">Профессиональный союз</div>
                        <div class="block-secondary-description">Защита проекта</div>
                    </div>
                </div>
                <div class="block-main-description"><span class="marked-text">Конкурсное испытание «Актуальный разговор» (для всех номинаций)</span></div>
                    <div class="terms-block-item">
                        <div class="block-secondary-description">Демонстрация эффективной публичной коммуникации, интеллектуальных способностей, лидерского потенциала, социальной ответственности и гражданской позиции</div>
                    </div>
            </div>`;
}