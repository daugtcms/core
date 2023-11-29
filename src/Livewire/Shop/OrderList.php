<?php

namespace Sitebrew\Livewire\Shop;

use Livewire\Component;
use Livewire\WithPagination;
use Sitebrew\Models\Shop\Order;
use Sitebrew\Models\User;

class OrderList extends Component
{
    use WithPagination;

    public $user;

    public function mount(User $user = null)
    {
        $this->user = $user;
    }

    public function render()
    {
        $query = Order::with('items')->orderBy('created_at', 'desc');
        if(empty($this->user)) {
            $query = $query->where('user_id', $this->user->id);
        }
        return view('sitebrew::livewire.shop.order-list', [
            'orders' => $query->paginate(50),
        ]);
    }
}
