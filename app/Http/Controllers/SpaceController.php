<?php

namespace App\Http\Controllers;

use App\Models\Space;
use App\Models\Branch;
use App\Events\CreateSpace;
use App\Events\UpdateSpace;
use Illuminate\Http\Request;
use App\Models\BookingRequest;
use App\Http\Requests\SpaceRequest;
use App\Models\Availability;
use App\Models\Day;
use Illuminate\Support\Facades\Auth;

class SpaceController extends Controller
{

    public function index(Request $request, Branch $branch)
    {

        // if(Auth::user()->role == 'member'){
        //     $spaces = $branch->spaces->where('type' , 'free_space');
        // }else{
        //     $spaces = $branch->spaces;
        // }

        $this->authorize('viewAny', [Space::class]);

        $spaces = $branch->spaces()->filter($request->query())->get();

        // $spaces = Space::filter($request->query())->get();

        $books = BookingRequest::all();
        $days = Day::all();
        // dd($days);
        return view('admin.branch.spaces', [
            'branch' => $branch,
            'spaces' => $spaces,
            'books' => $books,
            'space' => new Space(),
            'branches' => Branch::all(),
            'days' => $days,
            'request' => new BookingRequest()
        ]);
    }

    public function store(Branch $branch, SpaceRequest $request)
    {

        $this->authorize('create', [Space::class]);

        $validated = $request->validated();


        if ($request->hasFile('image')) {

            $file = $request->file('image');

            $path = Space::uploadImage($file);

            $validated['image'] = $path;
        }

        $space = Space::create($validated);

        event(new CreateSpace($space));

        return back()->with('success', __('Space Added Sucessfully.'));
    }


    public function update(SpaceRequest $request, Branch $branch, Space $space)
    {
        $this->authorize('update', $space);

        $old_image = $space->image;

        $validated = $request->validated();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = Space::uploadImage($file);
            $validated['image'] = $path;
        }

        $space->update($validated);

        event(new UpdateSpace($space));

        if ($old_image && $old_image != $space->iamge) {
            Space::deleteImage($old_image);
        }

        return back()->with('success', __('Space Updated Sucessfully.'));
    }

    public function destroy(Branch $branch, Space $space)
    {

        $this->authorize('delete', $space);

        $space->delete();

        if ($space->image) {
            Space::deleteImage($space->image);
        }

        return back()->with('success', __('Space Updated Sucessfully.'));
    }
}
