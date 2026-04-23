<?php

namespace App\Http\Controllers;

use App\Models\ContentItem;
use Illuminate\Http\Request;

class AdminContentController extends Controller
{
    private function requireAdmin()
    {
        if (!session()->has('admin')) {
            return redirect('/admin');
        }
        return null;
    }

    public function index(Request $request)
    {
        if ($redirect = $this->requireAdmin()) return $redirect;

        $type = $request->query('type', 'service');
        $items = ContentItem::query()
            ->where('type', $type)
            ->orderBy('sort_order')
            ->orderByDesc('id')
            ->get();

        $types = ['service', 'project', 'testimonial', 'plan', 'faq', 'post'];
        return view('admin.content.index', compact('items', 'type', 'types'));
    }

    public function create(Request $request)
    {
        if ($redirect = $this->requireAdmin()) return $redirect;
        $type = $request->query('type', 'service');
        return view('admin.content.form', ['type' => $type, 'item' => new ContentItem(['type' => $type])]);
    }

    public function store(Request $request)
    {
        if ($redirect = $this->requireAdmin()) return $redirect;

        $data = $request->validate([
            'type' => 'required|in:service,project,testimonial,plan,faq,post',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'body' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0|max:999999',
            'is_published' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,avif|max:4096',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('content', 'public');
        }

        ContentItem::create([
            'type' => $data['type'],
            'title' => $data['title'] ?? null,
            'subtitle' => $data['subtitle'] ?? null,
            'body' => $data['body'] ?? null,
            'image' => $imagePath,
            'sort_order' => (int) ($data['sort_order'] ?? 0),
            'is_published' => (bool) ($data['is_published'] ?? true),
        ]);

        return redirect('/admin/content?type=' . $data['type'])->with('success', 'Content saved');
    }

    public function edit($id)
    {
        if ($redirect = $this->requireAdmin()) return $redirect;
        $item = ContentItem::findOrFail($id);
        return view('admin.content.form', ['type' => $item->type, 'item' => $item]);
    }

    public function update(Request $request, $id)
    {
        if ($redirect = $this->requireAdmin()) return $redirect;

        $item = ContentItem::findOrFail($id);
        $data = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'body' => 'nullable|string',
            'sort_order' => 'nullable|integer|min:0|max:999999',
            'is_published' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp,avif|max:4096',
        ]);

        if ($request->hasFile('image')) {
            $item->image = $request->file('image')->store('content', 'public');
        }

        $item->title = $data['title'] ?? null;
        $item->subtitle = $data['subtitle'] ?? null;
        $item->body = $data['body'] ?? null;
        $item->sort_order = (int) ($data['sort_order'] ?? 0);
        $item->is_published = (bool) ($data['is_published'] ?? true);
        $item->save();

        return redirect('/admin/content?type=' . $item->type)->with('success', 'Content updated');
    }

    public function delete($id)
    {
        if ($redirect = $this->requireAdmin()) return $redirect;

        $item = ContentItem::findOrFail($id);
        $type = $item->type;
        $item->delete();
        return redirect('/admin/content?type=' . $type)->with('success', 'Content deleted');
    }
}

