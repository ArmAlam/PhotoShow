@if ( count($errors) > 0 )
  @foreach ($errors->all() as $error)
      <div class="collout alert">
          {{ $error}}
      </div>
  @endforeach
@endif
    
@if ( session('success'))
  <div class="callout success">
      {{ session('success')}}
  </div>
@endif


@if ( session('error'))
<div class="callout alert">
    {{ session('error') }}
</div>
@endif