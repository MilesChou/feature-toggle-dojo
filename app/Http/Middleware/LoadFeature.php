<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Contracts\Encryption\Encrypter;
use MilesChou\Toggle\Serializers\JsonSerializer;
use MilesChou\Toggle\Toggle;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LoadFeature
{
    /**
     * Cookie key
     *
     * @var string
     */
    protected $key = '_f';

    /**
     * @var int
     */
    protected $minutes = 43200;

    /**
     * @var bool
     */
    protected $encrypt = true;

    /**
     * @var Toggle
     */
    private $toggle;

    /**
     * @var Encrypter
     */
    private $encrypter;

    /**
     * @param Toggle $toggle
     * @param Encrypter $encrypter
     */
    public function __construct(Toggle $toggle, Encrypter $encrypter)
    {
        $this->toggle = $toggle;
        $this->encrypter = $encrypter;
    }

    /**
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle($request, Closure $next)
    {
        $jsonSerializer = new JsonSerializer();

        if ($request->cookies->has($this->key)) {
            $value = $request->cookies->get($this->key);

            if ($this->encrypt) {
                $value = $this->decryptCookieValue($value);
            }

            $this->toggle->result($jsonSerializer->deserialize($value));
        }

        /** @var Response $response */
        $response = $next($request);

        $result = $this->toggle->result();
        $serialized = $jsonSerializer->serialize($result);

        $value = $this->encrypt
            ? $this->encrypter->encrypt($serialized)
            : $serialized;

        $time = time() + $this->minutes * 60;

        $secure = in_array(config('app.env'), ['prod', 'staging'], true);

        $response->headers->setCookie(
            cookie($this->key, $value, $time, null, null, $secure)
        );

        return $response;
    }

    /**
     * 當解不出來就回傳 [] ，重新產 feature
     *
     * @param null|string $value
     * @return null|string
     */
    private function decryptCookieValue($value)
    {
        try {
            return $this->encrypter->decrypt($value);
        } catch (DecryptException $exception) {
            return '[]';
        }
    }
}
