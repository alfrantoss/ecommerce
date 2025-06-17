@extends('layouts.app')
@section('content')
<div class="container py-5" style="margin: auto;">
    <div class="card shadow-sm mb-3" style="max-width: 500px; width: 100%;">
        <div class="card-body text-center">
            <h4 class="mb-2">Pembayaran Order</h4>
            <div class="mb-2">Order Code: <b class="text-danger">{{ $order->order_code }}</b></div>
            <div class="mb-2">Total: <b>Rp{{ number_format($order->total,0,',','.') }}</b></div>
            <button id="pay-button" class="btn btn-success mt-3 w-100">Bayar Sekarang</button>
        </div>
    </div>
    <div class="card shadow-sm" style="max-width: 500px; width: 100%;">
        <div class="card-body">
            <h5 class="mb-3">Detail Pesanan</h5>
            <ul class="list-group list-group-flush">
                @foreach($orderDetail as $item)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>{{ $item->title }} <span class="badge bg-secondary ms-2">x{{ $item->quantity }}</span></span>
                        <span>Rp{{ number_format($item->price,0,',','.') }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.clientKey') }}"></script>
<script type="text/javascript">
    document.getElementById('pay-button').onclick = function(){
        window.snap.pay("{{ $order->snap }}", {
            onSuccess: function(result){
                window.location.href = "{{ route('clientOrderCode', $order->order_code) }}";
            },
            onPending: function(result){
                window.location.href = "{{ route('clientOrderCode', $order->order_code) }}";
            },
            onError: function(result){
                alert('Pembayaran gagal!');
            }
        });
    }
</script>
@endsection

<!-- Di bagian head layout -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Di bagian sebelum closing body -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>