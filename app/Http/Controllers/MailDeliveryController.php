<?php

namespace App\Http\Controllers;

use App\Models\MailDelivery;
use Illuminate\Http\Request;

class MailDeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('mail-deliveries.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mail-deliveries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
        ]);

        $mail_delivery = MailDelivery::factory()->create($validated);

        session()->flash('message', __('Successfully created'));

        return redirect()->route('mail-deliveries.show', ['mail_delivery' => $mail_delivery->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(MailDelivery $mail_delivery)
    {
        return view('mail-deliveries.show', compact('mail_delivery'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MailDelivery $mail_delivery)
    {
        return view('mail-deliveries.edit', compact('mail_delivery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MailDelivery $mail_delivery)
    {
        $validated = $request->validate([
            'title' => 'required|string',
        ]);

        $mail_delivery->title = $validated['title'];

        $mail_delivery->save();

        session()->flash('message', __('Successfully updated'));

        return redirect()->route('mail-deliveries.show', ['mail_delivery' => $mail_delivery->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MailDelivery $mail_delivery)
    {
        $mail_delivery->forceDelete();

        session()->flash('message', __('Successfully deleted'));

        return redirect()->route('mail-deliveries.index');
    }
}
