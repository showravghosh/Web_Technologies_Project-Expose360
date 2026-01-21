
document.querySelectorAll('tr.user-row').forEach(function(row){
    row.addEventListener('click', function(e){
        // ignore clicks on buttons/forms
        if (e.target.tagName.toLowerCase() === 'button' || e.target.closest('form')) {
            return;
        }
        var id = this.getAttribute('data-id');
        var current = this.getAttribute('data-status');
        var choice = prompt('Type Active or Inactive for this user\n(Current: '+current+')');
        if (!choice) return;
        choice = choice.trim();
        if (choice !== 'Active' && choice !== 'Inactive') {
            alert('Please type Active or Inactive');
            return;
        }
        var fd = new FormData();
        fd.append('action','user_update_status');
        fd.append('id', id);
        fd.append('status', choice);
        fetch('../../../../Controllers/AjaxController.php',{method:'POST', body:fd})
            .then(r => r.json())
            .then(function(data){
                if (data.ok){
                    row.setAttribute('data-status', choice);
                    var cell = row.querySelector('.status-cell');
                    if (cell) cell.textContent = choice;
                } else {
                    alert(data.message || 'Failed');
                }
            })
            .catch(function(){ alert('Failed'); });
    });
});

// Delete user + delete all users
document.querySelectorAll('form').forEach(function(f){
    var act = f.querySelector('input[name="action"]');
    if (!act) return;

    if (act.value === 'delete_user') {
        f.addEventListener('submit', function(e){
            e.preventDefault();
            if (!confirm('Delete this user?')) return;
            var fd = new FormData(f);
            fd.append('action', 'user_delete');
            fetch('../../../../Controllers/AjaxController.php', { method: 'POST', body: fd })
                .then(function(r){ return r.json(); })
                .then(function(data){
                    if (data.ok) {
                        var row = f.closest('tr');
                        if (row) row.remove();
                    } else {
                        alert(data.message || 'Failed');
                    }
                })
                .catch(function(){ alert('Failed'); });
        });
    }

    if (act.value === 'delete_all_users') {
        f.addEventListener('submit', function(e){
            e.preventDefault();
            if (!confirm('Delete ALL users?')) return;
            var fd = new FormData(f);
            fd.append('action', 'user_delete_all');
            fetch('../../../../Controllers/AjaxController.php', { method: 'POST', body: fd })
                .then(function(r){ return r.json(); })
                .then(function(data){
                    if (data.ok) {
                        var tbody = document.querySelector('table tbody');
                        if (tbody) tbody.innerHTML = '';
                    } else {
                        alert(data.message || 'Failed');
                    }
                })
                .catch(function(){ alert('Failed'); });
        });
    }
});

document.addEventListener("DOMContentLoaded", function () {

    var searchInput = document.getElementById("userSearch");
    var tbody = document.querySelector("table tbody");

    if (!searchInput) return;

    searchInput.addEventListener("keyup", function () {

        var fd = new FormData();
        fd.append("action", "user_search");
        fd.append("q", searchInput.value);

        fetch("../../../../Controllers/AjaxController.php", {
            method: "POST",
            body: fd
        })
        .then(r => r.json())
        .then(data => {

            tbody.innerHTML = "";

            if (data.length === 0) {
                tbody.innerHTML =
                    "<tr><td colspan='13'>No result</td></tr>";
                return;
            }

            data.forEach(u => {
                tbody.innerHTML += `
                <tr class="user-row"
                    data-id="${u.id}"
                    data-status="${u.status}">
                    <td>${u.id}</td>
                    <td>${u.full_name}</td>
                    <td>${u.birth_date}</td>
                    <td>${u.address}</td>
                    <td>${u.division}</td>
                    <td>${u.postal_code}</td>
                    <td>${u.phone}</td>
                    <td>${u.email}</td>
                    <td>${u.gender}</td>
                    <td>${u.photo}</td>
                    <td>${u.document}</td>
                    <td class="status-cell">${u.status}</td>
                    <td>-</td>
                </tr>`;
            });
        });
    });
});
