<?php

namespace Examples\MailClasses;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $orderNumber;
    public $orderDate;
    public $totalAmount;
    public $status;
    public $items;
    public $shippingAddress;
    public $trackingUrl;
    public $orderUrl;

    /**
     * Create a new message instance.
     */
    public function __construct($name = null, $orderNumber = null, $totalAmount = null, $items = [])
    {
        $this->name = $name;
        $this->orderNumber = $orderNumber;
        $this->orderDate = date('F j, Y');
        $this->totalAmount = $totalAmount;
        $this->status = 'Confirmed';
        $this->items = $items;
    }

    /**
     * Set shipping address.
     */
    public function setShippingAddress($address)
    {
        $this->shippingAddress = $address;
        return $this;
    }

    /**
     * Set tracking URL.
     */
    public function setTrackingUrl($url)
    {
        $this->trackingUrl = $url;
        return $this;
    }

    /**
     * Set order URL.
     */
    public function setOrderUrl($url)
    {
        $this->orderUrl = $url;
        return $this;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Order Confirmation - ' . config('app.name'))
                    ->view('emails.order-confirmation')
                    ->with([
                        'name' => $this->name,
                        'orderNumber' => $this->orderNumber,
                        'orderDate' => $this->orderDate,
                        'totalAmount' => $this->totalAmount,
                        'status' => $this->status,
                        'items' => $this->items,
                        'shippingAddress' => $this->shippingAddress,
                        'trackingUrl' => $this->trackingUrl,
                        'orderUrl' => $this->orderUrl,
                    ]);
    }
} 