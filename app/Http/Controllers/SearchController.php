<?php
namespace App\Http\Controllers;

use App\Soap\Request\GetAirFareRQ;
use App\Soap\Type\OriginDestinationInformationType;
use App\Soap\Type\PassengerQuantityType;
use App\Soap\Type\SecurityType;
use App\Soap\Type\TravelerInfoSummaryType;
use App\Soap\Type\TravelPreferencesType;
use App\Soap\WSSoapWrapper;
use Carbon\Carbon;
use App\Soap\Request\DoAirFareRQ;

use App\Soap\WSSoapClient;

class SearchController extends Controller
{

    /**
     * @var WSSoapWrapper
     */
    protected $soapWrapper;

    /**
     * SoapController constructor.
     *
     * @param WSSoapWrapper $soapWrapper
     */
    public function __construct(WSSoapWrapper $soapWrapper)
    {
        $this->soapWrapper = $soapWrapper;
    }

    public function index() {
        return view('search.index');
    }

    public function search() {
        $this->soapWrapper->add('Flights', function ($service) {
            $service
                ->wsdl(env('WSDL_URL'))
                ->trace(true)
                ->cache(WSDL_CACHE_NONE)
                ->options(['exceptions' => 0, 'soap_version'=> SOAP_1_2,]);
        });

        $date = Carbon::today()->toDateTimeString();
        $PassengerQuantityType = new PassengerQuantityType('ADT', 1);

        $airFareRequest = new DoAirFareRQ(
            new SecurityType(env('WS_LOGIN'), env('WS_PASS'), env('WS_HASH')),
            new OriginDestinationInformationType($date, 'MOW', 'LED'),
            new TravelerInfoSummaryType($PassengerQuantityType),
            new TravelPreferencesType(null, null, null, null)
        );

        $response = $this->soapWrapper->call('Flights.ETM_DoAirFareRequest', [
            $airFareRequest,
        ]);

        return response()->json($response);
    }

    public function result() {
        $RequestId = request('RequestId');

        $this->soapWrapper->add('Flights', function ($service) {
            $service
                ->wsdl(env('WSDL_URL'))
                ->trace(true)
                ->cache(WSDL_CACHE_NONE)
                ->options(['exceptions' => 0, 'soap_version'=> SOAP_1_2,]);
        });

        $GetAirFareRQ = new GetAirFareRQ(
            new SecurityType(env('WS_LOGIN'), env('WS_PASS'), env('WS_HASH')),
            $RequestId
        );

        $response = $this->soapWrapper->call('Flights.ETM_GetAirFareResult', [
            $GetAirFareRQ,
        ]);

        return response()->json($response);
    }

    public function ping() {
        $sc = new WSSoapClient(env('WSDL_URL'), [
            'cache_wsdl' => WSDL_CACHE_NONE,
            'soap_version' => SOAP_1_2,
            'trace' => 1,
        ]);

        try {
            $out = $sc->ETM_PING('test request');
            echo $out;
        } catch (\SoapFault $fault) {
            echo 'soapfault';
            var_dump($fault);
            exit;
        }
    }
}
