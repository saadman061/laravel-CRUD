@extends('layouts.app')
@section('title', 'View All Books')
@section('customJavascript')
<script>
  // @if(Session::has('response'))
  //       toastr.options =
  //       {
  //           "closeButton" : true,
  //           "progressBar" : true
  //       }
  //       toastr.success("{{ Session::get('response') }}");
  //   @endif
	</script>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Book List') }}
                  <div style="float: right;"><a class="btn btn-primary" href="{{ route('books.create') }}">Create</a></div>
                </div>

                {{-- Messge  --}}
                <div>
                  @if(session('response'))
                    <span style="color: green;font-weight:100;" class="px-4">  {{ session('response') }} </span>
                  @endif
                </div>

                <div class="px-4 py-4">
                <table class="table table-hover">                 
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col" class="text-center">Title</th>
                        <th scope="col" class="text-center">Author</th>
                        <th scope="col" class="text-center">Status</th>
                        <th scope="col" class="text-center">Check Out By</th>
                        <th scope="col" class="text-center">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @php
                      $i = 1
                      @endphp
                      @if( $books )
                      @foreach($books  as $b )
                        <tr>
                          <th scope="row"> {{$i++}}</th>
                          <td class="text-center">{{$b->title}}</td>
                          <td class="text-center">{{$b->author}}</td>
                          <td class="text-center">{{$b->status}}</td>
                          <td class="text-center">{{$b->name}}</td>
                          <td class="text-center">
                            <div >
                              <a type="button" class="btn btn-outline-secondary" href="{{ route('books.edit',['book' => $b->id]) }}">Edit</a>
                              <a type="button" class="btn btn-outline-danger" href="{{ url('books/'.$b->id.'/delete') }}" onclick="return confirm('Are you sure to delete this record?')" >Delete</a>
                              </div>
                          </td>
                        </tr>
                      @endforeach
                      @endif
                      
                      
                    </tbody>
                  </table>
                    @if ($books->hasPages() > 0)
                      <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">
                          <li class="page-item {{$books->previousPageUrl() ? '' : 'disabled' }}" >
                            <a class="page-link" href="{{ $books->previousPageUrl() }}" tabindex="-1">Previous</a>
                          </li>
                          <li class="page-item"><a class="page-link" href="{{$books->url(1)}}">1</a></li>
                          <li class="page-item"><a class="page-link" href="{{$books->url(2)}}">2</a></li>
                          <li class="page-item"><a class="page-link" href="{{$books->url(3)}}">3</a></li>
                          <li class="page-item">
                            <a class="page-link {{$books->nextPageUrl() ? '' : 'disabled' }}" href="{{$books->nextPageUrl()}}">Next</a>
                          </li>
                        </ul>
                      </nav>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
