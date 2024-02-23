<?php
class Role implements jsonSerializable{
    const Customer = 'Customer';
    const Admin = 'Admin';
    const Employee = 'Employee';

    public function jsonSerialize(){
        return get_object_vars($this);
    }
    public static function Customer():self
    {
        return new self(self::Customer);
    }
    public static function Admin():self
    {
        return new self(self::Admin);
    }
    public static function Employee():self
    {
        return new self(self::Employee);
    }
    public static function getRole(self $value):string
    {
        return match($value-> value){
            self::Customer => 'Customer',
            self::Admin => 'Admin',
            self::Employee => 'Employee',
            default => throw new InvalidArgumentException("Invalid Role : $value ")
        };
    }
    public function fromString(string $value):self
    {
        return match($value){
            'Customer' => self::Customer(),
            'Admin' => self::Admin(),
            'Employee' => self::Employee(),
            default => throw new InvalidArgumentException("Invalid Role : $value ")
        };
    }
    public function getEnumValues():array
    {
        $reflectionClass = new ReflectionClass(__CLASS__);
        $constants = $reflectionClass->getConstants();
        return array_values($constants);
    }
}