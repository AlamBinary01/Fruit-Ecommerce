<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    @include('admin.layout.components.style')
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css" rel="stylesheet">
    <style>
        .content-wrapper {
            padding: 20px;
            margin-top: 90px; 
            margin-left: 100px;  
        }
        .card {
            width: 100%;
            max-width: 1000px; /* Increased width */
            margin: 15px auto; /* Center the card horizontally */
        }
        .btn-custom {
            background-color: #4154f1;
            color: white;
            border-radius: 4px;
            padding: 8px 16px;
            font-weight: bold;
        }
        .btn-custom:hover {
            background-color: #354bbf;
            text-decoration: none;
        }
        .btn-edit {
            background-color: #28a745;
            color: white;
        }
        .btn-edit:hover {
            background-color: #218838;
        }
        .btn-delete {
            background-color: #dc3545;
            color: white;
        }
        .btn-delete:hover {
            background-color: #c82333;
        }
        .table {
            margin: 0 auto; /* Center the table horizontally */
        }
    </style>
</head>
<body>

    @include('admin.layout.components.header')
    @include('admin.layout.components.sidebar')

    <div class="content-wrapper">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="mb-0" style="color: black">All Categories</h3>
                <a href="#" class="btn btn-custom">Add New</a>
            </div>
            <div class="card-body">
                <!-- Data Table -->
                <table id="categoriesTable" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example Row 1 -->
                        <tr>
                            <td>1</td>
                            <td>Electronics</td>
                            <td class="text-center">
                                <a href="#" class="btn btn-primary btn-sm btn-edit"><i class="fas fa-edit"></i> Edit</a>
                                <form action="#" method="POST" style="display:inline;">
                                    <button type="submit" class="btn btn-danger btn-sm btn-delete" onclick="return confirm('Are you sure?')"><i class="fas fa-trash-alt"></i> Delete</button>
                                </form>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('admin.layout.components.js')

    <!-- DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#categoriesTable').DataTable({
                "paging": true,
                "searching": true,
                "ordering": true
            });
        });
    </script>
</body>
</html>
