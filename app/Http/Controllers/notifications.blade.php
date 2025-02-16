@extends('layouts.app')

@section('content')
<body>

    <div class="container">
        <h2>Notifications</h2>
 
        <form action="{{ route('read.all') }}" method="POST" class="text-end mb-3">
            @csrf
            <button type="submit" class="btn btn-sm btn-success">Read All</button>
        </form>

        <div class="mb-3">
            <h4>New Notifications</h4>
            @forelse ($notifications->where('read_at', null) as $notification)
                <div class="alert alert-info">
                    <p>{{ $notification->data['message'] }}</p>
                    <small>DATA: {{ $notification->created_at->format('d-m-Y H:i') }}</small>
                    
                </div>
            @empty
                <p>No new notifications</p>
            @endforelse
        </div>




        <div class="mb-3">
            <h4>Readed Notifications</h4>
            @forelse ($notifications->whereNotNull('read_at') as $notification)
                <div class="alert alert-secondary">
                    <p>{{ $notification->data['message'] }}</p>
                </div>
            @empty
                <p>No readed notifications</p>
            @endforelse
        </div>

        
    </div>
        
</body>
@endsection
