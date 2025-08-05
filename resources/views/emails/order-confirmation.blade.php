@extends('emails.layouts.app')

@section('content')
    <h2>Order Confirmation</h2>
    
    <p>Hi {{ $name ?? 'there' }},</p>
    
    <p>Thank you for your order! We've received your order and it's being processed. Here are the details:</p>
    
    <div style="background-color: #f8f9fa; border: 1px solid #e9ecef; border-radius: 5px; padding: 20px; margin: 20px 0;">
        <h3 style="margin: 0 0 15px 0; color: #333333;">Order Information</h3>
        
        <table style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="padding: 8px 0; border-bottom: 1px solid #e9ecef; font-weight: 600; color: #333333;">Order Number:</td>
                <td style="padding: 8px 0; border-bottom: 1px solid #e9ecef; color: #666666;">{{ $orderNumber ?? 'N/A' }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; border-bottom: 1px solid #e9ecef; font-weight: 600; color: #333333;">Order Date:</td>
                <td style="padding: 8px 0; border-bottom: 1px solid #e9ecef; color: #666666;">{{ $orderDate ?? date('F j, Y') }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; border-bottom: 1px solid #e9ecef; font-weight: 600; color: #333333;">Total Amount:</td>
                <td style="padding: 8px 0; border-bottom: 1px solid #e9ecef; color: #666666; font-weight: 600;">{{ $totalAmount ?? '$0.00' }}</td>
            </tr>
            <tr>
                <td style="padding: 8px 0; font-weight: 600; color: #333333;">Status:</td>
                <td style="padding: 8px 0; color: #28a745; font-weight: 600;">{{ $status ?? 'Confirmed' }}</td>
            </tr>
        </table>
    </div>
    
    @if(isset($items) && count($items) > 0)
    <div style="margin: 20px 0;">
        <h3 style="color: #333333; margin-bottom: 15px;">Order Items</h3>
        
        @foreach($items as $item)
        <div style="border: 1px solid #e9ecef; border-radius: 5px; padding: 15px; margin-bottom: 10px; background-color: #ffffff;">
            <div style="display: flex; justify-content: space-between; align-items: center;">
                <div>
                    <h4 style="margin: 0 0 5px 0; color: #333333;">{{ $item['name'] ?? 'Product Name' }}</h4>
                    <p style="margin: 0; color: #666666; font-size: 14px;">Quantity: {{ $item['quantity'] ?? 1 }}</p>
                </div>
                <div style="text-align: right;">
                    <p style="margin: 0; color: #333333; font-weight: 600;">{{ $item['price'] ?? '$0.00' }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif
    
    @if(isset($shippingAddress))
    <div style="background-color: #f8f9fa; border: 1px solid #e9ecef; border-radius: 5px; padding: 20px; margin: 20px 0;">
        <h3 style="margin: 0 0 15px 0; color: #333333;">Shipping Address</h3>
        <p style="margin: 0; color: #666666; line-height: 1.6;">{{ $shippingAddress }}</p>
    </div>
    @endif
    
    @if(isset($trackingUrl))
    <p>Track your order:</p>
    
    <div style="text-align: center; margin: 30px 0;">
        <a href="{{ $trackingUrl }}" class="btn">Track Order</a>
    </div>
    @endif
    
    @if(isset($orderUrl))
    <p>View your order details:</p>
    
    <div style="text-align: center; margin: 30px 0;">
        <a href="{{ $orderUrl }}" class="btn">View Order</a>
    </div>
    @endif
    
    <p>We'll send you another email when your order ships with tracking information.</p>
    
    <p>If you have any questions about your order, please contact our customer support team.</p>
    
    <p>Thank you for choosing {{ config('app.name') }}!</p>
    
    <p>Best regards,<br>
    The {{ config('app.name') }} Team</p>
@endsection 