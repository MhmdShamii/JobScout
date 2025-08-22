<?php

namespace App\Http\Controllers;

use App\Models\CompanyRequest;
use Illuminate\Http\Request;
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

    public function userRequestToPrepareCompany()
    {
        return view('company-request.index');
    }

    public function userRequestToBecomeCompany(Request $request)
    {
        $user = $request->user();

        if (CompanyRequest::where('user_id', $user->id)->exists()) {
            return back()->with('error', 'You already submitted a company request.');
        }

        $data = $request->validate([
            'company_name' => 'required|string|max:255',
            'description'  => 'required|string|max:1000',
            'location'     => 'required|string|max:255',
            'logo'         => 'nullable|string|max:255',
        ]);

        CompanyRequest::create([
            'user_id'     => $user->id,
            'comp_name'   => $data['company_name'],
            'location'    => $data['location'],
            'description' => $data['description'],
            'logo'        => $data['logo'] ?? "https://picsum.photos/seed/{$user->id}/42/42",
            'status'      => 'pending',
        ]);

        return back()->with('success', 'Request submitted. We will review it soon.');
    }


    public function viewCompanyRequests()
    {
        $requests = CompanyRequest::with('user:id,name,email')->where('status', 'pending')
            ->latest()
            ->paginate(10);

        return view('admin.company-requests.viewComanyRequests', compact('requests'));
    }

    public function approveCompanyRequest(CompanyRequest $companyRequest)
    {
        $companyRequest->user->update(['role' => 'company']);
        $companyRequest->update(['status' => 'approved']);

        Employer::create([
            'user_id'     => $companyRequest->user->id,
            'name'        => $companyRequest->comp_name,
            'logo'        => $companyRequest->logo ?? 'default-logo.png',
            'location'    => $companyRequest->location,
            'description' => $companyRequest->description,
        ]);

        return back()->with('success', 'Request approved.');
    }

    public function rejectCompanyRequest(CompanyRequest $companyRequest)
    {
        $companyRequest->update(['status' => 'rejected']);
        return back()->with('success', 'Request rejected.');
    }
}
