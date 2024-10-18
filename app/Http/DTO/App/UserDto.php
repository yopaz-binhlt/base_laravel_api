<?php

namespace App\Http\DTO\App;

class UserDto
{


    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
    ) {

    }//end __construct()


    public static function fromApiRequest($request): UserDto
    {
        return new self(
            name: $request->name,
            email: $request->email,
            password: $request->password
        );

    }//end fromApiRequest()


    public function toArray(): array
    {
        return [
            'name'     => $this->name,
            'email'    => $this->email,
            'password' => $this->password,
        ];

    }//end toArray()


}//end class
