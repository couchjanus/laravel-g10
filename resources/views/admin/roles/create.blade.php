@extends('layouts.admin')
@section('styles')
  @parent
@endsection
@section('content')
<div class="container-fluid">
  <div class="animate fadeIn">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading"><h2>Add New role</h2></div>
          <div class="panel-body">

            <a href="{{ route('roles.index') }}" class="btn btn-success btn-sm" title="All roles">
                <span data-feather="arrow-left"></span>  Go Back
            </a>
            <br/>
            <br/>
            <div class="table-responsive">
              <form action="{{ route('roles.store') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="card">
                    <div class="card-block">
                      <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" class="form-control" type="text" placeholder="Enter name" required>
                      </div>
                      <div class="form-group">
                        <label for="name">Description</label>
                        <input name="description" class="form-control" type="text" placeholder="Enter description">
                      </div>

                      
                      <div class="form-group">
                        <label for="selectall-permission" class= 'control-label'>Select permissions</label>
                        <button type="button" class="btn btn-primary btn-xs" id="selectbtn-permission">
                            Select all
                        </button>
                        <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-permission">
                            Deselect all
                        </button>
                        <select name="permission[]" class="form-control select2" multiple='multiple' id='selectall-permission'>
                            @foreach($permissions as $permission)
                                <option value="{{$permission->id}}">{{ $permission->name}}</option>
                            @endforeach
                        </select>
                        <p class="help-block"></p>
                        @if($errors->has('permission'))
                            <p class="help-block">
                                {{ $errors->first('permission') }}
                            </p>
                        @endif
                      </div>
                    </div>
                    <div class="card-footer text-muted">
                      <button type="submit" class="btn btn-primary btn-sm pull-right"><span data-feather="save"></span> Save</button>
                    </div>
                
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>    
  </div>
</div>
@endsection  
@section('scripts')
    @parent
    <script>
        $("#selectbtn-permission").click(function(){
            $("#selectall-permission > option").prop("selected","selected");
            $("#selectall-permission").trigger("change");
        });
        $("#deselectbtn-permission").click(function(){
            $("#selectall-permission > option").prop("selected","");
            $("#selectall-permission").trigger("change");
        });

        $(document).ready(function () {
            $('.select2').select2();
        });
    </script>
@endsection