<?php

namespace Anax\Controller;

class CheckIp
{


    /**
     * Validate ip
     *
     * @param: string $ip ip to validate.
     *
     * @return bool as valid or not.
     */
    public function validIp($ip)
    {
        if (filter_var($ip, FILTER_VALIDATE_IP)) {
            return true;
        }
        return false;
    }

    /**
     * Validate host
     *
     * @param: string $ip ip to validate.
     *
     * @return bool or string the url.
     */
    public function validHost($ip)
    {
        if ($this->validIp($ip)) {
            if ($ip != gethostbyaddr($ip)) {
                return gethostbyaddr($ip);
            } else {
                return false;
            }
        }
        return false;
    }
}
