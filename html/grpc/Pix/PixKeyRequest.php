<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: pix.proto

namespace Pix;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>pix.PixKeyRequest</code>
 */
class PixKeyRequest extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>.pix.PixKey pix_key = 1;</code>
     */
    protected $pix_key = null;
    /**
     * Generated from protobuf field <code>string userId = 2;</code>
     */
    protected $userId = '';
    /**
     * Generated from protobuf field <code>optional string id = 3;</code>
     */
    protected $id = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Pix\PixKey $pix_key
     *     @type string $userId
     *     @type string $id
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Pix::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>.pix.PixKey pix_key = 1;</code>
     * @return \Pix\PixKey|null
     */
    public function getPixKey()
    {
        return $this->pix_key;
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
     * Generated from protobuf field <code>.pix.PixKey pix_key = 1;</code>
     * @param \Pix\PixKey $var
     * @return $this
     */
    public function setPixKey($var)
    {
        GPBUtil::checkMessage($var, \Pix\PixKey::class);
        $this->pix_key = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string userId = 2;</code>
     * @return string
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Generated from protobuf field <code>string userId = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setUserId($var)
    {
        GPBUtil::checkString($var, True);
        $this->userId = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>optional string id = 3;</code>
     * @return string
     */
    public function getId()
    {
        return isset($this->id) ? $this->id : '';
    }

    public function hasId()
    {
        return isset($this->id);
    }

    public function clearId()
    {
        unset($this->id);
    }

    /**
     * Generated from protobuf field <code>optional string id = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setId($var)
    {
        GPBUtil::checkString($var, True);
        $this->id = $var;

        return $this;
    }

}

