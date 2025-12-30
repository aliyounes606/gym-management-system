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
     * Display a listing of the resource.
     */
    public function index()
    {
        $trainers = TrainerProfile::with('user')->get();
        // جلب المستخدمين العاديين لتحوليهم الى مدربين 
        $availableUsers = User::doesntHave('trainerProfile')->doesntHave('roles')->get();
        return view('admin.trainers.index', compact('trainers', 'availableUsers'));
    }

    public function store(StoreTrainerRequest $request)
    {
        $validated = $request->validated();

        //  إعطاء الدور 
        $user = User::find($validated['user_id']);
        $user->assignRole('trainer');

        TrainerProfile::create($validated);

        return redirect()->route('admin.trainers.index')->with('success', 'تمت إضافة المدرب بنجاح');
    }

    public function edit($id)
    {
        $trainer = TrainerProfile::findOrFail($id);
        return view('admin.trainers.edit', compact('trainer'));
    }

    public function update(UpdateTrainerRequest $request, $id)
    {
        $trainer = TrainerProfile::findOrFail($id);

        $trainer->update($request->validated());

        return redirect()->route('admin.trainers.index')->with('success', 'تم تحديث بيانات المدرب');
    }

    // حذف المدرب (إعادته ليوزر عادي)
    public function destroy($id)
    {
        $trainer = TrainerProfile::findOrFail($id);
        $user = User::find($trainer->user_id);

        $user->removeRole('trainer'); // سحب الرتبة منه
        $trainer->delete(); // حذف البروفايل

        return back()->with('success', 'تم إزالة المدرب وإعادته لمستخدم عادي');
    }
}
