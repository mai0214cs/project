<form action="{{route('example.store')}}" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <input type="checkbox" value="Checkdata" name="Checkdata" />
    <input type="text" name="title" />
    <button type="submit" value="Guidulieu">Nut Xac nhan</button>
    
</form>