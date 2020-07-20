<?php


namespace App\Model\Base;


use App\Contract\IpProviderModelInterface;

abstract class AbstractIpProviderModel implements IpProviderModelInterface
{
    protected ?string $apiUrl;
    protected ?array $tokens;

    public function configure(array $apiParameters)
    {
        $this->apiUrl = $apiParameters['url'];
        $this->tokens = $apiParameters['tokens'];
    }

    /**
     * @return string|null
     */
    public function getApiUrl(): ?string
    {
        return ($this->apiUrl) ?? 'EMPTY!';
    }

    /**
     * @return array|null
     */
    public function getTokens(): ?array
    {
        return $this->tokens;
    }

}