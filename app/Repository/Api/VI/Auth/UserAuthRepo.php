<?php

namespace App\Repository\Api\VI\Auth;

use App\Http\Resources\userResource;
use App\Interfaces\ImageVideoUpload;
use App\Mail\wellComeEmail;
use App\Models\User;
use App\Traits\ApiResponses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
   use Laravel\Passport\Token;

class UserAuthRepo
{
    use ApiResponses;

    protected ImageVideoUpload $imageVideoUpload;

    public function __construct(ImageVideoUpload $imageVideoUpload)
    {
        $this->imageVideoUpload = $imageVideoUpload;
    }

    public function register($request)
    {
        DB::beginTransaction();
        try {
            $data_req = $request->except('_token', 'password', 'password_confirmation','image');
            $data_req['password'] = Hash::make($request->password);
            $data_req['user_type_id'] = 2; // user type = user
            $data_req['isActive'] = 1; // default active
            if( $request->file('image')) {
                $data_req['image'] = $this->imageVideoUpload->StoreImageSingleWithOutLogo($request->file('image'), 'User');
            }
            $user = User::create($data_req);
            if (app()->environment('testing')) {
                $access_token = 'fake_token_for_testing';
            } else {
                $access_token = $user->createToken('boostSport')->accessToken;
                $user->update(['access_token' => $access_token]);
            }
            DB::commit();

            return $this->sendResponse(userResource::make($user), translate('register success'), 201);
        } catch (\Exception $e) {
            DB::rollback();

            return $this->sendError($e->getMessage(), [], 500);
        }
    }

    public function login($request)
    {

        $user = User::where('phone', $request->phone)
                ->with('userType')
                ->first();
        

        if ($user === null) {
            return $this->sendError(translate('this phone not correct'), [], 400);
        } elseif (Hash::check($request->password, $user->password)) {
            if (app()->environment('testing')) {
                $access_token = 'fake_token_for_testing';
            } else {
                $access_token = $user->createToken('boostSport')->accessToken;
                $user->update(['access_token' => $access_token]);
            }

            $success = new userResource($user);

            return $this->sendResponse($success, translate('login success'), 200);

        } else {
            return $this->sendError(translate('password not correct'), [], 401);

        }

    }

   

public function logout()
{
    $user = Auth::guard('api')->user();

    if ($user) {
        /** @var Token|null $token */
        $token = $user->currentAccessToken();

        if ($token) {
            $token->delete(); // الآن Larastan/PHPStan يعرف أن delete() موجود
        }

        $user->update(['fcmToken' => null]);
    }

    return $this->sendResponse([], translate('logout success'), 200);
}


    public function showProfile()
    {
        $user = User::with(['userType'])->find(api()->id);

        return $this->sendResponse(userResource::make($user), translate('user profile'), 200);

    }

    public function updateProfile($request)
    {
        $data = $request->except(['_token', 'image', 'password', 'password_confirmation']);
        $user = User::find(api()->id);
        if ($request->file('image')) {
            $data['image'] = $this->imageVideoUpload->UpdateImageSingleWithOutLogo($request->file('image'), 'User', $user->image);
        }
        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }
        $user->update($data);

        return $this->sendResponse(userResource::make($user),translate('update profile success'), 200);
    }

    public function update_fcm($request)
    {
        $data = $request->except(['_token']);
        $user = User::find(api()->id);
        $user->update($data);

        return $this->sendResponse([],translate('update fcmToken success'), 200);

    }

    public function changePassword($request)
    {
        $data = $request->except(['_token']);
        $user = User::find(api()->id);
        $password = Hash::make($data['password']);
        $user->update(['password' => $password]);

        return $this->sendResponse([],translate('update password success'), 200);
    }

    public function destroy()
    {
        $data = User::find(api()->id);
        $data->delete();
        
        return $this->sendResponse([],translate('delete user success'), 200);
    }
}
