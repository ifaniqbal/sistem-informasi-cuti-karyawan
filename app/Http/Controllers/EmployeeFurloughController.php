<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeFurloughStoreRequest;
use App\Models\Employee;
use App\Models\Furlough;
use Illuminate\Http\Request;
use Inertia\Inertia;

class EmployeeFurloughController extends Controller
{
    public function create(Employee $employee)
    {
        $this->authorize('propose furlough');

        return Inertia::render('EmployeeFurloughCreate', [
            'employee' => $employee,
        ]);
    }

    public function store(Employee $employee, EmployeeFurloughStoreRequest $request)
    {
        $this->authorize('propose furlough');

        $furlough = new Furlough;
        $furlough->fill($request->validated());
        $furlough->employee()->associate($employee);
        $furlough->save();

        return back();
    }
}
