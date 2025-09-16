<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class notifications extends Component
{
    public $pendingCount;
    public $pendingAppointmentCount;
    public $notifications;
    /**
     * Create a new component instance.
     */
     public function __construct($pendingCount = 0, $pendingAppointmentCount = 0, $notifications = [])
    {
        $this->pendingCount = $pendingCount;
        $this->pendingAppointmentCount = $pendingAppointmentCount;
        $this->notifications = $notifications;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.notifications');
    }
}
