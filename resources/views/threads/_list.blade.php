@forelse ($threads as $thread)
    <div style="box-shadow: -2px 0px 19px -2px rgba(97,90,97,1); margin-bottom: 20px; border-radius: 10px;">
        <div class="card-header">
            <div class="level">
                <div class="flex">
                    <h4>
                        <a href="{{ $thread->path() }}">
                            @if (auth()->check() && $thread->hasUpdatesFor(auth()->user()))
                                <strong>
                                    {{ $thread->title }}
                                </strong>
                            @else
                                {{ $thread->title }}
                            @endif
                        </a>
                    </h4>

                    <h5>
                        Posted By: <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a>
                    </h5>
                </div>

                <a href="{{ $thread->path() }}" class="pb-1">
                    {{ $thread->replies_count }} {{ Str::plural('reply', $thread->replies_count) }}
                </a>
            </div>
        </div>

        <div class="card-body">
            <div>{{ $thread->body }}</div>
        </div>

        <div class="card-footer">
            {{ $thread->visits }} visits
        </div>
    </div>
@empty
    <p>There are no relevant results at this time.</p>
@endforelse
