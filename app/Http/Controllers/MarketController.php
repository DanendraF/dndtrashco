<?php

namespace App\Http\Controllers;

use App\Models\MarketItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MarketController extends Controller
{
    public function index()
    {
        $marketItems = MarketItem::all();
        return view('admin.market', compact('marketItems'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'images' => 'required|array|size:4',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:20480',
            'item_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'seller_name' => 'required|string',
            'phone_number' => 'required|string',
            'address' => 'required|string',
            'status' => 'required|in:available,sold',
        ]);

        // Store images
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('market_images', 'public');
            }
        }

        // Create the market item
        $marketItem = MarketItem::create([
            'item_name' => $request->input('item_name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'seller_name' => $request->input('seller_name'),
            'phone_number' => $request->input('phone_number'),
            'address' => $request->input('address'),
            'images' => json_encode($imagePaths),
            'status' => $request->input('status'),
            'slug' => Str::slug($request->item_name),
        ]);

        session()->flash('success', 'Item added successfully!');
        return redirect()->route('admin.market');
    }

    public function edit($id)
    {
        $marketItem = MarketItem::findOrFail($id);
        return view('admin.market.edit', compact('marketItem'));
    }

    public function update(Request $request, $id)
    {
        $marketItem = MarketItem::findOrFail($id);
        $marketItem->slug = Str::slug($request->input('item_name'));

        $request->validate([
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:20480',
            'item_name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'seller_name' => 'required|string',
            'phone_number' => 'required|string',
            'address' => 'required|string',
            'status' => 'required|in:available,sold',
        ]);

        // Handle image update
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $image) {
                $imagePaths[] = $image->store('market_images', 'public');
            }
            $marketItem->images = json_encode($imagePaths);
        }

        // Update the market item
        $marketItem->update([
            'item_name' => $request->input('item_name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
            'seller_name' => $request->input('seller_name'),
            'phone_number' => $request->input('phone_number'),
            'address' => $request->input('address'),
            'status' => $request->input('status'),
            'slug' => Str::slug($request->input('item_name')),
        ]);

        session()->flash('status', 'Item updated successfully!');
        return redirect()->route('admin.market');
    }

    public function destroy($id)
    {
        $marketItem = MarketItem::findOrFail($id);
        $marketItem->delete();

        session()->flash('success', 'Item deleted successfully!');
        return redirect()->route('admin.market');
    }

    public function updateStatus($id)
    {
        $marketItem = MarketItem::findOrFail($id);
        $marketItem->status = $marketItem->status == 'sold' ? 'available' : 'sold';
        $marketItem->save();

        return redirect()->route('admin.market')->with('success', 'Item status updated successfully!');
    }

    public function marketsection()
    {
        $marketItems = MarketItem::all();
        return view('shop.marketsection', compact('marketItems'));
    }

    public function marketdetails($slug)
    {
        $marketItem = MarketItem::where('slug', $slug)->firstOrFail();
        $latestItems = MarketItem::latest()->where('status', 'available')->take(3)->get();

        // Assuming you want to fetch other items with similar category or some criteria
        // You can define $otherItems based on any condition, for example, excluding the current item
        $otherItems = MarketItem::where('status', 'available')
                                ->where('slug', '!=', $slug) // Exclude current item
                                ->take(4) // Fetch 4 other items
                                ->get();

        // Send data to view
        return view('shop.marketdetails', compact('marketItem', 'latestItems', 'otherItems'));
    }


}
