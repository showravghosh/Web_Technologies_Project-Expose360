document.addEventListener("DOMContentLoaded", function () {

    var searchInput = document.getElementById("deletedUserSearch");
    var tbody = document.querySelector("table tbody");

    if (!searchInput || !tbody) return;

    searchInput.addEventListener("keyup", function () {

        var fd = new FormData();
        fd.append("action", "deleted_user_search");
        fd.append("q", searchInput.value);

        fetch("../../../../Controllers/AjaxController.php", {
            method: "POST",
            body: fd
        })
        .then(r => r.json())
        .then(data => {

            tbody.innerHTML = "";

            if (!Array.isArray(data) || data.length === 0) {
                tbody.innerHTML =
                    "<tr><td colspan='13' style='text-align:center;'>No result</td></tr>";
                return;
            }

            data.forEach(u => {
                tbody.innerHTML += `
                <tr>
                    <td>${u.id}</td>
                    <td>${u.full_name}</td>
                    <td>${u.birth_date}</td>
                    <td>${u.address}</td>
                    <td>${u.division}</td>
                    <td>${u.postal_code}</td>
                    <td>${u.phone}</td>
                    <td>${u.email}</td>
                    <td>${u.gender}</td>
                    <td>${u.photo ? `<a href="../../../../Resources/Photos/${u.photo}" target="_blank">View</a>` : '-'}</td>
                    <td>${u.document ? `<a href="../../../../Resources/Photos/${u.document}" target="_blank">View</a>` : '-'}</td>
                    <td>${u.status}</td>
                    <td>-</td>
                </tr>`;
            });
        })
        .catch(err => {
            console.error("Search error:", err);
        });
    });
});
