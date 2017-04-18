
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
                message: '',
                errors: null
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

            // clean up errors
            box.flash.errors = null;

            // send request
            $.ajax("/search", {
                data: this.form,
                method: 'POST',
                beforeSend: function () {
                    box.flash.active = true;
                    box.flash.progressBar = true;
                    box.flash.message = 'Осуществляется поиск...'
                },
                success: function (response) {
                    box.flash.message = 'Поиск выполнен, ожидание результатов...';
                    box.requestId = response.RequestId;

                    getResult(box, getResult);
                },
                error: ajaxRequestError
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
                    if (response.hasOwnProperty('Errors')) {
                        if (response.Errors.hasOwnProperty('Code')
                            && response.Errors.Code == 202
                            && response.Errors.hasOwnProperty('Message')) {

                            box.flash.message = response.Errors.Message;
                            box.flash.progressBar = false;
                            return;
                        }

                        getResult(box, getResult);
                    }

                    if (response.hasOwnProperty('FareDisplayInfos')) {
                        box.results = response.FareDisplayInfos;
                        box.flash.active = false;
                        box.flash.progressBar = false;
                        box.flash.message = '';
                    }
                },
                error: ajaxRequestError
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

var ajaxRequestError = function(xhr, status, error) {
    app.box.flash.message = 'Произошла ошибка! Выполните поиск ещё раз.';
    app.box.flash.progressBar = false;

    if (xhr.status == 422 && xhr.hasOwnProperty('responseJSON')) {
        app.box.flash.errors = xhr.responseJSON;
    }
};