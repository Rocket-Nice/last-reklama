export default function basket() {
/******/ (() => { // webpackBootstrap
    var __webpack_exports__ = {};
    /*!**************************!*\
      !*** ./src/js/basket.js ***!
      \**************************/
    document.addEventListener('click', e => {
      if (e.target.closest('.basket__counter')) {
        const item = e.target.closest('.basket__card');
        const count = item.querySelector('.basket__counter p');
        let itemCount = parseInt(count.innerText);
        if (e.target.classList.contains('basket__plus')) {
          count.innerText = ++itemCount;
        }
        if (e.target.classList.contains('basket__min') && itemCount > 1) {
          count.innerText = --itemCount;
        }
      }
    });
    /******/

    // // Удаление элементов корзины
    // document.querySelectorAll('.basket__del').forEach(function (button) {
    //   const ajaxurl = window.location.origin + "/wp-admin/admin-ajax.php";
    //   button.addEventListener('click', function () {
    //     var index = this.getAttribute('data-index');
    //     var xhr = new XMLHttpRequest();
    //     xhr.open('POST', ajaxurl, true);
    //     xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
    //     xhr.onreadystatechange = function () {
    //       if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
    //         location.reload();
    //       }
    //     };
    //     xhr.send('action=remove_from_cart&index=' + index);
    //   });
    // });

    // // Функция добавления элементов в корзину
    // const buttons = document.querySelectorAll('.add_to_cart');

    // buttons.forEach(button => {
    //   button.addEventListener('click', function () {
    //     const ajaxurl = window.location.origin + "/wp-admin/admin-ajax.php";
    //     const productID = this.getAttribute('data-product_id');
    //     const side = this.getAttribute('data-side');
    //     const construction = this.getAttribute('data-construction');
    //     let characteristics = null;

    //     const formData = new FormData();
    //     formData.append('action', 'add_to_cart');
    //     formData.append('product_id', productID);

    //     if (side) {
    //       formData.append('side', side);

    //       characteristics = JSON.stringify({
    //         image: this.closest('.slider-info__slide').querySelector('.slider-info__slide-img img').src,
    //         price: this.closest('.slider-info__slide').querySelector('.outdoor_price').textContent,
    //         details: Array.from(this.closest('.slider-info__slide').querySelectorAll('.slider-info__text-block dl')).reduce((acc, dl) => {
    //           const dt = dl.querySelector('dt').textContent.replace(':', '').trim();
    //           const ddElement = dl.querySelector('dd').cloneNode(true); // клонируем элемент dd

    //           // Удаляем содержимое элементов с классом .structure__info-text и .structure__svg из клонированного ddElement
    //           const infoText = ddElement.querySelector('.structure__info-text');
    //           const svgElement = ddElement.querySelector('.structure__svg');

    //           if (infoText) {
    //             infoText.remove();
    //           }

    //           if (svgElement) {
    //             svgElement.remove();
    //           }

    //           const dd = ddElement.textContent.trim();
    //           acc[dt] = dd;
    //           return acc;
    //         }, {})
    //       });
    //     }
    //     if (construction) {
    //       formData.append('construction', construction);

    //       characteristics = JSON.stringify({
    //         image: this.closest('.slider-info__container').querySelector('.slider-info__slide-img img').src,
    //         price: this.closest('.slider-info__text-block').querySelector('.indoor_price').textContent,
    //         details: Array.from(this.closest('.slider-info__container').querySelectorAll('.slider-info__text-block dl')).reduce((acc, dl) => {
    //           const dt = dl.querySelector('dt').textContent.replace(':', '').trim();
    //           const ddElement = dl.querySelector('dd');

    //           const dd = ddElement.textContent.trim();
    //           acc[dt] = dd;
    //           return acc;
    //         }, {})
    //       });
    //     }

    //     formData.append('characteristics', characteristics);

    //     fetch(ajaxurl, {
    //       method: 'POST',
    //       body: formData
    //     })
    //       .then(response => response.json())
    //       .then(data => {
    //         if (data.success) {
    //           alert('Товар успешно добавлен в корзину!');
    //         } else {
    //           // alert('Ошибка добавления в корзину: ' + data.error);
    //           alert('Этот товар уже добавлен в корзину');
    //         }
    //       })
    //       .catch(error => console.error('Error:', error));
    //   });
    // });


    // Новый вариант через сетлок

    // Функция для обновления счетчика корзины
    function updateBasketCount() {
      const cart = JSON.parse(localStorage.getItem('simple_cart')) || [];
      const basketCountElement = document.querySelector('.header__basket');
      if (basketCountElement) {
        basketCountElement.setAttribute('data-count', cart.length);
      }
    }

    updateBasketCount();

    const buttons = document.querySelectorAll('.add_to_cart');

    buttons.forEach(button => {
      button.addEventListener('click', function () {
        const productID = this.getAttribute('data-product_id');
        const side = this.getAttribute('data-side');
        const construction = this.getAttribute('data-construction');
        const productUrl = this.getAttribute('data-link'); // Получаем URL записи

        let characteristics = null;

        if (side) {
          const slideElement = this.closest('.slider-info__slide');
          if (!slideElement) {
            console.error('Slide element not found.');
            return;
          }

          const imageElement = slideElement.querySelector('.slider-info__slide-img img');
          const priceElement = slideElement.querySelector('.outdoor_price');
          if (!imageElement || !priceElement) {
            console.error('Image or price element not found.');
            return;
          }

          characteristics = JSON.stringify({
            image: imageElement.src,
            price: priceElement.textContent,
            details: Array.from(slideElement.querySelectorAll('.slider-info__text-block dl')).reduce((acc, dl) => {
              const dt = dl.querySelector('dt').textContent.replace(':', '').trim();
              const ddElement = dl.querySelector('dd').cloneNode(true);

              // Удаляем содержимое элементов с классом .structure__info-text и .structure__svg из клонированного ddElement
              const infoText = ddElement.querySelector('.structure__info-text');
              const svgElement = ddElement.querySelector('.structure__svg');

              if (infoText) {
                infoText.remove();
              }

              if (svgElement) {
                svgElement.remove();
              }

              const dd = ddElement.textContent.trim();
              acc[dt] = dd;
              return acc;
            }, {})
          });
        }

        if (construction) {
          const containerElement = this.closest('.slider-info__container');
          if (!containerElement) {
            console.error('Container element not found.');
            return;
          }

          const imageElement = containerElement.querySelector('.slider-info__slide-img img');
          const priceElement = containerElement.querySelector('.indoor_price');
          if (!imageElement || !priceElement) {
            console.error('Image or price element not found.');
            return;
          }

          characteristics = JSON.stringify({
            image: imageElement.src,
            price: priceElement.textContent,
            details: Array.from(containerElement.querySelectorAll('.slider-info__text-block dl')).reduce((acc, dl) => {
              const dt = dl.querySelector('dt').textContent.replace(':', '').trim();
              const ddElement = dl.querySelector('dd');

              const dd = ddElement.textContent.trim();
              acc[dt] = dd;
              return acc;
            }, {})
          });
        }

        const slideElement = this.closest('.container');
        let slideTitle = '';

        if (slideElement) {
          const titleElement = slideElement.querySelector('h1');
          if (titleElement) {
            slideTitle = titleElement.textContent;
          }
        }

        const cartItem = {
          id: `${productID}_${side ? side : ''}${construction ? '_' + construction : ''}`,
          name: `${slideTitle}\n${side ? 'Сторона: ' + side : ''}${construction ? 'Конструкция: ' + construction : ''}`,
          price: JSON.parse(characteristics).price,
          quantity: 1,
          image: JSON.parse(characteristics).image,
          details: Object.entries(JSON.parse(characteristics).details).map(([key, value]) => `${key}: ${value}`).join(', '),
          url: productUrl // Сохраняем URL записи в объекте товара
        };

        // Получение текущей корзины из localStorage
        let cart = JSON.parse(localStorage.getItem('simple_cart')) || [];

        // Проверка на наличие товара с той же стороной в корзине
        const existingItemIndex = cart.findIndex(item => item.id === cartItem.id);
        if (existingItemIndex !== -1) {
          alert('Этот товар уже добавлен в корзину');
          return;
        }

        // Добавление товара в корзину, если его нет
        cart.push(cartItem);

        // Сохранение корзины в localStorage
        localStorage.setItem('simple_cart', JSON.stringify(cart));

        alert('Товар успешно добавлен в корзину!');

        // Обновление счетчика корзины после добавления товара
        updateBasketCount();
      });
    });

    // Обработчик корзины
    const basketCards = document.getElementById('basket-cards');
    const basketFullPrice = document.getElementById('basket-fullprice');

    if (basketCards) {
      function renderBasket() {
        const cart = JSON.parse(localStorage.getItem('simple_cart')) || [];

        if (cart.length === 0) {
          basketCards.innerHTML = '<p>Корзина пуста.</p>';
          basketFullPrice.innerHTML = '';
          return;
        }

        basketCards.innerHTML = '';
        let totalPrice = 0;

        cart.forEach((item, index) => {
          const itemDetails = item.details.split(', ').slice(0, 2).map(detail => {
            const [key, value] = detail.split(': ');
            return `<dl><dt>${key}:</dt><dd>${value}</dd></dl>`;
          }).join('');

          basketCards.innerHTML += `
        <div class="basket__card" data-index="${index}">
            <div class="basket__img">
                <img src="${item.image}" alt="${item.name}">
            </div>

            <div class="basket__info">
                <p><a href="${item.url}" target="_blank">${item.name}</a></p>
                <div class="basket__params">${itemDetails}</div>
            </div>

            <div class="basket__del" data-index="${index}">
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="none" viewBox="0 0 12 12">
                    <path stroke="#F7F7F7" stroke-width="1.607" d="M11.359.643.645 11.357m10.715 0L.644.643" />
                </svg>
            </div>
        </div>
      `;

          totalPrice += Number(item.price);
        });

      basketFullPrice.innerHTML = `
          <p><span>Элементов:</span> <span>${cart.length} шт</span></p>
      `;

        // Добавляем обработчик для удаления товара из корзины
        document.querySelectorAll('.basket__del').forEach(button => {
          button.addEventListener('click', function () {
            const index = this.getAttribute('data-index');
            cart.splice(index, 1);
            localStorage.setItem('simple_cart', JSON.stringify(cart));
            renderBasket();

            // Обновление счетчика корзины после удаления товара
            updateBasketCount();
          });
        });
      }

      renderBasket();
    }

  })()
    ;
  //# sourceMappingURL=basket.js.map
}