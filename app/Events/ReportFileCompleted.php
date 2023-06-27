<?php

namespace App\Events;

use App\Models\ReportFile;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ReportFileCompleted implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public ReportFile $report_file;

    public string $message = '';

    public string $title = '';

    public string $action_title = '';

    public string $action_url = '';

    /**
     * Create a new event instance.
     */
    public function __construct(ReportFile $report_file)
    {
        $this->report_file = $report_file;

        $this->title = __('Report file exported');

        $this->message = __('Your report file of report ":report_name" was done exported', [
            'report_name' => $this->report_file->report->title,
        ]);

        $this->action_title = __('Download');

        $this->action_url = route('reports.report-files.show', [
            'report' => $this->report_file->report->id, 
            'report_file' => $this->report_file->id
        ]);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [new PrivateChannel('App.Models.User.'.$this->report_file->creator->id)];
    }
}