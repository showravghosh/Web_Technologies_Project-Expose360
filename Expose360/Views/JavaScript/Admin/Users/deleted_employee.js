
document.addEventListener('DOMContentLoaded', function () {

    var searchInput = document.getElementById('deletedEmpSearch');
    var tbody = document.getElementById('deletedEmpTbody');

    if (!searchInput || !tbody) return;

    function searchDeletedEmployees() {

        var fd = new FormData();
        fd.append('action', 'deleted_employee_search');
        fd.append('q', searchInput.value);

        fetch('../../../../Controllers/AjaxController.php', {
            method: 'POST',
            body: fd
        })
        .then(function (r) { return r.json(); })
        .then(function (data) {

            tbody.innerHTML = '';

            if (!data.length) {
                tbody.innerHTML =
                    "<tr><td colspan='7' style='text-align:center;padding:18px;'>No result</td></tr>";
                return;
            }

            data.forEach(function (e) {
                tbody.innerHTML += `
                    <tr>
                        <td>${e.emp_id}</td>
                        <td>${e.full_name}</td>
                        <td>${e.date_joined}</td>
                        <td>${e.salary}</td>
                        <td style="text-align:center;">N/A</td>
                        <td>${e.gender}</td>
                        <td style="text-align:center;">-</td>
                    </tr>
                `;
            });
        })
        .catch(function () {
            alert('Search failed');
        });
    }

    searchInput.addEventListener('keyup', searchDeletedEmployees);

});
