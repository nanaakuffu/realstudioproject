<?php

namespace App\Http\Controllers;

use App\Contracts\Resource;
use App\Models\Company;
use App\Traits\UploadPhoto;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CompanyController extends Controller implements Resource
{
    use UploadPhoto;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $companies = Company::all();
        return view('pages.company.home', [
            'page_uri' => 'company',
            'companies' => $companies
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): JsonResponse
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'string', 'max:255', Rule::unique(Company::class)],
            'website' => ['string', 'max:255', 'nullable'],
            'logo' => ['nullable', 'image', 'max:1024']
        ]);

        if ($request->hasFile('logo')) {
            $request->logo = $this->uploadPhoto($request->logo, 'company-logos');
        }

        $companyData = $request->all();

        $result = DB::transaction(function () use ($companyData) {
            return Company::create($companyData);
        });

        if ($result) {
            $response_code = Response::HTTP_OK;
            $response_message = "Profile Updated successfully";
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): JsonResponse
    {
        $company = Company::find($id);
        if ($company) {
            $response_code = Response::HTTP_OK;
            $response_data = $company;
            $response_message = "Data query was succesfull";
        } else {
            $response_code = Response::HTTP_INTERNAL_SERVER_ERROR;
            $response_data = [];
            $response_message = "Sorry! An error occures";
        }

        return response()->json([
            "response_code" => $response_code,
            "response_data" => $response_data,
            "response_message" => $response_message
        ], $response_code);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): JsonResponse
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'string', 'max:255', Rule::unique(Company::class)->ignore($id)],
            'website' => ['string', 'max:255', 'nullable'],
            'logo-file' => ['nullable', 'image', 'max:1024']
        ]);



        $company = Company::find($id);
        $companyData = $request->all();
        if ($request->hasFile('logo-file')) {
            $companyData['logo'] = $this->uploadPhoto($request->file('logo-file'), 'company-logos');
        }

        $result = DB::transaction(function () use ($companyData, $company) {
            return $company->update($companyData);
        });

        if ($result) {
            $response_code = Response::HTTP_OK;
            $response_message = "Company Updated successfully";
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): JsonResponse
    {
        $resource = Company::find($id);
        $result = $resource->delete();

        if ($result) {
            $code = Response::HTTP_OK;
            $message = "Company deleted successfuly!";
        } else {
            $code = Response::HTTP_INTERNAL_SERVER_ERROR;
            $message = "Sorry! An error ocured";
        }

        return response()->json([
            "response_code" => $code,
            "response_message" => $message
        ], $code);
    }
}
