<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTrainerRequest;
use App\Http\Requests\Admin\UpdateTrainerRequest;
use App\Models\TrainerProfile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TrainerController extends Controller
{
    /**
     * Summary of index
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $trainers = TrainerProfile::with('user')->paginate(10);
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

        $trainer = TrainerProfile::create($validated);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('trainer_images', 'public');

            $trainer->image()->create([
                'path' => $imagePath
            ]);
        }

        return redirect()->route('admin.trainers.index')->with('success', 'تمت إضافة المدرب بنجاح');
    }
    /**
     * Summary of show
     * @param mixed $id
     * @return \Illuminate\Contracts\View\View
     */
    public function show($id)
    {
        $trainer = TrainerProfile::with(['user', 'image'])->findOrFail($id);

        return view('admin.trainers.show', compact('trainer'));
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

        if ($request->hasFile('image')) {

            if ($trainer->image && $trainer->image->path) {
                Storage::disk('public')->delete($trainer->image->path);
            }

            $imagePath = $request->file('image')->store('trainer_images', 'public');

            $trainer->image()->updateOrCreate(
                [],
                ['path' => $imagePath]
            );
        }

        return redirect()->route('admin.trainers.index')->with('success', 'تم تحديث بيانات المدرب والصورة بنجاح');
    }
    /**
     * Summary of destroy
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $trainer = TrainerProfile::findOrFail($id);

        if ($trainer->gymsessions()->exists()) {
            return redirect()->back()->with('error', 'عذراً، لا يمكن حذف هذا المدرب لأنه مرتبط بجلسات تدريبية (حالية أو سابقة). يرجى إلغاء الجلسات أو تعيين مدرب آخر لها أولاً.');
        }

        if ($trainer->image) {
            Storage::disk('public')->delete($trainer->image->path);
            $trainer->image()->delete();
        }

        $user = User::find($trainer->user_id);
        if ($user) {
            $user->removeRole('trainer');
        }

        $trainer->delete();

        return redirect()->route('admin.trainers.index')->with('success', 'تم إزالة المدرب وإعادته لمستخدم عادي.');
    }
}
