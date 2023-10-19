<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\TestMail;
use App\Models\Action;
use App\Models\Employee;
use App\Models\Invitation;
use App\Models\Societe;
use App\Models\SocieteHasEmployee;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $data = User::role('Employee')->orderBy('id', 'ASC')
                    ->when(
                        $request->name,
                        function(Builder $builder) use ($request) {
                            $builder->where('name', 'LIKE', '%'. $request->name .'%');
                        }
                    )
                    ->paginate(10);

        return view('admin.employees.index', compact('data', 'request'))
                    ->with('i', ($request->input('page', 1) - 1) * 10);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $societes = Societe::pluck('title', 'id')->all();
        return view('admin.employees.create', compact('societes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:employees,email',
            'societe_id' => 'required',
        ]);

        $input = $request->all();

        $employee = Employee::create($input);
        // $user->assignRole('Employee');

        if($request['societe_id']) {
            // Invitation::create(['employee_id' => $employee->id, 'societe_id' => $request['societe_id']]);
            Action::create(['descriptif' => 'Admin "'. Auth::user()->name .'" a invite l\'employé "'. $employee->name .'" à joindre la société "'. Societe::find($request['societe_id'])->title .'"']);
        }

        $societe = Societe::find($request['societe_id'])->title;
        $this->send_mail($societe, $employee->name, $employee->email);

        return redirect()->route('employees.index')
                        ->with('success', 'L\'invitation à été envoyée avec success.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $employee = User::find($id);
        return view('admin.employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $user->roles->pluck('name', 'name')->all();
        $societes = Societe::pluck('title', 'id')->all();

        return view('admin.employees.edit', compact('user', 'roles', 'userRole', 'societes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole('Employee');

        if($request['societe_id']) {
            Invitation::create(['employee_id' => $id, 'societe_id' => $request['societe_id']]);
        }

        return redirect()->route('employees.index')
                        ->with('success', 'Informations sur l\'employé mises à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        User::find($id)->delete();
        return redirect()->route('employees.index')
                        ->with('success', 'L\'employé a été supprimé avec succès.');
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
