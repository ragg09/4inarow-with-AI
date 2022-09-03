<form action="{{ route('dataset.store') }}" method="POST">
    @csrf

    <label for="">Feed AI</label>
    <br>
    <input type="text" name="data">
    <br>
    <input type="submit">

</form>
