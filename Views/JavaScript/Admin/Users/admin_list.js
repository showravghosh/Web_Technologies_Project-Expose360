
// Row click: set Active/Inactive
document.querySelectorAll('tr.admin-row').forEach(function(row){
    row.addEventListener('click', function(e){
        if (e.target.tagName.toLowerCase() === 'button' || e.target.closest('form')) {
            return;
        }
        var id = this.getAttribute('data-id');
        var current = this.getAttribute('data-status');
        var choice = prompt('Type Active or Inactive for this admin\n(Current: '+current+')');
        if (!choice) return;
        choice = choice.trim();
        if (choice !== 'Active' && choice !== 'Inactive') {
            alert('Please type Active or Inactive');
            return;
        }
        var fd = new FormData();
        fd.append('action','admin_update_status');
        fd.append('id', id);
        fd.append('status', choice);
        fetch('../../../../Controllers/AjaxController.php',{method:'POST', body:fd})
            .then(r => r.json())
            .then(function(data){
                if (data.ok){
                    row.setAttribute('data-status', choice);
                } else {
                    alert(data.message || 'Failed');
                }
            })
            .catch(function(){ alert('Failed'); });
    });
});

// search admin
document.addEventListener('DOMContentLoaded', function () {

    var searchInput = document.getElementById('adminSearch');
    var rows = document.querySelectorAll('#adminTbody tr');

    if (!searchInput) return;

    searchInput.addEventListener('keyup', function () {

        var value = this.value.toLowerCase();

        rows.forEach(function (row) {
            var text = row.textContent.toLowerCase();

            if (text.indexOf(value) > -1) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
});


// Delete admin
document.querySelectorAll('form').forEach(function(f){
    var act = f.querySelector('input[name="action"]');
    if (!act) return;
    if (act.value !== 'delete_admin') return;

    f.addEventListener('submit', function(e){
        e.preventDefault();
        if (!confirm('Delete this admin?')) return;

        var fd = new FormData(f);
        fd.append('action', 'admin_delete');
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
});

document.addEventListener('DOMContentLoaded', function () {
    var resetBtn = document.getElementById('resetBtn');
    if (resetBtn) {
        resetBtn.addEventListener('click', function () {
            location.reload();
        });
    }
});



