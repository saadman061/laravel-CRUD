@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Users') }}</div>

                <div class="card-body">
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
                                <th scope="col" class="text-center">Username</th>
                                <th scope="col" class="text-center">Email</th>                
                                <th scope="col" class="text-center">Action</th>
                              </tr>
                            </thead>
                            <tbody>
                              @php
                              $i = 1
                              @endphp
                              @if( $users )
                              @foreach($users  as $u )
                                <tr>
                                  <th scope="row"> {{$i++}}</th>
                                  <td class="text-center">{{$u->name}}</td>
                                  <td class="text-center">{{$u->email}}</td>
                                  <td class="text-center">
                                    <div >
                                      <a type="button" class="btn btn-outline-secondary" href="{{ route('users-edit',['id' => $u->id]) }}">Edit</a>
                                      <a type="button" class="btn btn-outline-danger" href="{{ url('user/'.$u->id.'/delete') }}" onclick="return confirm('Are you sure to delete this record?')" >Delete</a>
                                    </div>
                                  </td>
                                </tr>
                              @endforeach
                              @endif
                              
                              
                            </tbody>
                          </table>
                            @if ($users->hasPages() > 0)
                              <nav aria-label="Page navigation example">
                                <ul class="pagination justify-content-center">
                                  <li class="page-item {{$users->previousPageUrl() ? '' : 'disabled' }}" >
                                    <a class="page-link" href="{{ $users->previousPageUrl() }}" tabindex="-1">Previous</a>
                                  </li>
                                  <li class="page-item"><a class="page-link" href="{{$users->url(1)}}">1</a></li>
                                  <li class="page-item"><a class="page-link" href="{{$users->url(2)}}">2</a></li>
                                  <li class="page-item"><a class="page-link" href="{{$users->url(3)}}">3</a></li>
                                  <li class="page-item">
                                    <a class="page-link {{$users->nextPageUrl() ? '' : 'disabled' }}" href="{{$users->nextPageUrl()}}">Next</a>
                                  </li>
                                </ul>
                              </nav>
                            @endif
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
