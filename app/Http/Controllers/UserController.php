<?php

namespace App\Http\Controllers;

use App\Actions\Fortify\CreateNewUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function registerUser(Request $request)
    {
        $createUser = new CreateNewUser();

        $therapistData = $request->all();

        $result = $createUser->create($therapistData);

        if ($result) {
            // Send the welcome email to the therapist
            $user = User::findOrFail($result->id);

            // Build response for the request
            $response_code = Response::HTTP_OK;
            $response_message = "Therapist saved successfully";
        } else {
            $response_code = Response::HTTP_INTERNAL_SERVER_ERROR;
            $response_message = "Sorry! An error occured. Please try again";
        }

        return response()->json(
            [
                'response_code' => $response_code,
                'response_message' => $response_message
            ],
            $response_code
        );
    }

    public function checkEmail(Request $request)
    {
        $user = User::where("email", $request->email)->first();

        return ($user) ? "false" : "true";
    }
}
