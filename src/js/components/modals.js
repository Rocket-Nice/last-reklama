export default function modals() {
  /******/ (() => {
    var __webpack_exports__ = {};
    /*!**************************!*\
      !*** ./src/js/modals.js ***!
      \**************************/
    const bg = document.querySelector('.modal-set');
    const modalOne = document.querySelector('.modal-number');
    const modalTwo = document.querySelector('.modal-numberTwo');
    const excellentModal = document.querySelector('.modal-exellent');
    const applicationForms = document.querySelectorAll('.application__form');
    const btn = document.querySelectorAll('.home__button-active-b');

    function visible(modal) {
      bg?.classList.add('bgActive');
      modal?.classList.add('modalActive');
    }

    function del(modal) {
      bg?.classList.remove('bgActive');
      modal?.classList.remove('modalActive');
    }
    document.addEventListener('keydown', e => {
      if (e.key === 'Escape') {
        del(modalOne);
        del(modalTwo);
        del(excellentModal);
      }
    });
    document.addEventListener('click', e => {
      if (e.target.classList.contains('modal-set')) {
        del(modalOne);
        del(modalTwo);
        del(excellentModal);
      }
    });
    document.addEventListener('click', e => {
      if (e.target.closest('.header__telephone') || e.target.closest('.burger__telephone')) {
        visible(modalOne);
      }
      if (e.target.closest('.modal-number__del') || e.target.closest('.modal-numberTwo__del') || e.target.closest('.modal-exellent__del')) {
        del(modalOne);
        del(modalTwo);
        del(excellentModal);
      }
    });

    if (applicationForms) {
      // applicationForms.forEach(form => {
      //   form.addEventListener('submit', e => {
      //     e.preventDefault();

      //     var organization = form.querySelector('input[placeholder="Название организации"]').value.trim();
      //     var email = form.querySelector('input[placeholder="Электронная почта"]').value.trim();
      //     var phone = form.querySelector('input[placeholder="Телефон"]').value.trim();
      //     var comment = form.querySelector('textarea[placeholder="Комментарий к заявке"]')?.value.trim();
      //     var checkbox = form.querySelector('.application__chekbox');
      //     const ajaxurl = window.location.origin + "/wp-admin/admin-ajax.php";

      //     if (!organization || !email || !phone || !checkbox.checked) {
      //       alert('Пожалуйста, заполните все обязательные поля и согласитесь с условиями.');
      //       return;
      //     }

      //     var formData = new FormData();
      //     formData.append('action', 'send_application');
      //     formData.append('organization', organization);
      //     formData.append('email', email);
      //     formData.append('phone', phone);
      //     formData.append('comment', comment);

      //     var hasCartItems = form.closest('.basket') ? 'true' : 'false';
      //     formData.append('has_cart_items', hasCartItems);

      //     var xhr = new XMLHttpRequest();
      //     xhr.open('POST', ajaxurl, true);
      //     xhr.onreadystatechange = function () {
      //       if (xhr.readyState === XMLHttpRequest.DONE) {
      //         var response = JSON.parse(xhr.responseText);
      //         if (xhr.status === 200 && response.success) {
      //           alert('Заявка успешно отправлена.');
      //           del(modalTwo);
      //           visible(excellentModal);
      //           // location.reload();
      //         } else {
      //           alert('Ошибка при отправке заявки. Попробуйте еще раз.');
      //         }
      //       }
      //     };
      //     xhr.send(formData);
      //   });
      // });

      applicationForms.forEach(form => {
        form.addEventListener('submit', e => {
          e.preventDefault();

          const organization = form.querySelector('input[placeholder="Название организации"]').value.trim();
          const email = form.querySelector('input[placeholder="Электронная почта"]').value.trim();
          const phone = form.querySelector('input[placeholder="Телефон"]').value.trim();
          const comment = form.querySelector('textarea[placeholder="Комментарий к заявке"]')?.value.trim();
          const checkbox = form.querySelector('.application__chekbox');
          const ajaxurl = window.location.origin + "/wp-admin/admin-ajax.php";

          if (!organization || !email || !phone || !checkbox.checked) {
            alert('Пожалуйста, заполните все обязательные поля и согласитесь с условиями.');
            return;
          }

          const formData = new FormData();
          formData.append('action', 'send_application');
          formData.append('organization', organization);
          formData.append('email', email);
          formData.append('phone', phone);
          formData.append('comment', comment);

          const cart = JSON.parse(localStorage.getItem('simple_cart')) || [];
          formData.append('cart_items', JSON.stringify(cart));

          const xhr = new XMLHttpRequest();
          xhr.open('POST', ajaxurl, true);
          xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
              const response = JSON.parse(xhr.responseText);
              if (xhr.status === 200 && response.success) {
                alert('Заявка успешно отправлена.');
                del(modalTwo);
                visible(excellentModal);
                localStorage.removeItem('simple_cart');
              } else {
                alert('Ошибка при отправке заявки. Попробуйте еще раз.');
              }
            }
          };
          xhr.send(formData);
        });
      });
    }

    if (btn) {
      btn.forEach(el => {
        el.addEventListener('click', () => {
          visible(modalTwo);
        });
      });
    }

    const secondForm = document.querySelector('.modal-number__right');
    if (secondForm) {
      const button = secondForm.querySelector('.home__button');

      button.addEventListener('click', function (e) {
        e.preventDefault();

        const name = secondForm.querySelector('input[type="text"]').value.trim();
        const phone = secondForm.querySelector('input[type="tel"]').value.trim();
        const checkbox = secondForm.querySelector('.application__chekbox');
        const ajaxurl = window.location.origin + "/wp-admin/admin-ajax.php";

        if (!name || !phone || !checkbox.checked) {
          alert('Пожалуйста, заполните все обязательные поля и согласитесь с условиями!');
          return;
        }

        const formData = new FormData();
        formData.append('action', 'send_call_request');
        formData.append('name', name);
        formData.append('phone', phone);

        const xhr = new XMLHttpRequest();
        xhr.open('POST', ajaxurl, true);
        xhr.onreadystatechange = function () {
          if (xhr.readyState === XMLHttpRequest.DONE) {
            const response = JSON.parse(xhr.responseText);
            if (xhr.status === 200 && response.success) {
              alert('Ваш запрос успешно отправлен.');
            } else {
              alert('Ошибка при отправке запроса. Попробуйте еще раз.');
            }
          }
        };
        xhr.send(formData);
      });
    }
    /******/
  })();
  //# sourceMappingURL=modals.js.map
}
