@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Build Pages</div>
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif
                    <div class="panel-body">
                        <a href="{{ url('/buildpages/create') }}" class="btn btn-success btn-sm" title="Add New Device">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>

                        {!! Form::open(['method' => 'GET', 'url' => '/buildpages', 'class' => 'navbar-form navbar-right', 'role' => 'search'])  !!}
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                    search<i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        {!! Form::close() !!}

                        <br/>
                        <br/>
                        <div class="">
                            <table class="table table-borderless" style="width: 1073px;">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>About page</th>
                                        <th>Facebook page url</th>
                                        <th>Youtube page url</th>
                                        <th>Instagram page url</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($user_page as $item)
                                    <tr>
                                        <td>{{ $item->page_title }}</td>
                                        <td>{{ $item->page_description }}</td>
                                        <td>{{ $item->page_about_your_self }}</td>
                                        <td>
                                          <a href="{{ url('/view_facebook_page/' . $item->id) }}" title="View User">
                                            <button class="btn btn-info btn-xs">
                                              <i class="fa fa-eye" aria-hidden="true">
                                              </i>
                                              View Facebook page
                                            </button>
                                          </a>
                                        </td>
                                        <td>
                                          <a href="{{ url('/view_youtube_page/' . $item->id) }}" title="View User">
                                            <button class="btn btn-info btn-xs">
                                              <i class="fa fa-eye" aria-hidden="true">
                                              </i>
                                              View Youtube page
                                            </button>
                                          </a>
                                        </td>
                                        <td>
                                          <a href="{{ url('/view_instagram_page/' . $item->id) }}" title="View User">
                                            <button class="btn btn-info btn-xs">
                                              <i class="fa fa-eye" aria-hidden="true">
                                              </i>
                                              View Youtube page
                                            </button>
                                          </a>
                                        </td>
                                        <td>
                                            <a href="{{ url('/buildpages/' . $item->id) }}" title="View User"><button class="btn btn-info btn-xs"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/buildpages/' . $item->id . '/edit') }}" title="Edit User"><button class="btn btn-primary btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>
                                            {!! Form::open([
                                                'method'=>'DELETE',
                                                'url' => ['/buildpages', $item->id],
                                                'style' => 'display:inline'
                                            ]) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array(
                                                        'type' => 'submit',
                                                        'class' => 'btn btn-danger btn-xs',
                                                        'title' => 'Delete User',
                                                        'onclick'=>'return confirm("Confirm delete?")'
                                                )) !!}
                                            {!! Form::close() !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $user_page->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
