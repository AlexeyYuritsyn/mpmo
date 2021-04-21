import {OrangeButton} from "../OrangeButton.js";

export const Registration = () => {

    return `<div class="registration-wrap container">
                <div class="block-header">Регистрация</div>
                <div class="registration-block">
                    <div class="registration-button-block">
                        <div class="block-main-description">Зарегистрироваться на конкурс можно <span class="marked-text">с 1 по 22 ноября 2020 года</span></div>
                        ${OrangeButton("регистрация", "/site/registration")}
                    </div>
                    <div class=block-secondary-description>Участник конкурса подтверждает, что ознакомился и полностью согласен с порядком проведения Конкурса, а также даёт согласие на обработку персональных данных</div>
                </div>
            </div>`;
}