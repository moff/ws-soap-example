
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
(function() {

    function pad(number) {
        if (number < 10) {
            return '0' + number;
        }
        return number;
    }

    Date.prototype.toISOStringDayStart = function() {
        return this.getFullYear() +
            '-' + pad(this.getMonth() + 1) +
            '-' + pad(this.getDate()) +
            ' ' + '00:00:00';
    };

}());


var Datepicker = require('vuejs-datepicker');

var app = new Vue({
    el: '#app',
    template: '#vue-app-template',
    components: { Datepicker },
    data: {
        box: {
            requestId: null,
            results: [],
            flash: {
                active: false,
                progressBar: false,
                message: ''
            },
            form: {
                date: {
                    value: new Date(),
                    disabled: {
                        to: new Date()
                    }
                }
            }
        },
        form: {
            OriginLocation: 'MOW',
            DestinationLocation: 'LED',
            PassengerQuantity: 1,
            DepartureDate: new Date().toISOStringDayStart(),
            _token: Laravel.csrfToken
        }
    },
    methods: {
        search: function() {
            var box = this.box;
            var getResult = this.getResult;

            // send request
            $.ajax("/search", {
                data: this.form,
                method: 'GET',
                beforeSend: function () {
                    console.log('beforeSend');
                    box.flash.active = true;
                    box.flash.progressBar = true;
                    box.flash.message = 'Осуществляется поиск...'
                },
                success: function (response) {
                    console.log('Search response: ');
                    console.log(response);
                    box.flash.message = 'Поиск выполнен, ожидание результатов...';
                    box.requestId = response.RequestId;

                    getResult(box, getResult);
                },
                error: function (xhr, status, error) {
                    box.flash.message = 'Произошла ошибка! Выполните поиск ещё раз.';
                    box.flash.progressBar = false;
                }
            });
        },
        getResult: function(box, getResult) {
            $.ajax("/result", {
                data: {
                    RequestId: box.requestId,
                    _token: Laravel.csrfToken
                },
                method: "POST",
                success: function(response) {
                    console.log('Results request: ');
                    console.log(response);

                    if (response.hasOwnProperty('Errors')) {
                        console.log('Search in process');
                        getResult(box, getResult);
                    }

                    if (response.hasOwnProperty('FareDisplayInfos')) {
                        console.log('FareDisplayInfos found');

                        box.results = response.FareDisplayInfos;

                        console.log(box.results);

                        box.flash.active = false;
                        box.flash.progressBar = false;
                        box.flash.message = '';
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr, status, error);
                    console.log('ERROR in results request!');
                    box.flash.message = 'Произошла ошибка!';
                    box.flash.progressBar = false;
                }
            });
        },
        dateSelected: function() {
            // setTimeout due to laggy date change
            setTimeout(this.changeDate, 100);
        },
        changeDate: function() {
            this.form.DepartureDate = this.box.form.date.value.toISOStringDayStart();
        }
    }
});