
function fillFormFromRow(row) {
    document.getElementById('empId').value = row.dataset.emp_id || '';
    document.getElementById('full_name').value = row.dataset.full_name || '';
    document.getElementById('date_joined').value = row.dataset.date_joined || '';
    document.getElementById('salary').value = row.dataset.salary || '';

    const phoneEl = document.getElementById('phone');
    if (phoneEl) phoneEl.value = row.dataset.phone || '';

    const gender = row.dataset.gender || '';
    document.querySelectorAll('input[name="gender"]').forEach(r => {
        r.checked = (r.value === gender);
    });

    document.getElementById('formAction').value = 'update_employee';

    const submitBtn = document.getElementById('submitBtn');
    if (submitBtn) {
        submitBtn.innerHTML = '<img src="../../../../Resources/Photos/update.png" class="btn-icon"> Update Employee';
    }
}

function resetToAddMode() {
    document.getElementById('formAction').value = 'add_employee';
    document.getElementById('empId').value = '';

    const submitBtn = document.getElementById('submitBtn');
    if (submitBtn) {
        submitBtn.innerHTML = '<img src="../../../../Resources/Photos/add.png" class="btn-icon"> Add Employee';
    }
}

document.querySelectorAll('.action-btn.delete').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.stopPropagation();
    });
});

// Add/Update employee
var empForm = document.getElementById('empForm');
if (empForm) {
    empForm.addEventListener('submit', function(e){
        e.preventDefault();
        var fd = new FormData(empForm);
        //action for both add/update
        fd.append('action', 'employee_save');
        fetch('../../../../Controllers/AjaxController.php', { method: 'POST', body: fd })
            .then(function(r){ return r.json(); })
            .then(function(data){
                if (data.ok) {
                    location.href = 'employee_list.php';
                } else {
                    alert(data.message || 'Failed');
                }
            })
            .catch(function(){ alert('Failed'); });
    });
}

// Delete employee
document.querySelectorAll('form').forEach(function(f){
    var act = f.querySelector('input[name="action"]');
    if (!act) return;
    if (act.value !== 'delete_employee') return;
    f.addEventListener('submit', function(e){
        e.preventDefault();
        if (!confirm('Delete this employee?')) return;
        var fd = new FormData(f);
        fd.append('action', 'employee_delete');
        fetch('../../../../Controllers/AjaxController.php', { method: 'POST', body: fd })
            .then(function(r){ return r.json(); })
            .then(function(data){
                if (data.ok) {
                    var row = f.closest('tr');
                    if (row) row.remove();
                    resetToAddMode();
                } else {
                    alert(data.message || 'Failed');
                }
            })
            .catch(function(){ alert('Failed'); });
    });
});

// Employee search 
document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('empSearch');
    const clearBtn = document.getElementById('clearSearch');
    const rows = document.querySelectorAll('tbody tr');

    function filterTable() {
        const q = searchInput.value.toLowerCase().trim();

        rows.forEach(row => {
            const name  = row.children[1].innerText.toLowerCase();
            const phone = row.children[5].innerText.toLowerCase();

            if (name.includes(q) || phone.includes(q)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    searchInput.addEventListener('keyup', filterTable);

    clearBtn.addEventListener('click', function () {
        searchInput.value = '';
        rows.forEach(row => row.style.display = '');
        searchInput.focus();
    });

});