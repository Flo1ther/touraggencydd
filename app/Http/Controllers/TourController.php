<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\TourImage;
use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Service;
use App\Models\Post;
class TourController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    }

    /**
     * Показати список турів (тільки для адмінки).
     */
    public function index()
    {
        $tours = Tour::orderBy('created_at', 'desc')->paginate(9);


        return view('admin.tours.index', compact('tours'));

    }

    /**
     * Показати форму створення нового туру.
     */
    public function create()
    {
        $cities = City::all();
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.tours.create', compact('cities', 'categories', 'tags'));
    }


    /**
     * Зберегти новий тур у базу даних.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'required|string|max:255',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $tour = Tour::create($request->only([
            'title', 'description', 'price', 'start_date', 'end_date', 'location'
        ]));

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('uploads', 'public');

                TourImage::create([
                    'tour_id' => $tour->id,
                    'image_path' => $path,
                ]);
            }
        }

        return redirect()->route('tours.index')->with('success', 'Тур створено!');
    }
    public function search(Request $request)
    {
        $query = Tour::query();

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->location . '%');
        }

        if ($request->filled('from')) {
            $query->where('location', 'like', '%' . $request->from . '%');
        }

        if ($request->filled('start_date')) {
            $query->whereDate('start_date', '>=', $request->start_date);
        }

        if ($request->filled('duration_days')) {
            $query->where('duration_days', $request->duration_days);
        }

        if ($request->filled('adults')) {
            $query->where('adults', '>=', $request->adults);
        }

        if ($request->filled('children')) {
            $query->where('children', '>=', $request->children);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }

        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        if ($request->filled('rating_min')) {
            $query->where('rating', '>=', $request->rating_min);
        }

        if ($request->filled('rating_max')) {
            $query->where('rating', '<=', $request->rating_max);
        }

        if ($request->filled('transport')) {
            $query->where('transport', $request->transport);
        }

        if ($request->filled('services')) {
            foreach ($request->services as $service) {
                $query->whereJsonContains('services', $service);
            }
        }

        $tours = $query->get();

        return view('tours.index', compact('tours'));
    }

    /**
     * Показати конкретний тур в адмінці (можна доробити за потреби).
     */
    public function show(Tour $tour)
    {
        $tour->load('images', 'category', 'city', 'tags');
        return view('public.tours.show', compact('tour'));
    }

    /**
     * Показати форму редагування туру.
     */
    public function edit(Tour $tour)
    {
        return view('admin.tours.edit', compact('tour'));
    }

    /**
     * Оновити тур.
     */
    public function update(Request $request, Tour $tour)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'location' => 'required|string|max:255',
        ]);

        $tour->update($request->all());

        return redirect()->route('tours.index')->with('success', 'Тур оновлено!');
    }

    /**
     * Видалити тур.
     */
    public function destroy(Tour $tour)
    {
        $tour->delete();
        return redirect()->route('admin.tours.index')->with('success', 'Тур видалено!');
    }
}
