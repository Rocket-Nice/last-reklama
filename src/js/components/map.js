export default function map() {
/******/ (() => { // webpackBootstrap
    var __webpack_exports__ = {};
    /*!***********************!*\
      !*** ./src/js/map.js ***!
      \***********************/
    // open filter

    const choiceButton = document.querySelectorAll('.map-block__choice-button');
    choiceButton.forEach(el => {
      el.addEventListener('click', () => {
        const nextContent = el.nextElementSibling;
        nextContent.classList.toggle('active-filter');
        if (nextContent.classList.contains('active-filter')) {
          nextContent.style.maxHeight = nextContent.scrollHeight + 'px';
          el.classList.add('active-filter-padding');
        } else {
          nextContent.style.maxHeight = null;
          el.classList.remove('active-filter-padding');
        }
      });
    });

    // map

    const toggleButton = document.querySelector('.map-block__block-toggle');
    const listContent = document.querySelector('.map-block__list');
    const filterBlock = document.querySelector('.map-block__filter-main');
    const mapFun = document.querySelector('.map-block__functions');
    const mapScale = document.querySelector('.map-block__width');
    const mapsMain = document.querySelector('.map-block__maps');
    const closeBlocks = document.querySelectorAll('.map-block__top button');
    const mobButtons = document.querySelectorAll('.map-block__mob button');
    if (window.innerWidth > 850) {
      filterBlock?.classList.add('activeFilter');
    }
    let wasBelow850 = false;
    window.addEventListener('resize', () => {
      if (window.innerWidth < 850 && !wasBelow850) {
        filterBlock?.classList.remove('activeFilter');
        listContent?.classList.remove('activeR');
        mapFun?.classList.remove('activeList');
        wasBelow850 = true;
      } else if (window.innerWidth >= 850 && wasBelow850) {
        filterBlock?.classList.add('activeFilter');
        listContent?.classList.remove('activeR');
        toggleButton?.classList.remove('activeIcon');
        mapScale?.classList.remove('activeScale');
        wasBelow850 = false;
      }
    });
    toggleButton?.addEventListener('click', () => {
      if (filterBlock?.classList.contains('activeFilter')) {
        listContent?.classList.add('activeR');
        filterBlock?.classList.remove('activeFilter');
        mapFun?.classList.add('activeList');
        toggleButton?.classList.add('activeIcon');
      } else if (listContent?.classList.contains('activeR')) {
        filterBlock?.classList.add('activeFilter');
        listContent?.classList.remove('activeR');
        mapFun?.classList.remove('activeList');
        toggleButton?.classList.remove('activeIcon');
      } else {
        filterBlock?.classList.add('activeFilter');
        mapFun?.classList.remove('activeList');
        mapsMain?.classList.remove('activeMainMap');
        toggleButton?.classList.remove('activeIcon');
        mapScale?.classList.remove('activeScale');
      }
    });
    mobButtons[0]?.addEventListener('click', () => {
      filterBlock?.classList.add('activeFilter');
      listContent?.classList.remove('activeR');
      mapsMain?.classList.remove('activeMainMap');
    });
    mobButtons[1]?.addEventListener('click', () => {
      listContent?.classList.add('activeR');
      filterBlock?.classList.remove('activeFilter');
      mapsMain?.classList.remove('activeMainMap');
    });
    mapScale?.addEventListener('click', () => {
      if (mapsMain?.classList.contains('activeMainMap')) {
        filterBlock?.classList.add('activeFilter');
        mapFun?.classList.remove('activeList');
        mapsMain?.classList.remove('activeMainMap');
        mapScale?.classList.remove('activeScale');
      } else {
        filterBlock?.classList.remove('activeFilter');
        listContent?.classList.remove('activeR');
        mapsMain?.classList.add('activeMainMap');
        mapScale?.classList.add('activeScale');
        toggleButton?.classList.remove('activeIcon');
      }
    });

    if (window.innerWidth < 992) {
      closeBlocks.forEach(el => {
        el.style.display = 'flex';
        el.addEventListener('click', () => {
          if (listContent?.classList.contains('activeR') || filterBlock?.classList.contains('activeFilter')) {
            listContent?.classList.remove('activeR');
            filterBlock?.classList.remove('activeFilter');
            mapsMain?.classList.add('activeMainMap');
            mapScale?.classList.add('activeScale');
            toggleButton?.classList.remove('activeIcon');
          }
        });
      });
    } else {
      closeBlocks.forEach(el => {
        el.style.display = 'none';
      });
    }

    // indoor

    const buttonMapIndoor = document.querySelector('.indoor__top button');
    const indoorBlock = document.querySelector('.indoor__obj');
    const indoorMap = document.querySelector('.indoor__map-block');
    const buttonMapClose = document.querySelector('.indoor__none-map');
    const buttonMobIndoor = document.querySelector('.indoor__list-mob');
    if (buttonMapIndoor) {
      buttonMapIndoor.addEventListener('click', () => {
        indoorBlock.classList.add('closeIndoor');
        indoorMap.classList.remove('closeIndoor');
        document.getElementById('dir2').checked = true;
      });
    }
    if (buttonMapClose) {
      buttonMapClose.addEventListener('click', () => {
        listReturn();
      });
    }
    if (buttonMobIndoor) {
      buttonMobIndoor.addEventListener('click', () => {
        listReturn();
      });
    }
    const listReturn = () => {
      indoorBlock.classList.remove('closeIndoor');
      indoorMap.classList.add('closeIndoor');
    };

    // address

    const addresIbj = document.querySelector('.address__main-content');
    const buttonAddress = document.querySelector('.address__map-button-view');
    const addressMapClose = document.querySelector('.address__none-map');
    const mobClose = document.querySelector('.address__list-mob');
    const addressMap = document.querySelector('.address__map-block');
    if (buttonAddress) {
      buttonAddress.addEventListener('click', () => {
        addresIbj.classList.add('closeIndoor');
        addressMap.classList.remove('closeIndoor');
      });
    }
    if (addressMapClose) {
      addressMapClose.addEventListener('click', () => {
        addressReturn();
      });
    }
    if (mobClose) {
      mobClose.addEventListener('click', () => {
        addressReturn();
      });
    }
    const addressReturn = () => {
      addresIbj.classList.remove('closeIndoor');
      addressMap.classList.add('closeIndoor');
    };
    /******/
  })()
    ;
  //# sourceMappingURL=map.js.map
}