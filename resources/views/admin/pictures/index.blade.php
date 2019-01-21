@extends('layouts.admin')

@section('content')
<div class="container-fluid">
  <div class="animate fadeIn">
    <div class="col-12">
      <div class="panel panel-default">
        <div class="panel-heading"><h2>Pictures</h2></div>
          <div class="panel-body">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
    
            <br/>
            <div class="table-responsive">
            <picture-component></picture-component>
                  
              <table class="table table-hover table-striped table-sm">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Posted On</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse($pictures as $picture)
                    <tr>
                      <td>{{ $picture->id }}</td>
                      <td>{{ $picture->name }}</td>
                      <td>{{ date('d F Y', strtotime($picture->created_at)) }}</td>
                      <td>
                        <a title="Read picture" href="{{ route('pictures.show', ['id'=> $picture->id]) }}" class="btn btn-primary"><span data-feather="eye"></span></a>
                        <a title="Edit picture" href="{{ route('pictures.edit', ['id'=> $picture->id]) }}" class="btn btn-warning"><span data-feather="edit"></span></a>
                        <button title="Delete picture" type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_picture_{{ $picture->id  }}"><span data-feather="delete"></span></button>
                      </td>
                    </tr>

                    <div class="modal fade" id="delete_picture_{{ $picture->id  }}" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                      <form class="" action="{{ route('pictures.destroy', ['id' => $picture->id]) }}" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="modal-dialog modal-sm">
                          <div class="modal-content">
                            <div class="modal-header bg-red">
                              <h4 class="modal-title" id="mySmallModalLabel">Delete picture</h4>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>

                            <div class="modal-body">
                              Are you sure to delete picture: <b>{{ $picture->name }} </b>?
                            </div>
                            <div class="modal-footer">
                              <a href="{{ url('/pictures') }}">
                                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Close</button>
                              </a>
                              <button type="submit" class="btn btn-outline" title="Delete" value="delete">Delete</button>
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>

                    @empty
                    <p>No pictures yet...</p>
                  @endforelse
                </tbody>
              </table>

              {{ $pictures->onEachSide(2)->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>    
  </div>
</div>

@endsection