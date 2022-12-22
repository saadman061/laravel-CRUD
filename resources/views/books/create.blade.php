@extends('layouts.app')
@section('title', 'Add New Book')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Add New Book') }}
                    <div style="float: right;"><a class="btn btn-primary" href="{{ route('books.index') }}">View All</a></div>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('books.store') }}">
                        @csrf

                        <div class="row mb-3 py-4">
                            <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

                            <div class="col-md-4">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" required >

                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 py-4">
                            <label for="author" class="col-md-4 col-form-label text-md-end">{{ __('Author') }}</label>

                            <div class="col-md-4">
                                <input id="author" type="text" class="form-control @error('author') is-invalid @enderror" name="author" required >

                                @error('author')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 py-4">
                            <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Status') }}</label>

                            <div class="col-md-4">
                                <select id="status" class="form-control @error('status') is-invalid @enderror" name="status" required>
                                    <option value=""></option>
                                    <option value="Available">Available</option>
                                    <option value="Not available">Not available</option>
                                </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection