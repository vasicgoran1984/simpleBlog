@extends('authentication.scheduleTop')

@section('comments-posts-page')
    @if(\Auth::user()->id)
      
        @if(isset($allPosts))
            
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>TITLE</th>
                        <th>TEXT</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($allPosts as $onePost)
                    <tr>
                        <td>{{$onePost->id}}</td>
                        <td>{{$onePost->title}}</td>
                        <td>{{$onePost->text}}</td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
        
        
    @endif

@endsection