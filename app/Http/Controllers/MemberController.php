<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Center;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index()
    {
        $members = Member::with('center')->latest()->paginate(10);
        return view('modules.member.index', compact('members'));
    }

    public function create()
    {
        $centers = Center::with('area')->get();
        return view('modules.member.create', compact('centers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'center_id' => 'required',
            'name' => 'required',
        ]);

        $memberNo = 'MB-' . rand(100000, 999999);

        Member::create([
            'center_id' => $request->center_id,
            'member_no' => $memberNo,
            'name' => $request->name,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'birth_date' => $request->birth_date,
            'nid' => $request->nid,
            'phone' => $request->phone,
            'address' => $request->address,
            'nominee_name' => $request->nominee_name,
            'nominee_relation' => $request->nominee_relation,
            'nominee_phone' => $request->nominee_phone,
            'status' => 1,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('member.index')
            ->with('success', 'Member created successfully');
    }

    public function show($id)
    {
        $member = Member::with('center')->findOrFail($id);
        return view('modules.member.show', compact('member'));
    }

    public function edit($id)
    {
        $member = Member::findOrFail($id);
        $centers = Center::all();
        return view('modules.member.edit', compact('member','centers'));
    }

    public function update(Request $request, $id)
    {
        $member = Member::findOrFail($id);

        $member->update([
            'center_id' => $request->center_id,
            'name' => $request->name,
            'father_name' => $request->father_name,
            'mother_name' => $request->mother_name,
            'birth_date' => $request->birth_date,
            'nid' => $request->nid,
            'phone' => $request->phone,
            'address' => $request->address,
            'nominee_name' => $request->nominee_name,
            'nominee_relation' => $request->nominee_relation,
            'nominee_phone' => $request->nominee_phone,
        ]);

        return redirect()->route('member.index')
            ->with('success', 'Member updated successfully');
    }

    public function destroy($id)
    {
        Member::findOrFail($id)->delete();

        return redirect()->route('member.index')
            ->with('success', 'Member deleted successfully');
    }
}