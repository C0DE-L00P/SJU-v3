<?php

namespace App\Http\Controllers\Admin;

use App\Models\Explainer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ExplainerRequest;
use App\Http\Resources\ExplainerResource;
use App\Models\TrainingBag;

class ExplainerController extends Controller
{
    public function __construct()
    {
        // $this->authorizeResource(TrainingBag::class, 'file');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): \Inertia\Response|\Inertia\ResponseFactory
    {
        $files = Explainer::filter(request())
            ->order(request())
            ->paginate(request()->perPage ?: 10)
            ->withQueryString();

        return inertia('Admin/Explainer/Index', [
            'files' => ExplainerResource::collection($files)->additional([
                'can_create' => request()->user()->can('create', TrainingBag::class),
            ]),
            'filters' => request()->only(['perPage', 'search', 'order', 'dir'])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Admin/Explainer/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ExplainerRequest $request)
    {
        $data = $request->validated();

        // Store it
        $data['path'] = $data['file']->store("explainer");

        // Create file
        $file = Explainer::create($data);

        // Redirect
        return redirect()->route('admin.explainer.index')->with('message', __('You submitted successfully'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Explainer $file)
    {
        // Delete files
        Storage::delete($file->path ?? '');
        $file->delete();
        return redirect()->back()->with('message', __('File deleted successfully'));
    }
}
