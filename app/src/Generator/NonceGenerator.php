<?php namespace App\Generator;

class NonceGenerator
{

    /**
     * @var string
     */
    private $nonce;

    /**
     * @param int $byteLength
     *
     * @return string
     */
    public function generateNonce(int $byteLength = 64) : string
    {
        if ($byteLength <= 0) {
            throw new \InvalidArgumentException(sprintf('Supplied $byteLength should be > 0'));
        }

        if ( ! $this->nonce) {
            $this->nonce = bin2hex(random_bytes($byteLength));
        }

        return $this->nonce;
    }
}
