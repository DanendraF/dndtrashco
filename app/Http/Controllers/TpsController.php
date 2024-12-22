<?php

namespace App\Http\Controllers;

use App\Models\Tps;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TpsController extends Controller
{
    public function index()
    {
        $tpsList = Tps::all();
        return view('admin.tps', compact('tpsList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'open_time' => 'required|date_format:H:i',
            'close_time' => 'required|date_format:H:i',
            'link_maps' => 'required|string',
        ]);

        $tps = new Tps;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('tps_images', 'public');
            $tps->image = $imagePath;
        }

        $tps->name = $request->name;
        $tps->location = $request->location;
        $tps->description = $request->description;
        $tps->open_time = $request->open_time;
        $tps->close_time = $request->close_time;
        $tps->link_maps = $request->link_maps;
        $tps->slug = Str::slug($request->name);
        $tps->save();


        return redirect()->route('admin.tps')->with('success', 'TPS added successfully!');
    }

    public function edit($id)
        {
            $tps = Tps::findOrFail($id);
            return response()->json($tps);
        }

    public function update(Request $request, $id)
        {
            $tps = Tps::findOrFail($id);
            $tps->update($request->all());

            if ($request->hasFile('image')) {
                // Upload gambar jika ada
                $path = $request->file('image')->store('tps_images', 'public');
                $tps->image = $path;
                $tps->save();
            }

            return redirect()->route('admin.tps')->with('success', 'TPS updated successfully.');
        }

    public function destroy($id)
    {
        $tps = Tps::findOrFail($id);
        $tps->delete();

        return response()->json(['success' => true, 'message' => 'TPS deleted successfully.']);
    }


    public function tpssection()
    {
        $tpsList = Tps::all();
        return view('tps.tpssection', compact('tpsList'));
    }

    public function tpsdetails($slug)
    {
        $tps = Tps::where('slug', $slug)->firstOrFail();
        return view('tps.tpsdetails', compact('tps'));
    }

}
