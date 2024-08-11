<?php

namespace Daugt\Livewire\Shop;

use Livewire\Component;
use Livewire\WithPagination;
use Daugt\Models\Shop\Order;
use Daugt\Models\User;

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
        if($this->user->exists) {
            $query = $query->where('user_id', $this->user->id);
        }
        return view('daugt::livewire.shop.order-list', [
            'orders' => $query->paginate(50),
        ]);
    }
}
