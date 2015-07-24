<div class="container">
    <h1>Lista de Categorias</h1>

    <table class="table" border="1">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Descrição</th>
        </tr>

        @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>
                <td>{{ $category->description }}</td>
            </tr>
        @endforeach
    </table>
</div>