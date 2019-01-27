<?php
/**
 * Created by PhpStorm.
 * User: jkoplowicz
 * Date: 2019-01-25
 * Time: 13:40
 */

namespace MC;
use MC\MasterOfCeremonies;

trait MC
{
    protected $mc;

    public function mc() {
        if (!$this->mc()) {
            $this->mc = new MasterOfCeremonies();
        }

        return $this->mc;
    }
}