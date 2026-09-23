<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Tampilkan semua video
     */
    public function index()
    {
        $videos = Video::latest()->paginate(10);
        return view('admin.videos.index', compact('videos'));
    }

    /**
     * Form tambah video
     */
    public function create()
    {
        return view('admin.videos.create');
    }

    /**
     * Simpan video baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'link'    => 'required|url',
            'description' => 'nullable|string',
        ]);

        Video::create([
            'title'       => $request->title,
            'link'        => $request->link,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.videos.index')
                         ->with('success', 'Video berhasil ditambahkan.');
    }

    /**
     * Form edit video
     */
    public function edit(Video $video)
    {
        return view('admin.videos.edit', compact('video'));
    }

    /**
     * Update video
     */
    public function update(Request $request, Video $video)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'link'    => 'required|url',
            'description' => 'nullable|string',
        ]);

        $video->update([
            'title'       => $request->title,
            'link'        => $request->link,
            'description' => $request->description,
        ]);

        return redirect()->route('admin.videos.index')
                         ->with('success', 'Video berhasil diperbarui.');
    }

    /**
     * Hapus video
     */
    public function destroy(Video $video)
    {
        $video->delete();

        return redirect()->route('admin.videos.index')
                         ->with('success', 'Video berhasil dihapus.');
    }
}
