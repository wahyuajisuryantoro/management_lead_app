<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class LeadsController extends Controller
{
    public function index()
    {
        $leads = Lead::orderBy('created_at', 'desc')->get();
        return view('pages.leads.index', compact('leads'));
    }

    public function create()
    {
        return view('pages.leads.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:leads,email',
            'phone' => 'required|string|unique:leads,phone',
            'product_interest' => 'required|string|max:255',
        ]);
        Lead::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'product_interest' => $validated['product_interest'],
            'status' => 'New',
            'score' => 0,
        ]);

        return redirect()
            ->route('index')
            ->with('success', 'Lead berhasil ditambahkan!');
    }

    public function edit(Lead $lead)
    {
        return view('pages.leads.edit', compact('lead'));
    }

    public function update(Request $request, Lead $lead)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:leads,email,' . $lead->id,
            'phone' => 'required|string|unique:leads,phone,' . $lead->id,
            'product_interest' => 'required|string|max:255',
        ]);
        $lead->update($validated);
        return redirect()
            ->route('index')
            ->with('success', 'Lead berhasil diperbarui!');
    }

    public function followUp(Lead $lead)
    {
        if ($lead->status !== Lead::STATUS_NEW) {
            return redirect()->back()->with('error', 'Lead sudah diproses.');
        }

        $lead->update([
            'status' => Lead::STATUS_PROCESSING,
            'score' => $lead->score + 20,
        ]);

        return redirect()->back()->with('success', 'Lead berhasil di Follow Up.');
    }

    public function deal(Lead $lead)
    {
        if ($lead->status !== Lead::STATUS_PROCESSING || $lead->score < 20) {
            return redirect()->back()->with('error', 'Lead belum memenuhi syarat Deal.');
        }

        $lead->update([
            'status' => Lead::STATUS_CLOSED,
            'score' => 100,
        ]);

        return redirect()->back()->with('success', 'Lead berhasil Closed Deal 🎉');
    }

    public function destroy(Lead $lead)
    {
        $lead->delete();

        return redirect()->route('index')
            ->with('success', 'Lead berhasil dihapus.');
    }

}
