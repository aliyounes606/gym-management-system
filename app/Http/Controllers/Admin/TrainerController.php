<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTrainerRequest;
use App\Http\Requests\Admin\UpdateTrainerRequest;
use App\Models\TrainerProfile;
use App\Models\User;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    /**
     * Summary of index
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $trainers = TrainerProfile::with('user')->get();
        return view('admin.trainers.index', compact('trainers'));
    }
    /**
     * Summary of create
     * @return \Illuminate\Contracts\View\View
     */
    public function create()
    {

        $availableUsers = User::role('member')
            ->whereDoesntHave('trainerProfile')
            ->get();

        return view('admin.trainers.create', compact('availableUsers'));

    }
    /**
     * Summary of store
     * @param \App\Http\Requests\Admin\StoreTrainerRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreTrainerRequest $request)
    {
        $validated = $request->validated();

        //  إعطاء الدور 
        $user = User::find($validated['user_id']);
        $user->assignRole('trainer');

        TrainerProfile::create($validated);

        return redirect()->route('admin.trainers.index')->with('success', 'تمت إضافة المدرب بنجاح');
    }
    /**
     * Summary of edit
     * @param mixed $id
     * @return \Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $trainer = TrainerProfile::findOrFail($id);
        return view('admin.trainers.edit', compact('trainer'));
    }
    /**
     * Summary of update
     * @param \App\Http\Requests\Admin\UpdateTrainerRequest $request
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateTrainerRequest $request, $id)
    {
        $trainer = TrainerProfile::findOrFail($id);

        $trainer->update($request->validated());

        return redirect()->route('admin.trainers.index')->with('success', 'تم تحديث بيانات المدرب');
    }
    /**
     * Summary of destroy
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $trainer = TrainerProfile::findOrFail($id);
        $user = User::find($trainer->user_id);

        $user->removeRole('trainer'); // سحب الرتبة 
        $trainer->delete();

        return back()->with('success', 'تم إزالة المدرب وإعادته لمستخدم عادي');
    }
}
