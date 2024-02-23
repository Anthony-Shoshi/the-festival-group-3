<?php

namespace App\Models;

use DateTime;
use Role;

class User
{
    public int $userid;
    public string $name;
    public string $profilepicture;
    public string $email;
    public Role $role;
    public string $password;
    public DateTime $registration_date;

    public function getUserid(): int
    {
        return $this->userid;
    }
    public function setuserid(int $userid):void
    {
        $this->userid = $userid;
    }
    public function getname():string
    {
        return $this->name;
    }
    public function setname(string $name):void
    {
        $this->name = $name;
    }
    public function getprofilepicture():string
    {
        return $this->profile_picture;
    }
    public function setprofilepicture(string $profilepicture):void
    {
        $this->profilepicture = $profilepicture;
    }
    public function getemail():string
    {
        return $this->email;
    }
    public function setemail(string $email):void
    {
        $this->email = $email;
    }
    public function getrole():Role
    {
        return $this->role;
    }
    public function setrole(Role $role):void
    {
        $this->role = $role;
    }
    public function getpassword():string
    {
        return $this->password;
    }
    public function setpassword(string $password):void
    {
        $this->password = $password;
    }
    public function getregistration_date():DateTime
    {
        return $this->registration_date;
    }
    public function setregistration_date(DateTime $registration_date):void
    {
        $this->registration_date = $registration_date;
    }
}
