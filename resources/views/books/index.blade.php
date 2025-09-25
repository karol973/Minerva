@auth 
    
<div class="container">
<table class="table table-hover">
<thead>
<tr>
    <th scope="col">#</th>
    <th scope="col">test</th>
    <th scope="col">test2</th>
</tr>
</thead>
<tbody>
    @foreach($books as $book)
<tr>
    <th scope="row">{{$book->id}}</th>
        <td scope="row">{{$book->title}}</td>

</tr>        
    @endforeach


</tbody>

</table>
</div>

@else

<h2>Nie możesz wyświetlić zawartości tej strony</h2>
@endauth
