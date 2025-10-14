<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class PhoneVerificationController extends Controller
{
    use ApiResponses;

    public function sendVerificationCode(Request $request) {

        // $response = Http::withHeader([
        //     'Content-Type: application/json; charset=UTF-8',
        // ])
        // ->withToken(config('phoneValidation.dev.auth.bearerToken'))
        // ->post(config('phoneValidation.dev.url'), [
       $response = Http::post(config('phoneValidation.dev.url'), [
            // 'phone_number' => $request->input('phone_number'),
            // 'verify_profile_id' => config('phoneValidation.dev.auth.verifyProfileId'),
            'title' => $request->input('title'),
            'body' => $request->input('body'),
            'userId' => $request->input('userId'),
        ]);

        $ssid = $request->input('ssId');
        $phone = $request->input('phone');

        if ($response->successful()) {
            // Store in Redis verification code and it's expiration time.
            Redis::setex($ssid .'_'. $phone, config('phoneValidation.timeout'), $phone);

            return $this->success([
                'message' => 'Verification code sent successfully'
            ]);
        }

        Log::debug('Response from request: {RSP}', ['RSP' => $response]);

        return $this->success(json_decode($response));

    }

    public function validateVerificationCode(Request $request) {
        Log::debug('---');
        $ssid = $request->input('ssId');
        $phone = $request->input('phone');

        $isCodeValid = Redis::get($ssid .'_'. $phone);

        if (!$isCodeValid) {
            return $this->notFound('Verification code expired, try again later.');
        }

        return $this->success([
            'codeValidForPhone' => $isCodeValid
        ]);

        // TODO
        // $response = 

    }
}
