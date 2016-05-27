<?php

namespace Starcode\Library;

/**
 * Created by PhpStorm.
 * User: silvio
 * Date: 15/04/16
 * Time: 00:46
 */
trait PhalconTimeStampable
{
    /**
     * @var \DateTime
     */
    protected $created;

    /**
     * @var \DateTime
     */
    protected $updated;

    public function beforeCreate()
    {
        $dateTime      = new \DateTime();
        $this->created = $dateTime->format("Y-m-d H:i:s");
    }

    public function beforeUpdate()
    {
        $dateTime      = new \DateTime();
        $this->updated = $dateTime->format("Y-m-d H:i:s");
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function getUpdated()
    {
        return $this->updated;
    }
}