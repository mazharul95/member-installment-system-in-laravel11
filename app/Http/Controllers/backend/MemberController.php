<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    public function index()
    {
        $title = "Member List";
        $members = Member::orderBy('id','DESC')->where('del_status',"Live")->get();
        return view('backend.members.index',compact('title','members'));
    }

    public function create()
    {
        $title = "Add Member";
        return view('backend.members.addEditMember',compact('title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email',
            'phone' => 'required|numeric',
            'address' => 'required|string|max:255',
            'del_status' => 'nullable|in:Live,Deleted',
        ]);

       // $obj = Member::create($request->all());
        $obj = new Member();
        $obj->name = $request->name;
        $obj->email = $request->email;
        $obj->phone = $request->phone;
        $obj->address = $request->address;
        $obj->created_at=Carbon::now();

        $obj->save();

        // Create 12 installments for the member
        for ($i = 1; $i <= 12; $i++) {
            $obj->installments()->create([
                'amount' => $request->input('installment_amount'),
                'due_date' => now()->addMonths($i),
            ]);
        }

        return redirect()->route('members.index')->with('success', 'Member created successfully.');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $title =  "Edit Vehicles";
        $obj = Member::findOrFail($id);
        return view('backend.members.addEditMember', compact('obj','title'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:members,email,' . $member->id,,
            'phone' => 'required|numeric',
            'address' => 'required|string|max:255',
            'del_status' => 'nullable',
        ]);
        
        $member->update($request->all());
        return redirect()->route('members.index')->with('success', 'Member updated successfully.');

    }

    public function destroy(string $id)
    {
        $obj = Member::find($id);
        $obj->del_status = "Deleted";
        $obj->save();
        return redirect()->route('members.index')
            ->with('success', 'members delete successfully.');
    }
}
