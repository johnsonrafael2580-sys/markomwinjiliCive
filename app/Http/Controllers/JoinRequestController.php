<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class JoinRequestController extends Controller
{
    /**
     * Store a join request
     */
    public function store(Request $request)
    {
        // 1. Validation Rules
        $rules = [
            'name'      => 'required|string|max:191',
            'phone'     => 'required|string|max:50',
            'programme' => 'required|string|max:191',
            'email'     => 'required|email|max:191',
            'voice'     => 'required|string|max:50',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->to(url()->previous() . '#jiunge')
                ->withErrors($validator)
                ->withInput();
        }

        $data = $validator->validated();

        // 2. Logging Debug (Kwa ajili ya kuona makosa online)
        try {
            $logLine = '[' . now()->toDateTimeString() . '] REQUEST: ' . $request->ip() . ' ' . json_encode($data) . PHP_EOL;
            file_put_contents(public_path('join_debug.log'), $logLine, FILE_APPEND | LOCK_EX);
        } catch (\Throwable $e) {
            // Ignore logging errors
        }

        // 3. Persist to Database (With trimmed inputs for safety)
        try {
            DB::table('join_requests')->insert([
                'name'       => trim($data['name']),
                'phone'      => trim($data['phone']),
                'programme'  => trim($data['programme']),
                'email'      => strtolower(trim($data['email'])),
                'voice'      => $data['voice'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Success Logging
            file_put_contents(public_path('join_debug.log'), "[" . now() . "] DB OK" . PHP_EOL, FILE_APPEND);

        } catch (\Throwable $e) {
            // Log the actual error to the file so you can read it online
            file_put_contents(public_path('join_debug.log'), "[" . now() . "] DB ERROR: " . $e->getMessage() . PHP_EOL, FILE_APPEND);
            
            return redirect()->to(url()->previous() . '#jiunge')
                ->with('error', 'Database connection failed. Check join_debug.log');
        }

        // 4. Session flash kwa ajili ya welcome.blade.php
        session()->flash('joined', true);

        // 5. Redirect back to anchor
        return redirect()->to(url()->previous() . '#jiunge');
    }
}