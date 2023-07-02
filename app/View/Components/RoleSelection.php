<?php

namespace App\View\Components;

use App\Models\User;
use Illuminate\View\Component;
use Spatie\Permission\Models\Role;

class RoleSelection extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $roles;
    public $user;

    public function __construct(User $user = null)
    {
        if (!$user) {
            $this->user = new User();
        }else{

            $this->user = $user;
        }
        $this->roles = Role::get();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.role-selection');
    }
}
