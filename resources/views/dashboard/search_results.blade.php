@foreach($results as $result)
    <tr>
        <td>{{ $result->id }}</td>
        <td>{{ $result->name }}</td>
        <td>{{ $result->email }}</td>
        <td>{{ $result->from_location }}</td>
        <td>{{ $result->to_location }}</td>
        <td>{{ $result->date }}</td>
        <td>{{ $result->passengers }}</td>
        <td>{{ $result->total_price }}</td>
    
        <!-- Add a Delete button with a dustbin icon -->
        <td><span class='dustbin-icon large-icon' data-id="{{ $result->id }}">&#128465;</span></td>
    </tr>
@endforeach