<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: pix.proto

namespace Pix;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>pix.PixKeyShowResponse</code>
 */
class PixKeyShowResponse extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>optional string pix_key = 1;</code>
     */
    protected $pix_key = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $pix_key
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Pix::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>optional string pix_key = 1;</code>
     * @return string
     */
    public function getPixKey()
    {
        return isset($this->pix_key) ? $this->pix_key : '';
    }

    public function hasPixKey()
    {
        return isset($this->pix_key);
    }

    public function clearPixKey()
    {
        unset($this->pix_key);
    }

    /**
     * Generated from protobuf field <code>optional string pix_key = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setPixKey($var)
    {
        GPBUtil::checkString($var, True);
        $this->pix_key = $var;

        return $this;
    }

}

