@extends('layouts.main')

@section('content')

<div class="row">

    <div class="col-lg-12 mb-4">

        <div class="card">
            <div class="card-body">

                <div class="d-flex justify-content-between align-items-center mb-4">

                    <div>
                        <h4 class="mb-1">Live Chat Service</h4>
                        <p class="text-muted mb-0">
                            List customer live chat
                        </p>
                    </div>

                    <span class="badge bg-primary">
                        {{ $sessions->count() }} Chat
                    </span>

                </div>

                <div class="row">

                    @forelse($sessions as $session)

                        @php

                            if($session->status == 'waiting') {

                                $badge = 'warning';

                            } elseif($session->status == 'active') {

                                $badge = 'success';

                            } else {

                                $badge = 'secondary';

                            }

                        @endphp

                        <div class="col-md-6 col-lg-4 mb-3">

                            <div class="card border shadow-none h-100">

                                <div class="card-body">

                                    <div class="d-flex justify-content-between align-items-start">

                                        <div>

                                            <h6 class="mb-1">
                                                {{ $session->customer->name }}
                                            </h6>

                                            <small class="text-muted">
                                                {{ $session->customer->email }}
                                            </small>

                                        </div>

                                        <span class="badge bg-{{ $badge }} small text-uppercase">
                                            {{ $session->status }}
                                        </span>

                                    </div>

                                    <hr>

                                    <div class="mb-2">

                                        <small class="text-muted d-block">
                                            Queue Time
                                        </small>

                                        <small class="fw-semibold">
                                            {{ \Carbon\Carbon::parse($session->queue_start)->diffForHumans() }}
                                        </small>

                                    </div>

                                    @if($session->agent)

                                        <div class="mb-3">

                                            <small class="text-muted d-block">
                                                Agent
                                            </small>

                                            <small class="fw-semibold">
                                                {{ $session->agent->name }}
                                            </small>

                                        </div>

                                    @endif

                                    <div class="d-grid">

                                        <a href="{{ route('chat.livechat.show', $session->id) }}" class="btn btn-sm btn-primary">
                                            Open Chat
                                        </a>

                                    </div>

                                </div>

                            </div>

                        </div>

                    @empty

                        <div class="col-12">

                            <div class="alert alert-info mb-0">
                                Tidak ada data live chat.
                            </div>

                        </div>

                    @endforelse

                </div>

            </div>
        </div>

    </div>

</div>

@endsection