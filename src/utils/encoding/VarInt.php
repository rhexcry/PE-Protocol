<?php

namespace rhexcry\pe\protocol\utils\encoding;

final class VarInt
{

    public static function unpackVarInt(string $buffer, int &$offset = 0) : int{
        $raw = self::unpackUnsignedVarInt($buffer, $offset);
        return ($raw >> 1) ^ -($raw & 1);
    }

    public static function unpackUnsignedVarInt(string $buffer, int &$offset = 0) : int{
        $value = 0;
        $shift = 0;

        while(true){
            if($offset >= strlen($buffer)){
                throw new \InvalidArgumentException("Unexpected end of buffer while reading VarInt");
            }

            $byte = ord($buffer[$offset++]);
            $value |= ($byte & 0x7F) << $shift;
            $shift += 7;

            if(($byte & 0x80) === 0){
                break;
            }
        }

        return $value;
    }

}