<?php get_header();
/* Template Name: Map*/
?>

<main class="main-map">

    <section class="map-page">
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // // Инициализация списка элементов в зависимости от данных PHP
                // let elementsList = <?php //echo json_encode($elementsListOutdoor); ?>;

                // Получение всех радио-кнопок для выбора типа объекта
                let directionInputs = document.querySelectorAll('.map-block__direction input[type="radio"]');

                // Тип объекта по умолчанию
                let typeObject = 'outdoor';

                // // Функция для обновления информации о районе
                // function updateDistrictInfo(descriptions) {
                //     // Находим заголовок для района и обновляем его содержимое
                //     let districtInfo = document.querySelector('.map-block__list-top h3');
                //     districtInfo.textContent = descriptions.join(', ');
                // }

                // // Функция для обновления счетчика карточек
                // function updateCardCount() {
                //     // Находим все видимые карточки
                //     let visibleCards = document.querySelectorAll('.map-block__cards:not([style*="display: none"]) .map-block__card');
                //     let cardCount = visibleCards.length;
                //     let cardCountText = cardCount === 1 ? '1 объект' : `${cardCount} объектов`;
                //     // Находим информацию о количестве карточек и обновляем текст
                //     let cardCountInfo = document.querySelector('.map-block__list-top p');
                //     cardCountInfo.textContent = cardCountText;
                // }

                // Функция для обновления URL
                function updateURL() {
                    const params = new URLSearchParams();

                    // Обновление параметров URL для outdoor
                    if (typeObject === 'outdoor') {
                        if (selectedFormatValues.length > 0) params.set('format', selectedFormatValues.join(','));
                        if (selectedRajonValues.length > 0) params.set('rajon', selectedRajonValues.join(','));
                        if (selectedRaspValues.length > 0) params.set('rasp', selectedRaspValues.join(','));
                        if (selectedFeaturesValues.length > 0) params.set('features', selectedFeaturesValues.join(','));
                        if (selectedIdOutdoor) params.set('id', selectedIdOutdoor);
                    }
                    // Обновление параметров URL для indoor
                    else if (typeObject === 'indoor') {
                        if (selectedFormatValuesIndoor.length > 0) params.set('format-indoor', selectedFormatValuesIndoor.join(','));
                        if (selectedAddressValues.length > 0) params.set('address', selectedAddressValues.join(','));
                    }

                    // Устанавливаем параметр 'type' в URL
                    params.set('type', typeObject);
                    history.replaceState(null, '', '?' + params.toString());
                }

                // Функция для применения параметров URL
                function applyURLParams() {
                    const params = new URLSearchParams(window.location.search);

                    // Установка значения type в 'outdoor', если его нет в URL
                    if (!params.has('type')) {
                        typeObject = 'outdoor';
                        updateURL(); // Вызываем функцию обновления URL
                    }

                    // Установка типа объекта на основе параметра в URL
                    if (params.get('type')) {
                        typeObject = params.get('type');

                        if (typeObject === 'outdoor') {
                            // Помечаем радио-кнопку для outdoor
                            document.getElementById('dir1').checked = true;
                            // elementsList = <?php //echo json_encode($elementsListOutdoor); ?>;

                            // // Показываем список outdoor и скрываем indoor
                            // document.querySelector('.indoor-list').style.display = 'none';
                            // document.querySelector('.outdoor-list').style.display = 'flex';

                            // Показываем фильтры для outdoor
                            document.querySelector('.map-block__id').style.display = 'block';
                            document.querySelector('.map-block__choices.format').style.display = 'block';
                            document.querySelector('.map-block__choices.rajon').style.display = 'block';
                            // document.querySelector('.map-block__choices.raspolozhenie').style.display = 'block';
                            document.querySelector('.map-block__choices.features').style.display = 'block';
                            document.querySelector('.map-block__choices.format-indoor').style.display = 'none';
                            document.querySelector('.map-block__choices.address').style.display = 'none';

                        } else if (typeObject === 'indoor') {
                            // Помечаем радио-кнопку для indoor
                            document.getElementById('dir2').checked = true;
                            // elementsList = <?php //echo json_encode($elementsListIndoor); ?>;

                            // Показываем список indoor и скрываем outdoor
                            // document.querySelector('.outdoor-list').style.display = 'none';
                            // document.querySelector('.indoor-list').style.display = 'flex';

                            // Скрываем фильтры для outdoor, так как мы на indoor
                            document.querySelector('.map-block__id').style.display = 'none';
                            document.querySelector('.map-block__choices.format').style.display = 'none';
                            document.querySelector('.map-block__choices.rajon').style.display = 'none';
                            // document.querySelector('.map-block__choices.raspolozhenie').style.display = 'none';
                            document.querySelector('.map-block__choices.features').style.display = 'none';
                            document.querySelector('.map-block__choices.format-indoor').style.display = 'block';
                            document.querySelector('.map-block__choices.address').style.display = 'block';
                        }
                    }

                    // Применяем фильтры на основе параметров URL
                    if (typeObject === 'outdoor') {
                        selectedFormatValues = params.get('format') ? params.get('format').split(',') : [];
                        selectedRajonValues = params.get('rajon') ? params.get('rajon').split(',') : [];
                        selectedRaspValues = params.get('rasp') ? params.get('rasp').split(',') : [];
                        selectedFeaturesValues = params.get('features') ? params.get('features').split(',') : [];
                        selectedIdOutdoor = params.get('id') ? params.get('id') : '';

                        // Устанавливаем состояние чекбоксов для outdoor
                        setCheckboxState(formatOutdoor, selectedFormatValues);
                        setCheckboxState(rajonOutdoor, selectedRajonValues);
                        setCheckboxState(locationOutdoor, selectedRaspValues);
                        setCheckboxState(featuresOutdoor, selectedFeaturesValues);
                        idOutdoorInput.value = selectedIdOutdoor;

                        // Отправляем формат для outdoor
                        sendFormatOutdoor();
                    } else if (typeObject === 'indoor') {
                        selectedFormatValuesIndoor = params.get('format-indoor') ? params.get('format-indoor').split(',') : [];
                        selectedAddressValues = params.get('address') ? params.get('address').split(',') : [];

                        // Устанавливаем состояние чекбоксов для indoor
                        setCheckboxState(formatIndoor, selectedFormatValuesIndoor);
                        setCheckboxState(addressIndoor, selectedAddressValues);

                        // Отправляем формат для indoor
                        sendFormatIndoor();
                    }

                    // Обновляем URL
                    updateURL();
                }

                // Функция для установки состояния чекбоксов
                function setCheckboxState(checkboxes, selectedValues) {
                    checkboxes.forEach((input) => {
                        input.checked = selectedValues.includes(input.value);
                    });
                }

                // Обработчики изменения радио-кнопок
                directionInputs.forEach((input) => {
                    input.addEventListener('change', function() {
                        setTimeout(() => {
                            typeObject = this.value; // Устанавливаем тип объекта
                            updateURL(); // Обновляем URL
                            applyURLParams(); // Применяем параметры URL

                        }, 300);
                    });
                });

                // Списки чекбоксов для фильтров outdoor
                let formatOutdoor = document.querySelectorAll('.map-block__choices.format input[type="checkbox"]');
                let rajonOutdoor = document.querySelectorAll('.map-block__choices.rajon input[type="checkbox"]');
                let locationOutdoor = document.querySelectorAll('.map-block__choices.raspolozhenie input[type="checkbox"]');
                let featuresOutdoor = document.querySelectorAll('.map-block__choices.features input[type="checkbox"]');

                // Выбранные значения фильтров outdoor
                let selectedFormatValues = [];
                let selectedRajonValues = [];
                let selectedRaspValues = [];
                let selectedFeaturesValues = [];

                // Списки чекбоксов для фильтров indoor
                let formatIndoor = document.querySelectorAll('.map-block__choices.format-indoor input[type="checkbox"]');
                let addressIndoor = document.querySelectorAll('.map-block__choices.address input[type="checkbox"]');

                // Выбранные значения фильтров indoor
                let selectedFormatValuesIndoor = [];
                let selectedAddressValues = [];

                // Обработчики изменения состояния чекбоксов для формата outdoor
                formatOutdoor.forEach((input) => {
                    input.addEventListener('change', function() {
                        let value = this.value;
                        if (this.checked) {
                            selectedFormatValues.push(value);
                        } else {
                            let index = selectedFormatValues.indexOf(value);
                            if (index !== -1) {
                                selectedFormatValues.splice(index, 1);
                            }
                        }
                        updateURL(); // Обновляем URL
                        sendFormatOutdoor(); // Отправляем формат для outdoor
                    });
                });

                // Обработчики изменения состояния чекбоксов для формата indoor
                formatIndoor.forEach((input) => {
                    input.addEventListener('change', function() {
                        let value = this.value;
                        if (this.checked) {
                            selectedFormatValuesIndoor.push(value);
                        } else {
                            let index = selectedFormatValuesIndoor.indexOf(value);
                            if (index !== -1) {
                                selectedFormatValuesIndoor.splice(index, 1);
                            }
                        }
                        updateURL(); // Обновляем URL
                        sendFormatIndoor(); // Отправляем формат для indoor
                    });
                });

                // Поле ввода для ID outdoor
                let selectedIdOutdoor = '';
                let idOutdoorInput = document.querySelector('.map-block__id input[type="text"]');
                idOutdoorInput.addEventListener('input', function() {
                    setTimeout(() => {
                        selectedIdOutdoor = this.value;
                        updateURL(); // Обновляем URL
                        sendFormatOutdoor(); // Отправляем формат для outdoor
                    }, 300);
                });

                // Обработчики изменения состояния чекбоксов для районов outdoor
                rajonOutdoor.forEach((input) => {
                    input.addEventListener('change', function() {
                        let value = this.value;
                        if (this.checked) {
                            selectedRajonValues.push(value);
                        } else {
                            let index = selectedRajonValues.indexOf(value);
                            if (index !== -1) {
                                selectedRajonValues.splice(index, 1);
                            }
                        }
                        updateURL(); // Обновляем URL
                        sendFormatOutdoor(); // Отправляем формат для outdoor
                    });
                });

                // Обработчики изменения состояния чекбоксов для адресов indoor
                addressIndoor.forEach((input) => {
                    input.addEventListener('change', function() {
                        let value = this.value;
                        if (this.checked) {
                            selectedAddressValues.push(value);
                        } else {
                            let index = selectedAddressValues.indexOf(value);
                            if (index !== -1) {
                                selectedAddressValues.splice(index, 1);
                            }
                        }
                        updateURL(); // Обновляем URL
                        sendFormatIndoor(); // Отправляем формат для indoor
                    });
                });

                // Обработчики изменения состояния чекбоксов для расположения outdoor
                locationOutdoor.forEach((input) => {
                    input.addEventListener('change', function() {
                        let value = this.value;
                        if (this.checked) {
                            selectedRaspValues.push(value);
                        } else {
                            let index = selectedRaspValues.indexOf(value);
                            if (index !== -1) {
                                selectedRaspValues.splice(index, 1);
                            }
                        }
                        updateURL(); // Обновляем URL
                        sendFormatOutdoor(); // Отправляем формат для outdoor
                    });
                });

                // Обработчики изменения состояния чекбоксов для особенностей outdoor
                featuresOutdoor.forEach((input) => {
                    input.addEventListener('change', function() {
                        let value = this.value;
                        if (this.checked) {
                            selectedFeaturesValues.push(value);
                        } else {
                            let index = selectedFeaturesValues.indexOf(value);
                            if (index !== -1) {
                                selectedFeaturesValues.splice(index, 1);
                            }
                        }
                        updateURL(); // Обновляем URL
                        sendFormatOutdoor(); // Отправляем формат для outdoor
                    });
                });

                // Функция для отправки формата и обновления элементов outdoor
                const sendFormatOutdoor = async () => {
                    const ajaxurl = window.location.origin + "/wp-admin/admin-ajax.php";
                    let mapHtml = document.querySelectorAll('.ymaps-2-1-79-map'); // Получаем все карты

                    // Создаем новый экземпляр FormData
                    let formData = new FormData();
                    formData.append("action", "load_map_outdoor");

                    // Преобразуем массивы в строки, разделенные запятыми
                    if (selectedFormatValues.length > 0) {
                        const selectedFormatValuesStr = selectedFormatValues.join(',');
                        formData.append("selectedFormatValues", selectedFormatValuesStr);
                    }

                    if (selectedRajonValues.length > 0) {
                        const selectedRajonValuesStr = selectedRajonValues.join(',');
                        formData.append("selectedRajonValues", selectedRajonValuesStr);
                    }

                    if (selectedRaspValues.length > 0) {
                        const selectedRaspValuesStr = selectedRaspValues.join(',');
                        formData.append("selectedRaspValues", selectedRaspValuesStr);
                    }

                    if (selectedFeaturesValues.length > 0) {
                        const selectedFeaturesValuesStr = selectedFeaturesValues.join(',');
                        formData.append("selectedFeaturesValues", selectedFeaturesValuesStr);
                    }

                    // Добавляем выбранное значение ID в FormData
                    if (selectedIdOutdoor) {
                        formData.append("idOutdoor", selectedIdOutdoor);
                    }

                    // Находим контейнер списка outdoor
                    const containerOutdoorList = document.querySelector(".outdoor-list");

                    try {
                        // Отправляем запрос fetch
                        const response = await fetch(ajaxurl, {
                            method: "POST",
                            body: formData,
                        });

                        if (response.ok) {
                            // Если ответ успешен
                            const dataFetch = await response.json();
                            if (dataFetch.success) {
                                // Обновляем элементы списка
                                elementsList = dataFetch.data.elementsListOutdoor;
                                setTimeout(() => {
                                    if (containerOutdoorList) {
                                        containerOutdoorList.innerHTML = dataFetch.data.outputOutdoor;
                                    }

                                    // Удаляем все карты
                                    mapHtml.forEach((map) => {
                                        map.remove();
                                    });

                                    // // Обновляем счетчик карточек
                                    // updateCardCount();

                                    // document.querySelector('.map-block__more button:nth-child(1)').style.display = 'flex';
                                    // document.querySelector('.map-block__more button:nth-child(2)').style.display = 'none';

                                    // Инициализируем карту с новыми данными
                                    initializeMap();

                                    // // Устанавливаем высоту для контейнера карточек
                                    // document.querySelector('.outdoor-list').style.height = "80%";
                                    // document.querySelector('.indoor-list').style.height = "80%";

                                    // // Обновляем информацию о районе
                                    // let descriptions = [...new Set(elementsList.map(element => (typeObject === "outdoor") ? element.term : element.address))];
                                    // updateDistrictInfo(descriptions);
                                }, 300);
                            }
                        } else {
                            console.error("Network response was not ok");
                        }
                    } catch (error) {
                        console.error("Fetch error:", error);
                    }
                };

                // Функция для отправки формата и обновления элементов indoor
                const sendFormatIndoor = async () => {
                    const ajaxurl = window.location.origin + "/wp-admin/admin-ajax.php";
                    let mapHtml = document.querySelectorAll('.ymaps-2-1-79-map'); // Получаем все карты

                    // Создаем новый экземпляр FormData
                    let formData = new FormData();
                    formData.append("action", "load_map_indoor");

                    // Преобразуем массивы в строки, разделенные запятыми
                    if (selectedFormatValuesIndoor.length > 0) {
                        const selectedFormatValuesIndoorStr = selectedFormatValuesIndoor.join(',');
                        formData.append("selectedFormatValuesIndoor", selectedFormatValuesIndoorStr);
                    }

                    if (selectedAddressValues.length > 0) {
                        const selectedAddressValuesStr = selectedAddressValues.join(',');
                        formData.append("selectedAddressValues", selectedAddressValuesStr);
                    }

                    // Находим контейнер списка indoor
                    const containerIndoorList = document.querySelector(".indoor-list");

                    try {
                        // Отправляем запрос fetch
                        const response = await fetch(ajaxurl, {
                            method: "POST",
                            body: formData,
                        });

                        if (response.ok) {
                            // Если ответ успешен
                            const dataFetch = await response.json();
                            if (dataFetch.success) {
                                // Обновляем элементы списка
                                elementsList = dataFetch.data.elementsListIndoor;

                                setTimeout(() => {
                                    if (containerIndoorList) {
                                        containerIndoorList.innerHTML = dataFetch.data.outputIndoor;
                                    }
                                    // Удаляем все карты
                                    mapHtml.forEach((map) => {
                                        map.remove();
                                    });

                                    // // Обновляем счетчик карточек
                                    // updateCardCount();


                                    // document.querySelector('.map-block__more button:nth-child(1)').style.display = 'none';
                                    // document.querySelector('.map-block__more button:nth-child(2)').style.display = 'flex';

                                    // Инициализируем карту с новыми данными
                                    initializeMap();

                                    // // Устанавливаем высоту для контейнера карточек
                                    // document.querySelector('.outdoor-list').style.height = "80%";
                                    // document.querySelector('.indoor-list').style.height = "80%";

                                    // // Обновляем информацию о районе
                                    // let descriptions = [...new Set(elementsList.map(element => element.address))];
                                    // updateDistrictInfo(descriptions);

                                }, 300);
                            }
                        } else {
                            console.error("Network response was not ok");
                        }
                    } catch (error) {
                        console.error("Fetch error:", error);
                    }
                };

                // Применяем параметры URL при загрузке страницы
                applyURLParams();

                function initializeMap() {
                    // Ждем, пока API Яндекс.Карт станет доступен
                    ymaps.ready(function() {
                        // Инициализация карты с центром и начальным уровнем масштабирования
                        let map = new ymaps.Map("map", {
                            center: [59.938784, 30.314997], // Начальные координаты центра карты
                            zoom: 12, // Начальный уровень масштабирования
                            controls: [], // Убираем все встроенные элементы управления карты
                            type: 'yandex#map'
                        });

                        // Массив для хранения меток
                        let placemarks = [];

                        // Создаем собственный макет с информацией о выбранном геообъекте.
                        let customBalloonContentLayout = ymaps.templateLayoutFactory.createClass([
                                '<ul class=list>',
                                // Выводим в цикле список всех геообъектов.
                                '{% for geoObject in properties.geoObjects %}',
                                    '<li><a href=# data-placemarkid="{{ geoObject.properties.placemarkId }}" class="list_item">{{ geoObject.properties.balloonContentHeader|raw }}</a></li>',
                                '{% endfor %}',
                                '</ul>'
                        ].join(''));

                        // Инициализация кластеризатора с заданными параметрами
                        let clusterer = new ymaps.Clusterer({
                            clusterIconLayout: 'default#pieChart',
                            clusterIconPieChartRadius: 25,
                            clusterIconPieChartCoreRadius: 15,
                            clusterIconColor: '#ff0000',
                            clusterBalloonMaxHeight: 200,
                            clusterBalloonMaxWidth: 500,
                            // Устанавливаем собственный макет контента балуна.
                            clusterBalloonContentLayout: customBalloonContentLayout
                        });

                        // Функция для добавления пользовательских точек на карту
                        function addCustomPoints(customPoints) {
                            // Удаляем все предыдущие метки с карты
                            placemarks.forEach(placemark => map.geoObjects.remove(placemark));
                            placemarks = [];

                            // Добавляем новые метки на карту
                            customPoints.forEach(customPoint => {
                                let placemark = new ymaps.Placemark(customPoint.coords, {
                                    // balloonContentHeader: '<h2 style="font-size: 22px; margin-bottom: 10px; font-family: Montserrat; font-weight: 700;">' + customPoint.popup.header + "</h2>",
                                    // balloonContentBody: '<p class="service-center__address" style="color: #999; font-size: 16px;">' + customPoint.popup.body + "</p>",
                                    // balloonContentFooter: '<p class="service-center__phone" style="color: #999; font-size: 16px;">' + customPoint.popup.description + "</p>",
                                    balloonContentHeader: `
            <div class="map-block__card">
                <img src="${customPoint.popup.image}" alt="img">
                <div class="map-block__info">
                    <h2>${customPoint.popup.header}</h2>
                    <div class="map-block__tag">
                        <span>${customPoint.popup.description}</span>
                    </div>
                    <div class="map-block__num">
                        <span>${customPoint.popup.body}</span>
                    </div>
                    <a class="map-block__more-link" href="${customPoint.popup.permalink}">подробнее 
                        <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M2 3H18M18 3V19M18 3L2 19" stroke="#00468A" stroke-width="2"></path>
                        </svg>
                    </a>
                </div>
            </div>`,
                                    hintContent: customPoint.popup.header,
                                    // image: customPoint.popup.image,
                                    // permalink: customPoint.popup.permalink,
                                    // description: customPoint.popup.description,
                                });

                                // Добавляем метку в массив placemarks
                                placemarks.push(placemark);
                            });

                            // Добавляем метки в кластеризатор и на карту
                            clusterer.add(placemarks);
                            map.geoObjects.add(clusterer);
                        }

                        // Функция для обновления карточек на основе переданных точек
                        //             function updateCards(points) {
                        //                 let cardsContainers = (typeObject === "outdoor") ? document.querySelectorAll('.outdoor-list') : document.querySelectorAll('.indoor-list');
                        //                 // Очищаем контейнеры карточек перед добавлением новых данных
                        //                 cardsContainers.forEach(cardsContainer => {
                        //                     cardsContainer.innerHTML = '';

                        //                     // Генерируем HTML для каждой точки и добавляем его в контейнер карточек
                        //                     points.forEach(point => {
                        //                         let cardHTML = `
                        //     <div class="map-block__card" data-coords="${point.coords}">
                        //         <img src="${point.popup.image}" alt="img">
                        //         <div class="map-block__info">
                        //             <h2>${point.popup.header}</h2>
                        //             <div class="map-block__tag"><span>${point.popup.description}</span></div>
                        //             <div class="map-block__num"><span>${point.popup.body}</span></div>
                        //             <a class="map-block__more-link" href="${point.popup.permalink}"> ПОДРОБНЕЕ
                        //                 <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        //                     <path d="M2 3H18M18 3V19M18 3L2 19" stroke="#00468A" stroke-width="2"></path>
                        //                 </svg>
                        //             </a>
                        //         </div>
                        //     </div>
                        // `;
                        //                         // Добавляем сгенерированный HTML в контейнер карточек
                        //                         cardsContainer.innerHTML += cardHTML;
                        //                     });
                        //                 });

                        //                 // // Устанавливаем высоту для контейнера карточек
                        //                 // document.querySelector('.outdoor-list').style.height = "80%";
                        //                 // document.querySelector('.indoor-list').style.height = "80%";
                        //             }

                        // Обработчик события клика на кластер
                        clusterer.events.add('click', function(e) {
                            let target = e.get('target');

                            // Проверяем, является ли кликнутый объект кластером
                            if (target.getGeoObjects) {
                                // Если это кластер
                                let geoObjects = target.getGeoObjects();
                                let points = geoObjects.map(geoObject => {
                                    let coords = geoObject.geometry.getCoordinates();
                                    let properties = geoObject.properties.getAll();
                                    return {
                                        coords: coords,
                                        popup: {
                                            header: properties.balloonContentHeader,
                                            body: properties.balloonContentBody,
                                            description: properties.description,
                                            image: properties.image,
                                            permalink: properties.permalink
                                        }
                                    };
                                });
                                if (points) {
                                    // Обновляем карточки и информацию о районе
                                    // updateCards(points);
                                    // let descriptions = [...new Set(points.map(point => point.popup.description))];
                                    // updateDistrictInfo(descriptions);
                                }
                            } else {
                                // Если это одиночная метка
                                let coords = target.geometry.getCoordinates();
                                let properties = target.properties.getAll();
                                let point = {
                                    coords: coords,
                                    popup: {
                                        header: properties.balloonContentHeader,
                                        body: properties.balloonContentBody,
                                        description: properties.description,
                                        image: properties.image,
                                        permalink: properties.permalink
                                    }
                                };

                                // if ([point]) {
                                //     // Находим все точки, принадлежащие тому же району (description)
                                //     let districtPoints = elementsList.filter(element => ((element.term === point.popup.description) || element.address === point.popup.description)).map(element => ({
                                //         coords: element.coords.split(',').map(parseFloat),
                                //         popup: {
                                //             image: element.image,
                                //             header: element.title,
                                //             body: (typeObject === "outdoor") ? `GRP: ${element.grp}<br>OTS: ${element.ots}` : `Рабочее время: ${element.timeWork}<br>Тип поверхности: ${element.typeUp}`,
                                //             description: (typeObject === "outdoor") ? element.term : element.address,
                                //             permalink: element.permalink
                                //         }
                                //     }));
                                //     // Обновляем карточки и информацию о районе
                                //     // updateCards(districtPoints);
                                //     // updateDistrictInfo([point.popup.description]);
                                // }
                            }
                            // Обработчик клика по координатам в списке
                            clickCoordinateList();
                            // // Обновление информации о количестве карточек
                            // updateCardCount();
                        });

                        // Массив для хранения точек
                        let customPoints = [];

                        // Заполнение массива customPoints данными из elementsList
                        elementsList.forEach(element => {
                            if (element.coords) {
                                let coords = element.coords.split(',').map(parseFloat); // Преобразуем строку с координатами в массив чисел
                                customPoints.push({
                                    coords: coords,
                                    popup: {
                                        image: element.image ? element.image : element.firstgallery,
                                        header: element.title,
                                        body: (typeObject === "outdoor") ? `GRP: ${element.grp}<br>OTS: ${element.ots}` : `Рабочее время: ${element.timeWork}<br>Тип поверхности: ${element.typeUp}`,
                                        description: (typeObject === "outdoor") ? element.term : element.address,
                                        permalink: element.permalink,
                                    }
                                });
                            }
                        });

                        // Обработчик клика на элемент списка
                        function clickCoordinateList() {
                            document.querySelectorAll('.map-block__card').forEach(item => {
                                item.addEventListener('click', function() {
                                    let coords = this.getAttribute('data-coords').split(',').map(parseFloat);
                                    // Устанавливаем центр карты по координатам
                                    map.setCenter(coords, 13.5);
                                });
                            });
                        }

                        clickCoordinateList();

                        // Добавление точек на карту
                        addCustomPoints(customPoints);
                        // // Обновляем количество карточек при инициализации карты
                        // updateCardCount();

                        // Функция для увеличения масштаба карты
                        function zoomIn() {
                            let currentZoom = map.getZoom();
                            map.setZoom(currentZoom + 1);
                        }

                        // Функция для уменьшения масштаба карты
                        function zoomOut() {
                            let currentZoom = map.getZoom();
                            map.setZoom(currentZoom - 1);
                        }

                        // Привязываем функции увеличения и уменьшения масштаба к кнопкам
                        document.querySelector('.map-block__scale button:nth-child(1)').addEventListener('click', zoomIn);
                        document.querySelector('.map-block__scale button:nth-child(2)').addEventListener('click', zoomOut);

                        // Добавляем встроенную кнопку измерения расстояния
                        var measureControl = new ymaps.control.RulerControl();
                        map.controls.add(measureControl);

                        // // Находим кастомные кнопки по селектору и привязываем обработчики событий
                        // var customButtons = document.querySelectorAll('.map-block__more button');

                        // customButtons.forEach(button => {
                        //     button.addEventListener('click', function() {
                        //         measureFun(button);
                        //     });
                        // });

                        // function measureFun(button) {
                        //     button.classList.add("active");
                        //     // Симулируем клик по встроенной кнопке измерения расстояния
                        //     var ymapsFloatButton = document.querySelector('.ymaps-2-1-79-float-button');
                        //     if (ymapsFloatButton) {
                        //         ymapsFloatButton.click(); // Вызываем клик на встроенной кнопке
                        //     }
                        // }
                    });
                }
            });
        </script>

        <div class="map-page__maps-img map-block__map" id="map" style="width: 100%; height: 100%;"></div>
        <div class="container">
            <div class="map-page__content">

                <div class="map-page__maps map-block__maps">
                    <div class="loader"></div>
                    <div class="map-block__mob">
                        <button><svg width="26" height="27" viewBox="0 0 26 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M23.5395 4.55556H19.9079M15.0658 2V7.11111M15.0658 4.55556H1.75M6.59211 13.5H1.75M11.4342 10.9444V16.0556M24.75 13.5H11.4342M23.5395 22.4444H19.9079M15.0658 19.8889V25M15.0658 22.4444H1.75" stroke="#00468A" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg> Фильтры</button>
                        <!-- <button><svg width="26" height="21" viewBox="0 0 26 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect width="3" height="3" rx="1.5" fill="#00468A" />
                                <path d="M8 1.5H24" stroke="#00468A" stroke-width="3" stroke-linecap="round" />
                                <rect y="9" width="3" height="3" rx="1.5" fill="#00468A" />
                                <path d="M8 10.5H24" stroke="#00468A" stroke-width="3" stroke-linecap="round" />
                                <rect y="18" width="3" height="3" rx="1.5" fill="#00468A" />
                                <path d="M8 19.5H24" stroke="#00468A" stroke-width="3" stroke-linecap="round" />
                            </svg>
                            К списку</button> -->
                    </div>

                    <div class="map-block__functions">

                        <!-- <button class="map-block__block-toggle"></button> -->

                        <div class="map-block__fun">
                            <div class="map-block__scale">
                                <button><svg width="27" height="27" viewBox="0 0 27 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 25.5C12 26.3284 12.6716 27 13.5 27C14.3284 27 15 26.3284 15 25.5V15H25.5C26.3284 15 27 14.3284 27 13.5C27 12.6716 26.3284 12 25.5 12H15V1.5C15 0.671574 14.3284 0 13.5 0C12.6716 0 12 0.671574 12 1.5V12H1.5C0.671573 12 0 12.6716 0 13.5C0 14.3284 0.671573 15 1.5 15H12V25.5Z" fill="#00468A" />
                                    </svg></button>
                                <button><svg width="27" height="3" viewBox="0 0 27 3" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.5 1.5H25.5" stroke="#00468A" stroke-width="3" stroke-linecap="round" />
                                    </svg></button>
                            </div>

                            <!-- <div class="map-block__more">
                                <button><svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M3.23286 19.0744C3.16767 19.1394 3.11595 19.2167 3.08066 19.3017C3.04537 19.3868 3.02721 19.4779 3.02721 19.57C3.02721 19.6621 3.04537 19.7533 3.08066 19.8383C3.11595 19.9233 3.16767 20.0006 3.23286 20.0656L8.18326 25.0146C8.31453 25.1458 8.49254 25.2196 8.67816 25.2196C8.86377 25.2196 9.04179 25.1458 9.17306 25.0146L25.0127 9.17501C25.1439 9.04374 25.2176 8.86573 25.2176 8.68011C25.2176 8.4945 25.1439 8.31648 25.0127 8.18521L20.0623 3.23621C19.931 3.10498 19.753 3.03126 19.5674 3.03126C19.3817 3.03126 19.2037 3.10498 19.0725 3.23621L17.5885 4.72021L19.9811 7.11421C20.0478 7.17888 20.101 7.2562 20.1376 7.34165C20.1742 7.4271 20.1933 7.51898 20.194 7.61192C20.1947 7.70487 20.1768 7.79701 20.1415 7.88299C20.1062 7.96896 20.0541 8.04704 19.9883 8.11267C19.9225 8.1783 19.8443 8.23017 19.7582 8.26524C19.6721 8.30031 19.5799 8.3179 19.487 8.31696C19.394 8.31602 19.3022 8.29659 19.2169 8.25979C19.1315 8.22298 19.0543 8.16955 18.9899 8.10261L16.5987 5.71001L14.6177 7.69101L15.8553 8.92861C15.9828 9.06063 16.0533 9.23745 16.0517 9.42099C16.0501 9.60453 15.9765 9.7801 15.8467 9.90988C15.7169 10.0397 15.5414 10.1133 15.3578 10.1149C15.1743 10.1165 14.9975 10.0459 14.8655 9.91841L13.6279 8.68081L11.6483 10.6604L14.0409 13.053C14.1077 13.1176 14.161 13.1948 14.1977 13.2802C14.2344 13.3656 14.2537 13.4575 14.2545 13.5504C14.2553 13.6434 14.2376 13.7356 14.2024 13.8216C14.1672 13.9076 14.1153 13.9858 14.0495 14.0515C13.9838 14.1172 13.9057 14.1692 13.8196 14.2044C13.7336 14.2396 13.6414 14.2573 13.5485 14.2565C13.4555 14.2557 13.3637 14.2364 13.2783 14.1997C13.1929 14.163 13.1156 14.1097 13.0511 14.0428L10.6585 11.6502L8.67886 13.6298L9.91646 14.8674C9.98332 14.932 10.0366 15.0092 10.0733 15.0946C10.11 15.18 10.1293 15.2719 10.1301 15.3648C10.1309 15.4578 10.1132 15.55 10.078 15.636C10.0428 15.722 9.99086 15.8002 9.92514 15.8659C9.85941 15.9316 9.78125 15.9836 9.69523 16.0188C9.6092 16.054 9.51702 16.0717 9.42408 16.0709C9.33113 16.0701 9.23928 16.0508 9.15387 16.0141C9.06847 15.9774 8.99123 15.9241 8.92666 15.8572L7.68906 14.6196L5.70806 16.6006L8.10206 18.9932C8.16705 19.0583 8.21859 19.1355 8.25372 19.2205C8.28886 19.3055 8.30691 19.3966 8.30685 19.4886C8.30678 19.5806 8.2886 19.6716 8.25334 19.7566C8.21809 19.8415 8.16644 19.9187 8.10136 19.9837C8.03627 20.0487 7.95903 20.1002 7.87403 20.1354C7.78903 20.1705 7.69794 20.1886 7.60596 20.1885C7.51399 20.1884 7.42292 20.1703 7.33797 20.135C7.25302 20.0997 7.17585 20.0481 7.11086 19.983L4.71826 17.589L3.23286 19.0744ZM2.24446 21.0554C2.04931 20.8604 1.89451 20.6288 1.78889 20.374C1.68327 20.1191 1.62891 19.8459 1.62891 19.57C1.62891 19.2941 1.68327 19.0209 1.78889 18.7661C1.89451 18.5112 2.04931 18.2796 2.24446 18.0846L18.0827 2.24641C18.2777 2.05127 18.5092 1.89646 18.7641 1.79084C19.019 1.68522 19.2922 1.63086 19.5681 1.63086C19.8439 1.63086 20.1171 1.68522 20.372 1.79084C20.6269 1.89646 20.8584 2.05127 21.0535 2.24641L26.0025 7.19541C26.3961 7.58922 26.6173 8.12327 26.6173 8.68011C26.6173 9.23696 26.3961 9.771 26.0025 10.1648L10.1629 26.0044C9.76911 26.3977 9.23536 26.6186 8.67886 26.6186C8.12236 26.6186 7.58861 26.3977 7.19486 26.0044L2.24446 21.0554Z" fill="#00468A" />
                                    </svg></button>
                                <button><svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M3.23286 19.0744C3.16767 19.1394 3.11595 19.2167 3.08066 19.3017C3.04537 19.3868 3.02721 19.4779 3.02721 19.57C3.02721 19.6621 3.04537 19.7533 3.08066 19.8383C3.11595 19.9233 3.16767 20.0006 3.23286 20.0656L8.18326 25.0146C8.31453 25.1458 8.49254 25.2196 8.67816 25.2196C8.86377 25.2196 9.04179 25.1458 9.17306 25.0146L25.0127 9.17501C25.1439 9.04374 25.2176 8.86573 25.2176 8.68011C25.2176 8.4945 25.1439 8.31648 25.0127 8.18521L20.0623 3.23621C19.931 3.10498 19.753 3.03126 19.5674 3.03126C19.3817 3.03126 19.2037 3.10498 19.0725 3.23621L17.5885 4.72021L19.9811 7.11421C20.0478 7.17888 20.101 7.2562 20.1376 7.34165C20.1742 7.4271 20.1933 7.51898 20.194 7.61192C20.1947 7.70487 20.1768 7.79701 20.1415 7.88299C20.1062 7.96896 20.0541 8.04704 19.9883 8.11267C19.9225 8.1783 19.8443 8.23017 19.7582 8.26524C19.6721 8.30031 19.5799 8.3179 19.487 8.31696C19.394 8.31602 19.3022 8.29659 19.2169 8.25979C19.1315 8.22298 19.0543 8.16955 18.9899 8.10261L16.5987 5.71001L14.6177 7.69101L15.8553 8.92861C15.9828 9.06063 16.0533 9.23745 16.0517 9.42099C16.0501 9.60453 15.9765 9.7801 15.8467 9.90988C15.7169 10.0397 15.5414 10.1133 15.3578 10.1149C15.1743 10.1165 14.9975 10.0459 14.8655 9.91841L13.6279 8.68081L11.6483 10.6604L14.0409 13.053C14.1077 13.1176 14.161 13.1948 14.1977 13.2802C14.2344 13.3656 14.2537 13.4575 14.2545 13.5504C14.2553 13.6434 14.2376 13.7356 14.2024 13.8216C14.1672 13.9076 14.1153 13.9858 14.0495 14.0515C13.9838 14.1172 13.9057 14.1692 13.8196 14.2044C13.7336 14.2396 13.6414 14.2573 13.5485 14.2565C13.4555 14.2557 13.3637 14.2364 13.2783 14.1997C13.1929 14.163 13.1156 14.1097 13.0511 14.0428L10.6585 11.6502L8.67886 13.6298L9.91646 14.8674C9.98332 14.932 10.0366 15.0092 10.0733 15.0946C10.11 15.18 10.1293 15.2719 10.1301 15.3648C10.1309 15.4578 10.1132 15.55 10.078 15.636C10.0428 15.722 9.99086 15.8002 9.92514 15.8659C9.85941 15.9316 9.78125 15.9836 9.69523 16.0188C9.6092 16.054 9.51702 16.0717 9.42408 16.0709C9.33113 16.0701 9.23928 16.0508 9.15387 16.0141C9.06847 15.9774 8.99123 15.9241 8.92666 15.8572L7.68906 14.6196L5.70806 16.6006L8.10206 18.9932C8.16705 19.0583 8.21859 19.1355 8.25372 19.2205C8.28886 19.3055 8.30691 19.3966 8.30685 19.4886C8.30678 19.5806 8.2886 19.6716 8.25334 19.7566C8.21809 19.8415 8.16644 19.9187 8.10136 19.9837C8.03627 20.0487 7.95903 20.1002 7.87403 20.1354C7.78903 20.1705 7.69794 20.1886 7.60596 20.1885C7.51399 20.1884 7.42292 20.1703 7.33797 20.135C7.25302 20.0997 7.17585 20.0481 7.11086 19.983L4.71826 17.589L3.23286 19.0744ZM2.24446 21.0554C2.04931 20.8604 1.89451 20.6288 1.78889 20.374C1.68327 20.1191 1.62891 19.8459 1.62891 19.57C1.62891 19.2941 1.68327 19.0209 1.78889 18.7661C1.89451 18.5112 2.04931 18.2796 2.24446 18.0846L18.0827 2.24641C18.2777 2.05127 18.5092 1.89646 18.7641 1.79084C19.019 1.68522 19.2922 1.63086 19.5681 1.63086C19.8439 1.63086 20.1171 1.68522 20.372 1.79084C20.6269 1.89646 20.8584 2.05127 21.0535 2.24641L26.0025 7.19541C26.3961 7.58922 26.6173 8.12327 26.6173 8.68011C26.6173 9.23696 26.3961 9.771 26.0025 10.1648L10.1629 26.0044C9.76911 26.3977 9.23536 26.6186 8.67886 26.6186C8.12236 26.6186 7.58861 26.3977 7.19486 26.0044L2.24446 21.0554Z" fill="#00468A" />
                                    </svg></button>
                            </div> -->
                        </div>

                    </div>

                </div>

                <div class="map-page__filters-s">

                    <div class="map-page__filter map-block__filter-main">
                        <div class="map-block__filter">

                            <div class="map-block__top">
                                <h3>фильтр</h3>
                                <button><svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.954636 17.9512C0.367987 18.5378 0.367986 19.489 0.954636 20.0756C1.54129 20.6623 2.49243 20.6623 3.07908 20.0756L10.5146 12.6401L17.9502 20.0756C18.5369 20.6623 19.488 20.6623 20.0747 20.0756C20.6613 19.489 20.6613 18.5378 20.0747 17.9512L12.6391 10.5156L20.0747 3.08006C20.6613 2.49341 20.6613 1.54226 20.0747 0.955612C19.488 0.368962 18.5369 0.368963 17.9502 0.955612L10.5146 8.39118L3.07908 0.955612C2.49243 0.368963 1.54129 0.368962 0.954636 0.955612C0.367986 1.54226 0.367986 2.49341 0.954636 3.08006L8.3902 10.5156L0.954636 17.9512Z" fill="#878787" />
                                    </svg></button>
                            </div>

                            <div class="map-block__main" data-simplebar>

                                <div class="map-block__direction">
                                    <h4>Направление:</h4>
                                    <div class="map-block__points">
                                        <label class="map-block__point">
                                            <input type="radio" name="direction" id="dir1" value="outdoor" checked>
                                            <span></span>
                                            Outdoor
                                        </label>
                                        <label class="map-block__point">
                                            <input type="radio" name="direction" value="indoor" id="dir2">
                                            <span></span>
                                            Indoor
                                        </label>
                                    </div>
                                </div>

                                <div class="map-block__choices format">
                                    <h4>Формат</h4>

                                    <div class="map-block__choice">
                                        <button class="map-block__choice-button">Выберите формат конструкции</button>
                                        <div class="map-block__choice-content">
                                            <?php
                                            $map_format_types = get_terms(array(
                                                'taxonomy' => 'map_format_type',
                                                'hide_empty' => false,
                                            ));

                                            if (!empty($map_format_types) && !is_wp_error($map_format_types)) : ?>
                                                <?php foreach ($map_format_types as $map_format_type) : ?>
                                                    <label class="map-block__point">
                                                        <input type="checkbox" value="<?php echo esc_html($map_format_type->name); ?>">
                                                        <span></span>
                                                        <?php echo esc_html($map_format_type->name); ?>
                                                    </label>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="map-block__id">
                                    <h4>id</h4>

                                    <input type="text" placeholder="Введите ID">
                                </div>

                                <div class="map-block__choices rajon">
                                    <h4>Район</h4>

                                    <div class="map-block__choice">
                                        <button class="map-block__choice-button">Выберите район конструкции</button>
                                        <div class="map-block__choice-content">
                                            <?php
                                            $map_district_types = get_terms(array(
                                                'taxonomy' => 'map_outdoor_district',
                                                'hide_empty' => false,
                                            ));

                                            if (!empty($map_district_types) && !is_wp_error($map_district_types)) : ?>
                                                <?php foreach ($map_district_types as $map_dis_type) : ?>
                                                    <label class="map-block__point">
                                                        <input type="checkbox" value="<?php echo esc_html($map_dis_type->name); ?>">
                                                        <span></span>
                                                        <?php echo esc_html($map_dis_type->name); ?>
                                                    </label>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="map-block__choices raspolozhenie" style="display: none;">
                                    <h4>Расположение</h4>

                                    <div class="map-block__choice">
                                        <button class="map-block__choice-button">Выберите расположение</button>
                                        <div class="map-block__choice-content">
                                            <?php
                                            $outdoorLocation = get_terms(array(
                                                'taxonomy' => 'outdoor_location',
                                                'hide_empty' => false,
                                            ));

                                            if (!empty($outdoorLocation) && !is_wp_error($outdoorLocation)) : ?>
                                                <?php foreach ($outdoorLocation as $location) : ?>
                                                    <label class="map-block__point">
                                                        <input type="checkbox" value="<?php echo esc_html($location->name); ?>">
                                                        <span></span>
                                                        <?php echo esc_html($location->name); ?>
                                                    </label>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="map-block__choices features">
                                    <h4>Особенности</h4>

                                    <div class="map-block__choice">
                                        <button class="map-block__choice-button">Выберите особенности</button>
                                        <div class="map-block__choice-content">
                                            <?php
                                            $outdoorFeatures = get_terms(array(
                                                'taxonomy' => 'outdoor_features',
                                                'hide_empty' => false,
                                            ));

                                            if (!empty($outdoorFeatures) && !is_wp_error($outdoorFeatures)) : ?>
                                                <?php foreach ($outdoorFeatures as $features) : ?>
                                                    <label class="map-block__point">
                                                        <input type="checkbox" value="<?php echo esc_html($features->name); ?>">
                                                        <span></span>
                                                        <?php echo esc_html($features->name); ?>
                                                    </label>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="map-block__choices format-indoor" style="display: none;">
                                    <h4>Формат</h4>

                                    <div class="map-block__choice">
                                        <button class="map-block__choice-button">Выберите формат конструкции</button>
                                        <div class="map-block__choice-content">
                                            <?php
                                            $map_format_types_indoor = get_terms(array(
                                                'taxonomy' => 'map_format_type_indoor',
                                                'hide_empty' => false,
                                            ));

                                            if (!empty($map_format_types_indoor) && !is_wp_error($map_format_types_indoor)) : ?>
                                                <?php foreach ($map_format_types_indoor as $map_format_type) : ?>
                                                    <label class="map-block__point">
                                                        <input type="checkbox" value="<?php echo esc_html($map_format_type->name); ?>">
                                                        <span></span>
                                                        <?php echo esc_html($map_format_type->name); ?>
                                                    </label>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="map-block__choices address" style="display: none;">
                                    <h4>Адрес</h4>

                                    <div class="map-block__choice">
                                        <button class="map-block__choice-button">Выберите адрес конструкции</button>
                                        <div class="map-block__choice-content">
                                            <?php
                                            // $address_indoor = get_terms(array(
                                            //     'taxonomy' => 'map_street',
                                            //     'hide_empty' => false,
                                            // ));
                                            $address_indoor = get_terms_by_post_type( array('map_street'), array('indoor'));

                                            if (!empty($address_indoor) && !is_wp_error($address_indoor)) : ?>
                                                <?php foreach ($address_indoor as $address) : ?>
                                                    <label class="map-block__point">
                                                        <input type="checkbox" value="<?php echo esc_html($address->name); ?>">
                                                        <span></span>
                                                        <?php echo esc_html($address->name); ?>
                                                    </label>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="map-block__bottom"></div>
                        </div>
                    </div>

                    <!-- <div class="map-page__list map-block__list">
                        <div class="map-block__list-top">
                            <div class="map-block__top">
                                <h3>Выберите точку на карте</h3>
                                <button><svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M0.954636 17.9512C0.367987 18.5378 0.367986 19.489 0.954636 20.0756C1.54129 20.6623 2.49243 20.6623 3.07908 20.0756L10.5146 12.6401L17.9502 20.0756C18.5369 20.6623 19.488 20.6623 20.0747 20.0756C20.6613 19.489 20.6613 18.5378 20.0747 17.9512L12.6391 10.5156L20.0747 3.08006C20.6613 2.49341 20.6613 1.54226 20.0747 0.955612C19.488 0.368962 18.5369 0.368963 17.9502 0.955612L10.5146 8.39118L3.07908 0.955612C2.49243 0.368963 1.54129 0.368962 0.954636 0.955612C0.367986 1.54226 0.367986 2.49341 0.954636 3.08006L8.3902 10.5156L0.954636 17.9512Z" fill="#878787" />
                                    </svg></button>
                            </div>
                            <p>
                            </p>
                        </div>

                        <div class="map-block__cards outdoor-list" data-simplebar></div>
                        <div class="map-block__cards indoor-list" style="display: none;" data-simplebar></div>
                    </div> -->

                </div>

            </div>
        </div>
    </section>

</main>
<?php get_footer(); ?>

<?php if (is_page(31)) : ?>
    <style>
        footer {
            display: none;
        }

        .container {
            max-width: 100%;
        }

        .container .header__bottom-nav {
            margin-left: 0;
        }

        .header__bottom {
            display: flex;
            justify-content: space-between;
        }

        .header__bottom div:nth-child(1) {
            max-width: 150px;
            width: 100%;
        }

        .header__bottom .header__bottom-nav {
            max-width: 559.09px;
            width: 100%;
        }

        .header__bottom div:nth-child(3) {
            max-width: 18px;
            width: 100%;
        }

        .header__bottom div:nth-child(4) {
            max-width: 160.3px;
            width: 100%;
        }

        .map-page__filter,
        .map-page__list {
            height: 100%;
            padding: 30px 0 30px 0;
        }

        @media (max-width: 850px) {

            .map-page__filter,
            .map-page__list {
                padding: 58px 0 30px 0;
            }
        }

        .map-block__filter {
            position: relative;
            height: 89%;
            overflow: hidden;
        }

        .map-block__bottom {
            height: 30px;
            background-color: #f7f7f7;
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
        }
    </style>
<?php endif; ?>