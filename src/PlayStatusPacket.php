<?php

namespace rhexcry\pe\protocol;

use rhexcry\pe\protocol\api\DataPacket;
use rhexcry\pe\protocol\api\ProtocolInfo;

class PlayStatusPacket extends DataPacket
{

    public const NETWORK_ID = ProtocolInfo::PLAY_STATUS_PACKET;

    public const LOGIN_SUCCESS = 0;
    public const LOGIN_FAILED_CLIENT = 1;
    public const LOGIN_FAILED_SERVER = 2;
    public const PLAYER_SPAWN = 3;
    public const LOGIN_FAILED_INVALID_TENANT = 4;
    public const LOGIN_FAILED_VANILLA_EDU = 5;
    public const LOGIN_FAILED_EDU_VANILLA = 6;

    public int $status;

    public function decode(): void
    {
        $this->status = $this->getInt();
    }

    public function encode(): void
    {
        $this->reset();
        $this->putInt($this->status);
    }

    public function getName(): string
    {
        return "PlayStatusPacket";
    }

}