<script type="text/x-template" id="vue-app-template">
    <div class="row">
        <div class="col-sm-4">
            <div class="block-wrapper">
                <form>
                    <div class="form-group">
                        <label for="OriginLocation">Город вылета</label>
                        <input v-model="form.OriginLocation"  type="text" class="form-control" id="OriginLocation" placeholder="Город вылета">
                    </div>
                    <div class="form-group">
                        <label for="DestinationLocation">Город прилета</label>
                        <input v-model="form.DestinationLocation"  type="text" class="form-control" id="DestinationLocation" placeholder="Город прилета">
                    </div>
                    <div class="form-group">
                        <label for="PassengerQuantity">Количество пассажиров</label>
                        <input v-model="form.PassengerQuantity"  type="number" class="form-control" id="PassengerQuantity" placeholder="Количество пассажиров" value="1" min="0">
                    </div>
                    <div class="form-group">
                        <label for="DepartureDate">Дата вылета</label>
                        <input v-model="form.DepartureDate" type="text" class="form-control" id="DepartureDate" placeholder="Дата вылета">
                    </div>
                    <div class="text-right">
                        <button v-on:click="search" type="button" class="btn btn-success">Найти рейсы</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-sm-8">
            <div v-if="box.flash.active" class="alert alert-info" role="alert">{{ box.flash.message }}</div>
            <div v-if="box.flash.progressBar" class="progress">
                <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                </div>
            </div>
            <div v-if="box.results.length">
                <div class="flight-box block-wrapper" v-for="flight in box.results">
                    <p><strong>Время вылета:</strong> {{ flight.Segments.Legs.DepartureTime }} - {{ flight.Segments.Legs.DepartureDate }}</p>
                    <p><strong>Время прибытия:</strong> {{ flight.Segments.Legs.ArrivalTime }} - {{ flight.Segments.Legs.ArrivalDate }}</p>
                    <p><strong>Вылет из:</strong> {{ flight.Segments.Legs.DepartureAirportCode }}</p>
                    <p><strong>Прибытие в:</strong> {{ flight.Segments.Legs.ArrivalAirportCode }}</p>
                    <p><strong>Номер рейса:</strong> {{ flight.Segments.Legs.FlightNumber }}</p>
                    <p><strong>Время в пути:</strong> {{ flight.Segments.Legs.FlightTime }}</p>
                    <hr>
                    <p><strong>Стоимость: {{ flight.Fares.Total }} {{ flight.Fares.Currency }}</strong></p>
                </div>
            </div>
        </div>
    </div>
</script>