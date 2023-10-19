<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\TestMail;
use App\Models\Action;
use App\Models\Employee;
use App\Models\Invitation;
use App\Models\Societe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class InvitationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $confirmeInvitations = Invitation::select('employee_email')->where('confirme', 1);
        $data = Employee::whereNotIn('email', $confirmeInvitations)->orderBy('id', 'ASC')->paginate(10);

        return view('admin.invitations.index', compact('data'))
                    ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $societes = Societe::pluck('title', 'id')->all();
        return view('admin.invitations.create', compact('societes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:employees,email',
            'societe_id' => 'required',
        ]);

        $input = $request->all();

        $employee = Employee::create($input);

        if($request['societe_id']) {
            // Invitation::create(['employee_id' => $employee->id, 'societe_id' => $request['societe_id']]);
            Action::create(['descriptif' => 'Admin "'. Auth::user()->name .'" a invite l\'employé "'. $employee->name .'" à joindre la société "'. Societe::find($request['societe_id'])->title .'"']);
        }

        $societe = Societe::find($request['societe_id'])->title;
        $this->send_mail($societe, $employee->name, $employee->email);

        return redirect()->route('invitations.index')
                        ->with('success', 'L\'invitation à été envoyée avec success.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $employee = Employee::find($id);
        return view('admin.invitations.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invitation $invitation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($email)
    {
        $invitation = Invitation::where('employee_email', $email);

        Action::create(['descriptif' => '"'. $email .'" à confirmer son profile']);

        $invitation->update(['status' => 'l\'invitation est confirmée', 'confirme' => 1]);

        return redirect()->route('invitations.index')
                        ->with('success', 'L\'invitation à été confirmée avec success.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);

        Action::create(['descriptif' => '"'. $employee->name .'" à annuler son profile']);

        $employee->delete();

        return redirect()->route('invitations.index')
                        ->with('success', 'L\'invitation a été annulée avec succès.');
    }

    public function send_mail($societe, $name, $email)
    {
        $mailData = [
            'title' => 'Invitation pour joindre à la société '. $societe,
            'societe' => $societe,
            'name' => $name,
            'email' => $email,
        ];

        Mail::to($email)->send(new TestMail($mailData));

    }
}
