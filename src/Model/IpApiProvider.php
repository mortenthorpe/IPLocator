<?php


namespace App\Model;


use App\Contract\IpProviderModelInterface;
use App\Model\Base\AbstractIpProviderModel;

class IpApiProvider extends AbstractIpProviderModel implements IpProviderModelInterface
{
    public function configure(array $apiParameters)
    {

        parent::configure($apiParameters);
    }

    /**
     * @param array|null $tokens
     */
    public function setTokens(?array $tokens): void
    {
        $this->tokens = $tokens;
    }


}