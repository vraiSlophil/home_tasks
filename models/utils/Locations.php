<?php

enum Locations: string
{
    case INDEX = "Location: index.php";
    case LOGIN = "Location: login.php";
    case NEWHOUSE = "Location: new_house.php";
    case PROFILE = "Location: profile.php";

    public function getValue(): string
    {
        return $this->value;
    }
}