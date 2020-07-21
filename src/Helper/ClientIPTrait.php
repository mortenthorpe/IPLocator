<?php


namespace App\Helper;


trait ClientIPTrait
{
    private function ipIsValid(string $ipCandidateValue, string $ipVersion = '4')
    {
        $ipV4Pattern = '/(\d+(\.|$)){4}/';

        return preg_match($ipV4Pattern, $ipCandidateValue) === 1;
    }

    private function getClientIPValueOrFallback(string $ipCandidateValue, string $fallbackIPValue)
    {
        return ($this->ipIsValid($ipCandidateValue)) ? $ipCandidateValue : $fallbackIPValue;
    }
}