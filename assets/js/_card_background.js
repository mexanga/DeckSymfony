window.onLoadCardBackground = function (event = null) {
    const gridBackgrounds = document.querySelector('.grid-backgrounds');

    if (null === gridBackgrounds) {
        return;
    }
    const items = gridBackgrounds.querySelectorAll('.item');
    for (let item of items) {
        item.addEventListener('click', toggleActiveCardBackground);
    }

    updateCardBackgroundInput();
};

window.toggleActiveCardBackground = function (item) {
    const gridBackgrounds = item.closest('.grid-backgrounds');
    const items = gridBackgrounds.getElementsByClassName('item');
    for (let item of items) {
        item.classList.remove('active');
    }
    item.classList.add('active');

    updateCardBackgroundInput();
};

window.updateCardBackgroundInput = function () {
    const gridBackgrounds = document.querySelector('.grid-backgrounds');

    // Background
    let cardBackground;
    const cardBackgroundActive = gridBackgrounds.querySelector('.item.active');
    if (null !== cardBackgroundActive) {
        cardBackground = cardBackgroundActive.dataset.cardBackground;
    }
    // Color
    let cardColor;
    if (null !== cardBackgroundActive) {
        cardColor = cardBackgroundActive.dataset.cardColor;
    }

    const categoryCardBackgroundInput = document.getElementById('category_card_background');
    if (null !== categoryCardBackgroundInput) {
        categoryCardBackgroundInput.value = cardBackground;
    }

    const categoryCardColorInput = document.getElementById('category_card_color');
    if (null !== categoryCardColorInput) {
        categoryCardColorInput.value = cardColor;
    }

};