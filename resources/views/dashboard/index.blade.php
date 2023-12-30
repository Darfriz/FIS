<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('css/styles.css') }}">
</head>
<body class="background-image" style="background-image: url('images/sky.jpg');">
  <header>
    <a href="#" class="logo">FAA<br> FLIGHT INFORMATION SYSTEM</a>
    <ul>
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('flight') }}">Flight</a></li>
            <li> <a href="{{ route('dashboard') }}" class="active">Database</a></li>
            <li> <a href="{{ route('analytics') }}">Analytics</a></li>
            <li><a href="{{ route('login') }}">Account</a></li>
    </ul>
  </header> <br><br><br><br><br><br><br>
  
  <div class="search-container">
    <input type="text" id="searchInput" placeholder="Search by Customer's Name...">
    <button type="button" onclick="searchTable()">Search</button>
  </div>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>From Location</th>
        <th>To Location</th>
        <th>Date</th>
        <th>Passengers</th>
        <th>Total Price</th>
        <th>Action</th> <!-- column for dustbin icon -->
      </tr>
    </thead>
    <tbody>
    @foreach($flights as $flight)
        <tr>
            <td>{{ $flight->id }}</td>
            <td>{{ $flight->name }}</td>
            <td>{{ $flight->email }}</td>
            <td>{{ $flight->from_location }}</td>
            <td>{{ $flight->to_location }}</td>
            <td>{{ $flight->date }}</td>
            <td>{{ $flight->passengers }}</td>
            <td>{{ $flight->total_price }}</td>
        
            <!-- Add a Delete button with a dustbin icon -->
            <td><span class='dustbin-icon large-icon' data-id="{{ $flight->id }}">&#128465;</span></td>
        </tr>
    @endforeach
    </tbody>
  </table>

  <!-- Pagination links -->
  <div class="pagination-container">
    {{ $flights->links() }}
  </div><br><br><br><br>

  <!-- Include SweetAlert2 library -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      // Function to handle the delete button click
      function deleteRow(id) {
        Swal.fire({
          title: 'Are you sure?',
          text: 'You will not be able to recover this record!',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonText: 'Yes, delete it!',
          cancelButtonText: 'No, cancel!',
          reverseButtons: true
        }).then((result) => {
          if (result.isConfirmed) {
            // Perform AJAX request to delete the row from the database
            const xhr = new XMLHttpRequest();
            
            // Set the method to POST explicitly
            xhr.open("POST", "{{ route('deleteRow') }}", true);

            // Set the CSRF token in the headers
            xhr.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function () {
              if (xhr.readyState === 4) {
                if (xhr.status === 200) {
                  const response = JSON.parse(xhr.responseText);
                  if (response.success) {
                    // Row deleted successfully, reload the page to update the table
                    location.reload();
                  } else {
                    Swal.fire({
                      icon: 'error',
                      title: 'Error',
                      text: response.message || 'Error deleting record'
                    });
                  }
                } else {
                  Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to delete record'
                  });
                }
              }
            };
            xhr.send("id=" + id);
          }
        });
      }

      // Add event listener to the entire table and use event delegation to handle the click event for dustbin icons
      document.querySelector('table').addEventListener("click", function (event) {
        if (event.target.classList.contains("dustbin-icon")) {
          const id = event.target.getAttribute("data-id");
          deleteRow(id);
        }
      });

      // Full implementation of searchTable function
      function searchTable() {
        const searchTerm = document.getElementById("searchInput").value;

        // Perform AJAX request to search flights by customer's name
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "{{ route('searchByName') }}", true);

        // Set the CSRF token in the headers
        xhr.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

        xhr.onreadystatechange = function () {
          if (xhr.readyState === 4 && xhr.status === 200) {
            // Replace the table body with the search results
            const tableBody = document.querySelector("tbody");
            tableBody.innerHTML = xhr.responseText;
          }
        };
        xhr.send("searchTerm=" + searchTerm);
      }

      // Attach the searchTable function to the button click event
      const searchButton = document.querySelector('.search-container button');
      if (searchButton) {
        searchButton.addEventListener("click", searchTable);
      }
    });
  </script>
</body>
</html>
