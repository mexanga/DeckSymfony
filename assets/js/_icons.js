window.onLoadIcons = function (event = null) {
    const gridIcons = document.querySelector('.grid-icons');

    console.log({gridIcons});

    if (null === gridIcons) {
        return;
    }
    const icons = gridIcons.querySelectorAll('.icon');
    console.log({gridIcons, icons});
    for (let icon of icons) {
        console.log({icon});
        icon.addEventListener('click', toggleActiveIcon);
    }

    updateIconInput();
};

window.toggleActiveIcon = function (item) {
    const gridIcons = item.closest('.grid-icons');
    const icons = gridIcons.getElementsByClassName('icon');
    for (let icon of icons) {
        icon.classList.remove('active');
    }
    item.classList.add('active');

    updateIconInput();
};

window.toggleActiveTypeCard = function (item) {
    const btnGroup = item.closest('.btn-group');
    const buttons = btnGroup.getElementsByClassName('btn');
    for (let button of buttons) {
        // remove active
        button.classList.remove('active');
    }
    item.classList.add('active');

    const {typeCard} = item.dataset;

    const gridIconsWrapper = btnGroup.closest('.grid-icons-wrapper');
    const icons = gridIconsWrapper.getElementsByClassName('ss');
    for (let icon of icons) {
        icon.classList.remove('ss-common');
        icon.classList.remove('ss-uncommon');
        icon.classList.remove('ss-rare');
        icon.classList.remove('ss-mythic');
        icon.classList.remove('ss-foil');

        icon.classList.add('ss-' + typeCard);
    }

    updateIconInput();
};

window.toggleActiveGradient = function (item) {
    const isActive = item.classList.contains('active');

    const btnGroup = item.closest('.btn-group');
    const buttons = btnGroup.getElementsByClassName('btn');
    for (let button of buttons) {
        // remove active
        button.classList.remove('active');
    }

    item.classList.remove('active');
    if (false === isActive) {
        item.classList.add('active');
    }

    const gridIconsWrapper = btnGroup.closest('.grid-icons-wrapper');
    const icons = gridIconsWrapper.getElementsByClassName('ss');
    for (let icon of icons) {
        icon.classList.remove('ss-grad');
        if (false === isActive) {
            icon.classList.add('ss-grad');
        }
    }

    updateIconInput();
};

window.updateIconInput = function () {
    const gridIconsWrapper = document.querySelector('.grid-icons-wrapper');

    // Type
    const gridIconsTemplateType = gridIconsWrapper.querySelector('.grid-icons-wrapper__template__type');
    const gridIconsTemplateTypeButtonActive = gridIconsTemplateType.querySelector('.btn.active');
    const type = gridIconsTemplateTypeButtonActive.dataset.typeCard;
    const classType = 'ss-' + type;

    // Gradient
    const gridIconsTemplateGradient = gridIconsWrapper.querySelector('.grid-icons-wrapper__template__gradient');
    const gridIconsTemplateGradientButtonActive = gridIconsTemplateGradient.querySelector('.btn.active');
    const classGradient = 'ss-grad';

    // Icon
    let classIcon;
    const gridIcons = gridIconsWrapper.querySelector('.grid-icons');
    const gridIconsIconActive = gridIcons.querySelector('.icon.active');
    if (null !== gridIconsIconActive) {
        const icon = gridIconsIconActive.dataset.icon;
        classIcon = 'ss-' + icon;
    }

    let iconValue = 'ss ' + classType;

    if (null !== gridIconsIconActive) {
        iconValue += ' ' + classIcon;
    }

    const hasGradientActive = null !== gridIconsTemplateGradientButtonActive;
    if (true === hasGradientActive) {
        iconValue += ' ' + classGradient;
    }

    const categoryIconInput = document.getElementById('category_icon');
    if (null !== categoryIconInput) {
        categoryIconInput.value = iconValue;
    }

};