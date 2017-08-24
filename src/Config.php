<?php
// +----------------------------------------------------------------------
// | Author: 杨尧 <yangyao@sailvan.com>
// +----------------------------------------------------------------------

namespace Yangyao\Ftp;


class Config
{
    private $data;

    public function __construct($config) {
        $this->data = $config;
    }

    public function __get($key){
        if (!array_key_exists($key, $this->data)) {
            throw new \Exception(__METHOD__. "No such field:{$key}");
        }
        return $this->data[$key];
    }

    public function toArray() {
        return $this->data;
    }

}