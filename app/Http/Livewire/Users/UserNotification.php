<?php

namespace App\Http\Livewire\Users;

use Livewire\Component;

class UserNotification extends Component
{
    public bool $show = false;

    public array $messages = [];

    public function getListeners()
    {
        if (! auth()->check()) {
            return [];
        }

        return [
            'echo-private:App.Models.User.'.auth()->user()->id.',ReportFileCompleted' => 'notify',
        ];
    }

    public function notify($event)
    {
        $event = (object) $event;

        $this->show = true;

        $this->messages[] = [
            'title' => $event->title,
            'message' => $event->message,
            'action_title' => $event->action_title,
            'action_url' => $event->action_url,
        ];
    }

    public function dismissNotify(int $index)
    {
        array_splice($this->messages, $index, 1);

        if (count($this->messages) == 0) {
            $this->show = false;
        }
    }

    public function render()
    {
        return view('livewire.users.user-notification');
    }
}
