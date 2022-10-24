@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('File') . " " . $file->id }}</div>
                <div class="card-body">
                    <table class="table">
                            <tr>
                                <td><strong>ID<strong></td>
                                <td>{{ $file->id }}</td>
                            </tr>
                            <tr>
                                <td><strong>Filepath</strong></td>
                                <td>{{ $file->filepath }}</td>
                            </tr>
                            <tr>
                                <td><strong>Filesize</strong></td>
                                <td>{{ $file->filesize }}</td>
                            </tr>
                            <tr>
                                <td><strong>Created</strong></td>
                                <td>{{ $file->created_at }}</td>
                            </tr>
                            <tr>
                                <td><strong>Updated</strong></td>
                                <td>{{ $file->updated_at }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <img class="img-fluid" src="{{ asset('storage/'.$file->filepath) }}" title="Image preview"/>
                </div>
            </div>
            
            <a class="btn btn-warning" href="{{ route('files.edit', $file) }}" role="button">📝 Edit</a>
            <a class="btn btn-primary" href="{{ route('files.index') }}">Back</a>
            
            <form id="form" method="POST" action="{{ route('files.destroy', $file) }}">
                @csrf
                @method("DELETE")
                <button id="destroy" type="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal">🗑️ Delete</button>
            </form>

            <!-- Modal -->
            <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            This action cannot be undone
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button id="confirm" type="button" class="btn btn-primary">Confirm</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit confirm -->
            <script type="text/javascript">                
                const submit = document.getElementById('destroy')
                const  confirm = document.getElementById('confirm')

                // Disable form submit button
                submit.addEventListener("click", function( event ) {
                    event.preventDefault()
                    return false
                })

                // Enable submit via modal confirmation
                confirm.addEventListener("click", function( event ) {
                    document.getElementById("form").submit(); 
                })
            </script>

        </div>
    </div>
</div>
@endsection
