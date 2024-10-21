<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\User;
use App\Http\Controllers\Controller;
use App\Http\DTO\App\CreatUserDto;
use App\Http\Requests\SettingUserRequest;
use App\Services\App\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Resources\User\UserCollection;
use App\Traits\ValidatesRequestTrait;
use App\Services\External\NavitimeGateway\AddressGatewayService;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    use ValidatesRequestTrait;

    private $userService;

    private $addressGatewayService;


    public function __construct(UserService $userService, AddressGatewayService $addressGatewayService)
    {
        $this->userService = $userService;
        $this->addressGatewayService = $addressGatewayService;

    }//end __construct()


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            Storage::disk('s3')->put('test.txt', 'Hello World');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        $data = $this->userService->getList();
        return self::responseSuccess(new UserCollection($data));

    }//end index()


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function store(SettingUserRequest $request)
    {
        $data = $this->userService->create(CreatUserDto::fromApiRequest($request));

        //if request is array
        //        $request = [
        //            'name' => 'test',
        //            'email' => 'binh',
        //            'password' => '123456'
        //        ];
        //        $validated = $this->validateRequest($request, new SettingUserRequest());
        //
        //        $userDto = new UserDto(
        //            $validated['name'],
        //            $validated['email'],
        //            $validated['password']);
        //
        //        $data = $this->userService->create($userDto);

        return self::responseSuccess($data);

    }//end store()


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

    }//end show()


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

    }//end update()


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //

    }//end destroy()


}//end class
