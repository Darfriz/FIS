document.addEventListener("DOMContentLoaded", function () {
    function searchTable() {
        const searchTerm = document.getElementById("searchInput").value;

        // Use a data attribute to store the route URL
        const searchRoute = document.getElementById("searchInput").dataset.searchRoute;

        // Perform AJAX request to search flights by customer's name
        const xhr = new XMLHttpRequest();
        xhr.open("POST", searchRoute, true);
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
});
