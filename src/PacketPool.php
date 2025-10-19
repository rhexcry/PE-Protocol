<?php

namespace rhexcry\pe\protocol;

use rhexcry\pe\protocol\api\DataPacket;
use rhexcry\pe\protocol\utils\encoding\VarInt;

class PacketPool
{

    protected static ?PacketPool $instance = null;

    /** @var \SplFixedArray<DataPacket> */
    protected \SplFixedArray $pool;

    public static function getInstance() : self{
        if(self::$instance === null){
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function __construct()
    {
        $this->pool = new \SplFixedArray(512);

        $this->registerPacket(new PlayStatusPacket());
        $this->registerPacket(new TextPacket());
    }

    public function registerPacket(DataPacket $packet) : void{
        $this->pool[$packet->pid()] = clone $packet;
    }

    public function getPacketById(int $pid) : ?DataPacket{
        return isset($this->pool[$pid]) ? clone $this->pool[$pid] : null;
    }

    public function getPacket(string $buffer) : ?DataPacket{
        return $this->getPacketById(VarInt::unpackUnsignedVarInt($buffer) & DataPacket::PID_MASK);
    }

}