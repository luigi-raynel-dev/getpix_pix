<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: pix.proto

namespace Pix;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Generated from protobuf message <code>pix.PixKey</code>
 */
class PixKey extends \Google\Protobuf\Internal\Message
{
    /**
     * Generated from protobuf field <code>string name = 1;</code>
     */
    protected $name = '';
    /**
     * Generated from protobuf field <code>string type = 2;</code>
     */
    protected $type = '';
    /**
     * Generated from protobuf field <code>string key = 3;</code>
     */
    protected $key = '';
    /**
     * Generated from protobuf field <code>string bankISPB = 4;</code>
     */
    protected $bankISPB = '';
    /**
     * Generated from protobuf field <code>optional string belongsTo = 5;</code>
     */
    protected $belongsTo = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $name
     *     @type string $type
     *     @type string $key
     *     @type string $bankISPB
     *     @type string $belongsTo
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Pix::initOnce();
        parent::__construct($data);
    }

    /**
     * Generated from protobuf field <code>string name = 1;</code>
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Generated from protobuf field <code>string name = 1;</code>
     * @param string $var
     * @return $this
     */
    public function setName($var)
    {
        GPBUtil::checkString($var, True);
        $this->name = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string type = 2;</code>
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Generated from protobuf field <code>string type = 2;</code>
     * @param string $var
     * @return $this
     */
    public function setType($var)
    {
        GPBUtil::checkString($var, True);
        $this->type = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string key = 3;</code>
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Generated from protobuf field <code>string key = 3;</code>
     * @param string $var
     * @return $this
     */
    public function setKey($var)
    {
        GPBUtil::checkString($var, True);
        $this->key = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>string bankISPB = 4;</code>
     * @return string
     */
    public function getBankISPB()
    {
        return $this->bankISPB;
    }

    /**
     * Generated from protobuf field <code>string bankISPB = 4;</code>
     * @param string $var
     * @return $this
     */
    public function setBankISPB($var)
    {
        GPBUtil::checkString($var, True);
        $this->bankISPB = $var;

        return $this;
    }

    /**
     * Generated from protobuf field <code>optional string belongsTo = 5;</code>
     * @return string
     */
    public function getBelongsTo()
    {
        return isset($this->belongsTo) ? $this->belongsTo : '';
    }

    public function hasBelongsTo()
    {
        return isset($this->belongsTo);
    }

    public function clearBelongsTo()
    {
        unset($this->belongsTo);
    }

    /**
     * Generated from protobuf field <code>optional string belongsTo = 5;</code>
     * @param string $var
     * @return $this
     */
    public function setBelongsTo($var)
    {
        GPBUtil::checkString($var, True);
        $this->belongsTo = $var;

        return $this;
    }

}

