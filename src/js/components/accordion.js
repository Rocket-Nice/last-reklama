export default function accordion() {
/******/ (() => { // webpackBootstrap
        var __webpack_exports__ = {};
        /*!*****************************!*\
          !*** ./src/js/accordion.js ***!
          \*****************************/
        const accordionCards = document.querySelectorAll('.accordions__li');
        accordionCards.forEach(card => {
            card.addEventListener('click', e => {
                if (e.target.closest('.accordions__card')) {
                    const self = e.currentTarget;
                    const content = self.querySelector('.accordions__content-li');
                    self.classList.toggle('activeAccordion');
                    accordionCards.forEach(other => {
                        if (other !== self) {
                            other.classList.remove('activeAccordion');
                            const otherCon = other.querySelector('.accordions__content-li');
                            otherCon.style.maxHeight = null;
                        }
                    });
                    if (self.classList.contains('activeAccordion')) {
                        content.style.maxHeight = content.scrollHeight + 'px';
                    } else {
                        content.style.maxHeight = null;
                    }
                }
            });
            window.addEventListener('resize', () => {
                accordionCards.forEach(card => {
                    if (card.classList.contains('activeAccordion')) {
                        const content = card.querySelector('.accordions__content-li');
                        content.style.maxHeight = content.scrollHeight + 'px';
                    }
                });
            });
        });
        /******/
})()
        ;
    //# sourceMappingURL=accordion.js.map
}