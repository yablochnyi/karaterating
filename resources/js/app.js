document.addEventListener('DOMContentLoaded', function () {
    const avatars = document.querySelectorAll('.avatar-with-stripes');

    avatars.forEach(avatar => {
        const beltColor = avatar.getAttribute('data-belt-color');
        const stripes = JSON.parse(avatar.getAttribute('data-stripes') || '[]');

        avatar.style.setProperty('--belt-color', beltColor);

        // Добавляем полоски на основе данных
        stripes.forEach((stripeColor, index) => {
            const stripe = document.createElement('div');
            stripe.classList.add('belt-stripe');
            stripe.style.backgroundColor = stripeColor;
            stripe.style.left = `${5 * (index + 1)}%`; // Позиция полосы
            avatar.appendChild(stripe);
        });
    });
});

