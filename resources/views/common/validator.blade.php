@if(count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            {{--只输出第一个--}}
            <li>{{$errors->first()}}</li>
        </ul>
        <br>
        {{--全部输出--}}
        <ul>
            @foreach($errors->all() as $error)
                <li>{{$error}}</li>
            @endforeach
        </ul>
    </div>
@endif