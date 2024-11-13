@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

{{-- or --}}

@if ($errors->has('first_name'))
    <span class="errormsg text-danger">{{ $errors->first('first_name') }}</span>
@endif


@error('first_name')
<span class="text-tiny+ text-error">{{$message}}</span>
@enderror
