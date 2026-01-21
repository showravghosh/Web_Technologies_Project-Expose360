if (!window.__verificationRequestBound) {
    window.__verificationRequestBound = true;

    document.addEventListener('DOMContentLoaded', function () {
        var form = document.querySelector('.details-card form');
        if (!form) return;

        form.addEventListener('submit', function (e) {
            e.preventDefault();
        });

        var buttons = form.querySelectorAll('button[name="new_status"]');
        if (!buttons || buttons.length === 0) return;

        function redirectBack() {
            var url = new URL(window.location.href);
            url.searchParams.delete('id');
            window.location.href = url.toString();
        }

        buttons.forEach(function (btn) {
            // Add a data attribute to track if listener is already added
            if (btn.hasAttribute('data-verification-bound')) return;
            btn.setAttribute('data-verification-bound', 'true');
            
            btn.addEventListener('click', function (e) {
                e.preventDefault();

                var status = btn.value;
                if (status === 'Approved' && !confirm('Approve this post?')) return;
                if (status === 'Rejected' && !confirm('Reject this post?')) return;

                var fd = new FormData(form);
                fd.append('action', 'post_update_status');
                fd.append('status', status);

                fetch('../../../../Controllers/AjaxController.php', {
                    method: 'POST',
                    body: fd
                })
                    .then(function (r) { return r.json(); })
                    .then(function (data) {
                        if (data && data.ok) {
                            redirectBack();
                        } else {
                            alert(data?.message || 'Failed');
                        }
                    })
                    .catch(function () {
                        alert('Failed');
                    });
            });
        });
    });
}