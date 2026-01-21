
document.addEventListener('DOMContentLoaded', function () {

    var searchInput = document.getElementById('deletedAdminSearch');
    var rows = document.querySelectorAll('tbody tr');

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