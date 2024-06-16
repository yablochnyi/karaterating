
<div class="login_wrapper">
    <div class="login_bg_block"></div>
    <div class="login_bg" style="box-shadow: 0px 12px 20px -10px #0000000D;">
        <div class="login_box " style="transform: translateY(-10%);">
            <h1 class="login_box__title">Авторизация</h1>
            <div class="login_box__form">
                <label>
                    Введите e-mail
                    <input wire:model="email" type="email">
                </label>
                <label>
                    Введите password
                    <input wire:model="password" type="password">
                </label>
                <a href="#">Забыли пароль?</a>
                <button type="submit" wire:click="register">Войти</button>
            </div>
        </div>
    </div>
</div>

