<?php

namespace App\Http\Controllers;

use App\Contracts\Resource;
use App\Models\Employee;
use App\Traits\UploadPhoto;
use App\Models\Company;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class EmployeeController extends Controller implements Resource
{
    use UploadPhoto;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $employees = Employee::all();
        $companies = Company::select(['id', 'name'])->get();
        return view('pages.employee.home', [
            'page_uri' => 'employee',
            'employees' => $employees,
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'string', 'max:255', Rule::unique(Employee::class)],
            'phone' => ['string', 'min:10', 'max:10', 'nullable'],
            'company' => ['integer', 'required'],
            'picture-file' => ['nullable', 'image', 'max:1024']
        ]);

        $employeeData = $request->all();
        if ($request->hasFile('picture-file')) {
            $employeeData['picture'] = $this->uploadPhoto($request->file('picture-file'), 'employee-pics');
        }

        $result = DB::transaction(function () use ($employeeData) {
            return Employee::create($employeeData);
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
        $company = Employee::find($id);
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'string', 'max:255', Rule::unique(Employee::class)->ignore($id)],
            'phone' => ['string', 'min:10', 'max:10', 'nullable'],
            'company' => ['integer', 'required'],
            'picture-file' => ['nullable', 'image', 'max:1024']
        ]);

        $employee = Employee::find($id);
        $employeeData = $request->all();
        if ($request->hasFile('picture-file')) {
            $employeeData['picture'] = $this->uploadPhoto($request->file('picture-file'), 'employee-pics');
        }

        $result = DB::transaction(function () use ($employeeData, $employee) {
            return $employee->update($employeeData);
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
        $resource = Employee::find($id);
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
