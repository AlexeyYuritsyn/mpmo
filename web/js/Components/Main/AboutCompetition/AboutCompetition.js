
export const AboutCompetition = () => {

    const thesisUrl = "https://mosmetod.ru/metodicheskoe-prostranstvo/molodym-spetsialistam/konkursy/molodye-pedagogi-moskovskomu-obrazovaniyu/polozh-mpmo-2020-21.html";

    return `<div class="objectives-wrap container">
                <div class="goal-thesis-wrap">
                    <div class="block-header">Цель</div>
                    <div class="goal-block">
                        <div class="block-main-description">Адаптация начинающих специалистов системы образования Москвы, выявление талантливых педагогов и повышение социальной активности молодёжи.</div>
                    </div>
                    <div class="thesis-block">
                        <div class="block-main-description">
                            <div>Конкурс проводится в два этапа</div>
                            <div><span class="marked-text">с 1 ноября 2020 года по 16 апреля 2021 года</span></div>
                        </div>
                    </div>
                    <div class="thesis-url-wrap">
                        <a class="thesis-url" href=${thesisUrl} target="_blank">Положение о конкурсе молодёжных инициатив</a>
                    </div>
                </div>
                <div class="objectives-block">
                    <div class="block-header">Задачи</div>
                    <div class="objectives-list">
                        <ul class="objectives-group">
                            <li class="block-secondary-description">повышение престижа профессии педагога;</li>
                            <li class="block-secondary-description">вовлечение молодых педагогов в решение вопросов развития системы образования города Москвы;</li>
                            <li class="block-secondary-description">знакомство молодых педагогов с возможностями развития профессиональных компетенций и лидерских качеств, предоставляемыми системой образования города Москвы;</li>
                            <li class="block-secondary-description">выявление управленческого резерва из числа молодых педагогов столицы;</li>
                            <li class="block-secondary-description">поиск инновационных моделей повышения качества и открытости системы образования;</li>
                        </ul>
                        <ul class="objectives-group">                            
                            <li class="block-secondary-description">стимулирование интереса педагога к проектированию, исследованию, конструированию и другой творческой деятельности, к освоению метапредметных способов её организации;</li>
                            <li class="block-secondary-description">формирование компетенций в области решения задач на основе стратегического управления;</li>
                            <li class="block-secondary-description">способствование формированию и развитию советов молодых педагогов образовательных организаций.</li>
                        </ul>
                    </div>
                </div>
            </div>`;
}