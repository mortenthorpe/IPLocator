<?php


namespace App\Model\Factory;


use App\Model\IpApiProvider;

class IpApiProviderFactory
{
    public static function create(array $IpApiParameters) {
        $ipApiInstance = new IpApiProvider($IpApiParameters);
        $ipApiInstance->configure($IpApiParameters);

        return $ipApiInstance;
    }
}