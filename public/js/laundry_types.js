$(document).ready(function () {
    $('#laundry-types-table').DataTable({
        // boleh kosong, atau:
        columnDefs: [
            { targets: 0, orderable: false, searchable: false },  // No
            { targets: 4, orderable: false, searchable: false }   // Action
        ]
    });
});
