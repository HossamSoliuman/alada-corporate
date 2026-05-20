<?php

namespace App\Services;

use App\Mail\LeadConfirmation;
use App\Mail\NewLeadNotification;
use App\Models\Lead;
use Illuminate\Support\Facades\Mail;

class LeadService
{
    public function create(array $data, string $type = 'contact'): Lead
    {
        $lead = Lead::create([
            ...$data,
            'form_type'  => $type,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'source_url' => url()->previous(),
            'status'     => 'new',
        ]);

        $adminEmail = config('mail.admin_address', env('MAIL_ADMIN_ADDRESS'));

        try {
            Mail::to($adminEmail)->queue(new NewLeadNotification($lead));
            Mail::to($lead->email)->queue(new LeadConfirmation($lead));
        } catch (\Exception $e) {
            \Log::error('Lead mail failed: ' . $e->getMessage());
        }

        return $lead;
    }
}
