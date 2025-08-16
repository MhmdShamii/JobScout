<?php

namespace App\Http\Controllers;

use App\Models\Employer;

class CompaniesController extends Controller
{
    public function index()
    {
        $companies = Employer::withCount('jobs')
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('companies.index', [
            "companies" => $companies
        ]);
    }

    public function show(Employer $company)
    {
        $company->load(['jobs' => function ($query) {
            $query->with(['tags:id,title'])->latest();
        }]);

        return view('companies.show', [
            'company' => $company
        ]);
    }
}
