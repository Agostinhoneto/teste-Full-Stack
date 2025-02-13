@include('layouts.topo')
@include('layouts.sidebar')
<div class="container mt-2">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white text-end">
            <h3 class="card-title">Relatórios</h3>
        </div>
        <div class="card-body text-end">
            <button class="btn btn-sm btn-light" onclick="window.print()">
                <i class="fas fa-print"></i> Imprimir
            </button>
        </div>
        <div class="card-body">
            <!-- Filtros -->
            <form method="GET" action="{{ url('/reports') }}" class="row g-3 mb-4 text-end">
                @csrf
                <div class="col-md-6">
                    <label for="created_at" class="form-label">Data Inicial:</label>
                    <input type="date" name="created_at" id="created_at" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="data_pagamento" class="form-label">Data Final:</label>
                    <input type="date" name="data_pagamento" id="data_pagamento" class="form-control" required>
                </div>
                <div class="col-md-12 text-end">
                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-filter"></i> Filtrar
                    </button>
                </div>
            </form>

            <!-- Tabela de Relatórios -->
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Descrição</th>
                        <th>Email</th>
                        <th>Data de cadastro</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($colaborador as $c)
                    <tr>
                        <td>{{ $c->id }}</td>
                        <td>{{ $c->nome }}</td>
                        <td>{{ $c->email }}</td>
                        <td>{{ \Carbon\Carbon::parse($c->created_at)->format('d/m/Y') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('layouts.footer')

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script>
    $(document).ready(function() {
        if (!$.fn.DataTable.isDataTable('#example1')) {
            $('#example1').DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        }
    });
</script>