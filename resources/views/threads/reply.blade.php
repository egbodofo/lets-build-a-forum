<reply :data="{{ $reply}}" inline-template v-cloak>
    <div id="reply-{{ $reply->id }}" class="card">
        <div class="card-header">
            <div class="level">
                <div class="flex">
                    <a href="{{ route('profile', $reply->owner) }}">
                        {{ $reply->owner->name }}
                    </a> said {{ $reply->created_at->diffForHumans() }}...
                </div>

                @if (Auth::check())
                    <div>
                        <favorite :reply="{{ $reply }}"></favorite>
                    </div>
                @endif
            </div>
        </div>

        <div class="card-body">
            <div v-if="editing">
                <div class="form-group">
                    <textarea class="form-control" v-model="body"></textarea>
                </div>

                <button class="btn btn-sm btn-primary" @click="update"><span class="fa fa-edit"></span> Update</button>
                <button class="btn btn-sm btn-secondary" @click="editing = false"><span class="fa fa-window-close"></span> Cancel</button>
            </div>

            <div v-else v-text="body"></div>
        </div>

        @can('update', $reply)
            <div class="card-footer level">
                <button class="btn btn-info btn-sm mr-2" @click="editing = true"><span class="fa fa-user-edit"></span> Edit</button>
                <button class="btn btn-danger btn-sm" @click="destroy"><span class="fa fa-trash"></span> Delete</button>
            </div>
        @endcan

    </div>
</reply>
