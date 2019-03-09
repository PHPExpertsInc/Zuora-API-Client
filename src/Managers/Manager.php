<?php


namespace PHPExperts\ZuoraClient\Managers;

use PHPExperts\RESTSpeaker\RESTSpeaker;

abstract class Manager
{
    /** @var RESTSpeaker */
    protected $api;

    public function __construct(RESTSpeaker $api)
    {
        $this->api = $api;
    }
}
