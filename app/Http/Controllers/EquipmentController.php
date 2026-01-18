<?php

namespace App\Http\Controllers;
 
use App\Http\Requests\StoreEquipmentRequest;
use App\Http\Requests\UpdateEquipmentRequest;
use App\Services\EquipmentService;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

/**
 * Handles equipment CRUD operations for web views.
 * Delegates all business logic to EquipmentService.
 */
class EquipmentController extends Controller implements HasMiddleware
{
    protected EquipmentService $equipmentService;

    public function __construct(EquipmentService $equipmentService)
    {
        $this->equipmentService = $equipmentService;
    }

    public static function middleware(): array
    {
        return [
            new Middleware('can:sessions.view', only: ['index', 'show']),
            new Middleware('can:sessions.create', only: ['create', 'store']),
            new Middleware('can:sessions.update', only: ['edit', 'update']),
            new Middleware('can:sessions.delete', only: ['destroy']),
        ];
    }

    /**
     * Display a list of equipment.
     */
    public function index()
    {
        $equipment = $this->equipmentService->paginate();
        return view('equipment.index', compact('equipment'));
    }

    /**
     * Show the equipment creation form.
     */
    public function create()
    {
        $categories = $this->equipmentService->getCategories();
        return view('equipment.create', compact('categories'));
    }

    /**
     * Store a new equipment record.
     */
    public function store(StoreEquipmentRequest $request)
    {
        $this->equipmentService->store($request);

        return redirect()->route('equipment.index')
            ->with('success', 'تم حفظ المعدة بنجاح');
    }

    /**
     * Display a single equipment.
     */
    public function show($id)
    {
        $equipment = $this->equipmentService->find($id);
        return view('equipment.show', compact('equipment'));
    }

    /**
     * Show the equipment edit form.
     */
    public function edit($id)
    {
        $equipment = $this->equipmentService->find($id);
        $categories = $this->equipmentService->getCategories();

        return view('equipment.edit', compact('equipment', 'categories'));
    }

    /**
     * Update an existing equipment.
     */
    public function update(UpdateEquipmentRequest $request, $id)
    {
        $this->equipmentService->update($request, $id);

        return redirect()->route('equipment.index')
            ->with('success', 'تم تحديث المعدة بنجاح');
    }

    /**
     * Delete an equipment.
     */
    public function destroy($id)
    {
        $this->equipmentService->delete($id);

        return redirect()->route('equipment.index')
            ->with('success', 'تم حذف المعدة');
    }
} 