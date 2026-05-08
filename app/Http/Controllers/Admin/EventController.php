<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Carbon\Carbon;

class EventController extends Controller
{
    // ================= FUNGSI WEB =================
    public function index() {
        $events = Event::orderBy('event_date', 'asc')->get();
        return view('admin.event.index', compact('events'));
    }

    public function kegiatanIndex() {
        $allEvents = Event::orderBy('event_date', 'asc')->get();
        $upcomingEvents = Event::where('event_date', '>=', Carbon::today())
            ->orderBy('event_date', 'asc')
            ->get();
        return view('admin.kegiatan', compact('allEvents', 'upcomingEvents'));
    }

    public function store(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
        ]);
        
        Event::create($request->all());
        return back()->with('success', 'Event berhasil ditambahkan!');
    }

    // Tambahkan fungsi update ini
    public function update(Request $request, $id) {
        $request->validate([
            'title' => 'required|string|max:255',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
        ]);

        $event = Event::findOrFail($id);
        $event->update($request->all());
        
        return back()->with('success', 'Event berhasil diupdate!');
    }

    public function destroy($id) {
        Event::findOrFail($id)->delete();
        return back()->with('success', 'Event dihapus!');
    }

    // ================= FUNGSI API =================
    public function indexApi() {
        return response()->json(['status' => 'success', 'data' => Event::orderBy('event_date', 'asc')->get()], 200);
    }

    public function storeApi(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
        ]);
        $event = Event::create($request->all());
        return response()->json(['status' => 'success', 'message' => 'Event ditambahkan!', 'data' => $event], 201);
    }

    public function destroyApi($id) {
        $event = Event::find($id);
        if(!$event) return response()->json(['status' => 'error', 'message' => 'Not found'], 404);
        $event->delete();
        return response()->json(['status' => 'success', 'message' => 'Event dihapus!'], 200);
    }
}