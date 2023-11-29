<?php

namespace Sitebrew\Livewire\Shop;

use Livewire\Attributes\On;
use Sitebrew\Enums\Blocks\TemplateUsage;
use Sitebrew\Injectable\StripeClient;
use Sitebrew\Models\Shop\Order;
use WireElements\Pro\Components\Modal\Modal;

class EditOrder extends Modal
{
    public int|Order $order;

    public bool $editable = false;

    public string $status = 'pending';

    public function mount(Order $order = null)
    {
        $this->order = $order;

        $this->status = $order->status;
    }

    public function render()
    {
        $this->editable = request()->user()->can('edit orders');
        $invoice = collect();
        if($this->order->stripe_invoice_id){
            $stripe = StripeClient::init();
            $invoice = $stripe->invoices->retrieve($this->order->stripe_invoice_id);
            $invoice = collect($invoice);
        }
        return view('sitebrew::livewire.shop.edit-order', [
            'invoice' => $invoice->only(['hosted_invoice_url', 'number', 'total', 'customer_address', 'customer_name', 'shipping_details'])
        ]);
    }

    public static function attributes(): array
    {
        return [
            'size' => 'xl',
        ];
    }

    public function updatedStatus() {
        if(request()->user()->can('edit orders')) {
            $this->order->status = $this->status;
            $this->order->save();
        }
    }

}
