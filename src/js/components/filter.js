export default function filter() {
/******/ (() => { // webpackBootstrap
    var __webpack_exports__ = {};
    /*!**************************!*\
      !*** ./src/js/filter.js ***!
      \**************************/
    const blockFilter = document.querySelector('.address__filters');
    const filterButton = document.querySelector('.address__button button');
    const bottomFilter = document.querySelector('.address__filter-bottom');
    let filterCheck = true;
    const choiceButton = document.querySelectorAll('.address__choice-button');
    function updateMainAccordionHeight() {
      setTimeout(() => {
        if (!filterCheck) {
          bottomFilter.style.maxHeight = bottomFilter.scrollHeight * 2 + 'px';
        }
      }, 100);
    }
    choiceButton.forEach(el => {
      el.addEventListener('click', () => {
        const nextContent = el.nextElementSibling;
        const wasActive = nextContent.classList.contains('active-filter');
        nextContent.classList.toggle('active-filter');
        if (!wasActive) {
          nextContent.style.maxHeight = nextContent.scrollHeight + 'px';
          el.classList.add('active-address-padding');
          updateMainAccordionHeight();
        } else {
          nextContent.style.maxHeight = null;
          el.classList.remove('active-address-padding');
          updateMainAccordionHeight();
        }
      });
    });
    filterButton?.addEventListener('click', (i) => {
      if (filterCheck) {
        bottomFilter.style.maxHeight = bottomFilter.scrollHeight + 'px';
        bottomFilter.classList.add('active-address-padding');
        filterButton.innerText = 'Скрыть';
        filterCheck = false;
        i.target.closest(".address__filters").style.overflowX = "hidden";
        i.target.closest(".address__filters").style.overflowY = "unset";
      } else {
        bottomFilter.style.maxHeight = 0;
        bottomFilter.classList.remove('active-address-padding');
        filterButton.innerText = 'еще фильтры';
        filterCheck = true;
        i.target.closest(".address__filters").style.overflowX = "unset";
        i.target.closest(".address__filters").style.overflowY = "hidden";
      }
    });
    /******/
  })()
    ;
  //# sourceMappingURL=filter.js.map
}