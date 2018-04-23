@extends('layouts.app')
@section('content')
<div class="container">
 <div class="row">
     <h1>Submit a link</h1>
     <form action="/submit" method="post">

        // we have a blade conditional 
        //that checks to see if there are any validation errors. 
        //When errors exist, the bootstrap alert message will be shown, 
        //prompting the user to fix the invalid form field
    @if($errors->any())
    <div class="alert alert-danger" role="alert">
    Please fix the following errors
    </div>
    @endif

    {!! csrf_field() !!}
    {{-- Each individual form field checks for validation errors 
        //and displays an error message and outputs a has-error class: --}}
    <div class="form-group{{ $errors->has('title') ? 'has-error' : '' }}">
      <label for="title">Title</label>

      {{-- title --}}
      <input type="text" class="form-control" id="title" name="title"
      placeholder="Title " value="{{ old('title') }}"/>

     // If the user submits invalid data, the route will store validation in the session 
     //and redirect the user back to the form. The {{ old('title') }} function will populate
     // the originally submitted data. If a user forgot to submit one of the fields, 
     //the other fields that have data would be populated after validation fails and errors 
     //are shown.

      @if($errors->has('title'))
      {{-- If a field has an error, the first() method returns the first error for a given field: --}}
      <span class="help-block">{{ $errors-> first('title') }}</span>
      @endif
    </div>
{{-- url --}}
    <div class="form-group{{ $errors->has('url') ? 'has-error' : '' }}">
        <label for="url"> Url</label>
        <input type="text" class="form-control" id="url" name="url" placeholder="URL"
        placeholder="URL" value="{{ old('url') }}" />
        @if($errors->has('url'))
        <span class="help-block">{{ $errors-> first('url')  }}</span>
        @endif
    </div>
{{-- description --}}
    <div class="form-group{{ $errors->has('description') ? 'has-error' : '' }}">
        <label for="description"> Description</label>
        <textarea class="form-control" id="description" name="description"
        placeholder="Description" value="{{ old('description') }}"></textarea>
        @if($errors->has('description'))
        {{-- If a field has an error, the first() method returns the first error for a given field: --}}
        <span class="help-block">{{ $errors-> first('description') }}</span>
        @endif
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
     </form>
 </div>
</div>
@endsection