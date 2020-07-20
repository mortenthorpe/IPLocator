<?php


namespace App\Contract;


interface IpProviderModelInterface
{
    public function configure(array $apiParameters);

    /**
     * @return string|null
     */
    public function getApiUrl(): ?string;

    /**
     * @return array|null
     */
    public function getTokens(): ?array;
}