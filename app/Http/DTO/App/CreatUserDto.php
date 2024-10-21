<?php

namespace App\Http\DTO\App;

use Illuminate\Http\Request;

readonly class CreatUserDto
{


    public function __construct(
        public string $name,
        public string $email,
        public string $password,
    ) {

    }//end __construct()


    public static function fromApiRequest(Request $request): CreatUserDto
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
