<?php

namespace App\Http\DTO\App;

use App\Http\Requests\SettingUserRequest;

class UserDto
{


    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
    ) {

    }//end __construct()


    public static function fromApiRequest(SettingUserRequest $request): UserDto
    {
        return new self(
            name: $request->validated('name'),
            email: $request->validated('email'),
            password: $request->validated('password'),
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
