<?php
namespace App\Soap;

use Artisaninweb\SoapWrapper\Exceptions\ServiceNotFound;
use Artisaninweb\SoapWrapper\SoapWrapper;
use Closure;

class WSSoapWrapper extends SoapWrapper
{
    /**
     * Get the client
     *
     * @param string  $name
     * @param Closure $closure
     *
     * @return mixed
     * @throws ServiceNotFound
     */
    public function client($name, Closure $closure = null)
    {
        if ($this->has($name)) {
            /** @var Service $service */
            $service = $this->services[$name];

            if (is_null($service->getClient())) {
                $client = new WSSoapClient($service->getWsdl(), $service->getOptions(), $service->getHeaders());

                $service->client($client);
            } else {
                $client = $service->getClient();
            }

            return $closure($client);
        }

        throw new ServiceNotFound("Service '" . $name . "' not found.");
    }
}